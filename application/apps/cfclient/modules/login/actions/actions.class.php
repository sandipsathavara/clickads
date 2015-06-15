<?php

/**
 * homeActions
 *
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com/
 *
 */

/**
 * homeActions
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
class loginActions extends sfActions
{

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executeIndex(sfWebRequest $request)
    {

        //--- If User is already Authenticated than ---//  
        if ($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('user')) {
            $this->redirect('@myaccount');
        }
        
        //--- Create Form Object ---//
        $this->oForm = new LoginForm();

        if ($request->isMethod('post')) {
            //--- Buiild Form Validation ---// 
            $this->oForm->bind($request->getParameter($this->oForm->getName()));

            if ($this->oForm->isValid()) {
                //--- Check Is user exist or name ---//	
                $oUser = UsersTable::checkUserExist($this->oForm, 'user');

                if ($oUser) {
                    $this->getUser()->setSessionUser($oUser, $this->oForm->getValue('isremember') == 1 ? true : false);
                    $this->redirect($request->getReferer());
                } else {
                    $this->getUser()->setFlash('error', __('msg_username_password_wrong', '', 'login'));
                    $this->redirect('@signin');
                }
            }
        }

        //--- Set Breadcrumb url ---//	
        $obj = new Breadcrumb();
        $obj->add(__('cap_login', '', 'login'), $request->getUri(), 1);

        //--- Set meta tags ---// 
        $this->getResponse()->setTitle(__('cap_login', '', 'login'));
        $this->getResponse()->addMeta('description', '');
        $this->getResponse()->addMeta('keywords', '');
    }

    /**
     * Forgetpassword action
     *
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executeForgetpassword(sfWebRequest $request)
    {
        //--- Create Form Object ---//
        $this->oForm = new ForgetPasswordForm();

        if ($request->isMethod('post')) {


            //--- Build Form Validation ---// 
            $this->oForm->bind($request->getParameter($this->oForm->getName()));


            if ($this->oForm->isValid()) {

                $oUser = UsersTable::checkIsEmailExist($this->oForm->getValue('email'));


                if ($oUser) {

                    $message = $this->getMailer()->compose();


                    //--- Create Salt Value  ---//
                    $salt = generateSalt($this->oForm->getValue('email'));

                    //--- Prepar passwoed ---//
                    $pass = createPassword();

                    //--- Generate MD5 String ---//
                    $passString = generatePassword($salt, $pass);

                    //$body = $this->getPartial('forgetpasswordBody', array('nickname' => $oUser->getNickname(), 'email' => $oUser->getEmail(), 'password' => $pass));

                    //--- Send Email new Password to user ---//	
                    //--- Update Password ---//			
                    $oUser->setId($oUser->getId());
                    $oUser->setSalt($salt);
                    $oUser->setPassword($passString);
                    $oUser->save();



                    //--- Send email forget password ---//
                    $objEmail = Doctrine_Core::getTable('Emails')->findOneById(2);

                    $message->setSubject(str_replace('[website_title]', sfConfig::get('website_title'), $objEmail->getSubject()));
                    $message->setTo($oUser->getEmail());
                    $message->setFrom($objEmail->getFromEmail());

                    $search = array('[nickname]', '[email]', '[password]', '[website_title]');
                    $replace = array(ucfirst($this->oForm->getValue('nickname')),
                        $this->oForm->getValue('email'),
                        $pass,
                        sfConfig::get('website_title'));

                    $html = str_replace($search, $replace, $objEmail->getBody());

                    $message->setBody($html, 'text/html');

                    $a = $this->getMailer()->send($message);

                    $this->redirect('@forget_password_sent');
                } else {
                    $this->getUser()->setFlash('error', __('msg_email_not_exist', '', 'forgetpassword'));
                    $this->redirect('@forget_password');
                }
            }
        }

        //--- Set Breadcrumb url ---//	
        $obj = new Breadcrumb();
        $obj->add(__('cap_forgetpassword', '', 'forgetpassword'), $request->getUri(), 1);
    }

    /**
     * Forgetpasswordsent action
     *
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executeForgetpasswordsent(sfWebRequest $request)
    {
        
    }

}
