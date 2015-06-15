<?php

/**
 * user action
 *
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com/
 */

sfProjectConfiguration::getActive()->loadHelpers(array('I18N', 'General', 'Url'));

/**
 * user action 
 * 
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com
 * Copyright (c) Experts Web Solution  2012-2013
 */
class userActions extends sfActions
{
    /**
     * Index
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */
    public function executeIndex(sfWebRequest $request)
    {

        //--- If User is already Authenticated than ---//  
        if ($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('user')) {
            $this->redirect('@myaccount');
        } 

        $this->oForm = new ClientUsersForm();

        if ($request->isMethod('post')) {
            $this->oForm->bind($request->getParameter($this->oForm->getName()));

            if ($this->oForm->isValid()) {
                //--- Save register new member date ---//
                $this->oForm->save();

                //--- Send email register new member ---//
                $message = $this->getMailer()->compose();

                if (sfConfig::get('is_verify_user') == 'on') {
                    $objEmail = Doctrine_Core::getTable('Emails')->findOneById(4);

                    $message->setSubject(str_replace('[website_title]', sfConfig::get('website_title'), $objEmail->getSubject()));
                    $message->setTo($this->oForm->getValue('email'));
                    $message->setFrom($objEmail->getFromEmail());

                    $search = array('[nickname]', '[website_link]', '[validation_link]');

                    $replace = array(ucfirst($this->oForm->getValue('nickname')),
                        url_for('@homepage', true),
                        url_for('user/verify?v=' . $this->oForm->getObject()->getVerifyCode(), true));

                    $html = str_replace($search, $replace, $objEmail->getBody());

                    $message->setBody($html, 'text/html');

                    $this->getMailer()->send($message);
                    $this->redirect('@cms_page?page=verify-email');
                } else {
                    $objEmail = Doctrine_Core::getTable('Emails')->findOneById(1);
                    $message->setSubject($objEmail->getSubject());
                    $message->setTo($this->oForm->getValue('email'));
                    $message->setFrom($objEmail->getFromEmail());

                    $search = array('[nickname]', '[website_link]');

                    $replace = array(ucfirst($this->oForm->getValue('nickname')),
                        url_for('@homepage', true));

                    $html = str_replace($search, $replace, $objEmail->getBody());

                    $message->setBody($html, 'text/html');

                    $this->getMailer()->send($message);
                    $this->redirect('@cms_page?page=thanks');
                }
            }
        }

        //--- Set Breadcrumb url ---//	
        $obj = new Breadcrumb();
        $obj->add(__('cap_registration', '', 'register'), $request->getUri(), 1);

        //--- Set meta tags ---// 
        $this->getResponse()->setTitle(__('cap_registration', '', 'register'));
        $this->getResponse()->addMeta('description', '');
        $this->getResponse()->addMeta('keywords', '');
    }

    /**
     * Postclassfileds
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */
    public function executePostclassfileds(sfWebRequest $request)
    {
        $this->getUser()->setAttribute('is_post', 1, 'sess_postad');
        $this->redirect('http://www.' . getDomain($request->getHost()) . $request->getScriptName());
    }

    /**
     * Delete Classified ads by user
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */
    public function executeDelete(sfWebRequest $request)
    {
        $post_id = $request->getParameter('id');

        //--- Delete Post ---//
        $q = Doctrine_Query::create()
            ->delete('Posts')
            ->where('id = ? ', $post_id)
            ->limit(1);
        $q->execute();

        //--- Remove Images for this post ---//		
        rrmdir(sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . $post_id);

        $this->getUser()->setFlash('error', __('msg_post_delete', '', 'myaccount'));
        $this->redirect($request->getReferer());

        return sfView::NONE;
    }

    /**
     * Delete Classified ads images by user
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */
    public function executeDeleteimage(sfWebRequest $request)
    {
        $img_id = $request->getParameter('img_id');

        list($str, $id) = explode('_', $img_id);
        $obj = Doctrine_Core::getTable('PostImages')->findOneById($id);

        //--- Remove Images for this post ---//		
        $img_path = sfConfig::get('sf_upload_dir') . 'posts' . DIRECTORY_SEPARATOR . $obj->getPostId();
        unlink($img_path . DIRECTORY_SEPARATOR . 'b' . DIRECTORY_SEPARATOR . $obj->getImage());
        unlink($img_path . DIRECTORY_SEPARATOR . 'o' . DIRECTORY_SEPARATOR . $obj->getImage());
        unlink($img_path . DIRECTORY_SEPARATOR . 'm' . DIRECTORY_SEPARATOR . $obj->getImage());
        unlink($img_path . DIRECTORY_SEPARATOR . 's' . DIRECTORY_SEPARATOR . $obj->getImage());

        //--- Delete Image from DB ---//
        $q = Doctrine_Query::create()
            ->delete('PostImages')->where('id = ? ', $id)
            ->limit(1);

        $q->execute();
        
        return sfView::NONE;
    }

    /**
     * Verify user 
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */    
    public function executeVerify(sfWebRequest $request)
    {
        $code = $request->getParameter('v');

        //--- Redirect 404 if State not exist in DB ---//
        $this->forward404Unless($code);

        //--- Delete Post ---//
        $q = Doctrine_Query::create()
            ->update('Users')
            ->set('status', '1')
            ->where('verify_code = ? ', $code)
            ->limit(1);
        $q->execute();

        //--- Fetch User for send email ---//	 	   
        $objUser = Doctrine_Core::getTable('Users')->findOneByVerifyCode($code);

        //--- Fetch User for send email ---//	 	  	
        $objEmail = Doctrine_Core::getTable('Emails')->findOneById(1);

        //--- Send email register new member ---//
        $message = $this->getMailer()->compose();
        $message->setSubject(str_replace('[website_title]', sfConfig::get('website_title'), $objEmail->getSubject()));
        $message->setTo($objUser->getEmail());
        $message->setFrom($objEmail->getFromEmail());

        $search = array('[nickname]', '[website_link]','[signin_url]','[website_title]','[email]');

        $replace = array(ucfirst($objUser->getNickname()),
            url_for('@homepage', true),
            url_for('@signin', true),
            sfConfig::get('website_title'),
            $objUser->getEmail());

        $html = str_replace($search, $replace, $objEmail->getBody());

        $message->setBody($html, 'text/html');

        $this->getMailer()->send($message);

        $this->redirect('@cms_page?page=thanks');

        return sfView::NONE;
    }

    /**
     * Payment action
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */    
    public function executePayment(sfWebRequest $request)
    {
        $this->objPost = Doctrine_Core::getTable('Posts')->findOneById($request->getParameter('id'));
        $this->setLayout('popup');
    }

    /**
     * Payment Ipn action
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */    
    public function executeIpn(sfWebRequest $request)
    {
        $p = new Paypal();
        $p->paypal_url = !sfConfig::get('is_paypal_testmode') ? 'https://www.paypal.com/cgi-bin/webscr' : 'https://sandbox.paypal.com/cgi-bin/webscr'  ;

        if ($p->validate_ipn()) {
            PostsTable::publishPostById($request->getParameter('custom'));
        }
        return sfView::NONE;
    }
}