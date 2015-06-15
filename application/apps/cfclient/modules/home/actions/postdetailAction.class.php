<?php

/**
 * postdetailAction
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
sfProjectConfiguration::getActive()->loadHelpers(array('I18N', 'General', 'Url'));

/**
 * postdetailAction
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
class postdetailAction extends sfAction
{

    /**
     * Classifled Search .
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */ 
    public function execute($request)
    {
        //--- Create form object ---//	
        $this->oForm = new AdReplyForm();

        //--- Get Post Id from Query String ---//
        $post_id = getIdFromSulg($request->getParameter('post_slug'));

        //--- Redirect 404 if post id not find---//
        $this->forward404Unless($post_id);

        //--- Get Post Details by Post id ---// 
        $this->objPosts = PostsTable::getPostByPostId($post_id);

        $this->nickName = ($this->objPosts->getUserId() != 0) ?
                Users::getUserDetail($this->objPosts->getUserId()) : 'Guest';


        //--- Create BreadCrum Url ---//
        $obj = new Breadcrumb();
        $obj->add(ucfirst($this->objPosts->getTitle()), $request->getUri(), 4);

        //--- Set Meta datas ---// 
        $this->getResponse()->setTitle($this->objPosts->getTitle());

        $this->objRelatedPosts = PostsTable::getRelatedPostByTitle($this->objPosts->getTitle());
        
        
        //--- Redirect 404 if this->objPosts not find ---//
        $this->forward404Unless($this->objPosts);

        if ($request->isMethod('post')) {
            //--- Buiild Form Validation ---// 
            $this->oForm->bind($request->getParameter($this->oForm->getName()));

            if ($this->oForm->isValid()) {
                //--- Send email register new member ---//
                $objEmail = Doctrine_Core::getTable('Emails')->findOneById(3);

                $message = $this->getMailer()->compose();

                $message->setSubject($this->objPosts->getTitle());
                $message->setTo($this->objPosts->getReplyTo());
                $message->setFrom($objEmail->getFromEmail());

                $search = array('[nickname]', '[name]', '[email]', '[phone]', '[message]', '[url]');

                $replace = array(ucfirst($this->objPosts->getName()),
                    ucfirst($this->oForm->getValue('name')),
                    $this->oForm->getValue('email'),
                    $this->oForm->getValue('phone'),
                    $this->oForm->getValue('message'),
                    $request->getReferer());

                $html = str_replace($search, $replace, $objEmail->getBody());

                $message->setBody($html, 'text/html');

                //--- Send Email new Password to user ---//
                $this->getMailer()->send($message);

                $this->getUser()->setFlash('error', __('post_reply_success', '', 'postad'));
                $this->redirect($request->getReferer());
            }
        }
    }

}
