<?php 

/**
 * change password
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

sfProjectConfiguration::getActive()->loadHelpers('I18N'); 

/**
 * change password
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
class changepasswordAction extends sfAction
{
    /**
     * changepassword
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */
    public function execute($request)
    {  
        //--- Create Form Object ---//
        $this->oForm = new ResetPasswordForm();

        if ($request->isMethod('post')) {
            
            $this->oForm->bind($request->getParameter($this->oForm->getName()));

            if ($this->oForm->isValid()) {	

                if ($oUser = UsersTable::isPasswordExist($this->oForm)) {	
                        $salt = generateSalt($oUser->getEmail());
                        generatePassword($salt, $this->oForm->getValue('password'));	

                        $oUser->setPassword(generatePassword($salt, $this->oForm->getValue('password')));
                        $oUser->setSalt($salt);
                        $oUser->save();

                        $this->getUser()->setFlash('error', __('msg_password_change_successful', '', 'changepass'));
                } else {
                        $this->getUser()->setFlash('error', __('msg_worng_old_password', '', 'changepass'));
                }
                $this->redirect('@reset_password'); 	
            }
        }   
        //--- Set page title ---// 
        $this->getResponse()->setTitle(__('chanage_password_title', '', 'changepass'));
    }	
}

