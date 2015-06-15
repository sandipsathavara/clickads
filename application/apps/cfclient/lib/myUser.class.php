<?php

/**
 * Prepar user session
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
 * Prepar user session
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
class myUser extends sfBasicSecurityUser
{
    /**
     * Prepar remmeber me.
     *
     * @param boolean $boolean boolean value
     *
     * @return void
     */    
    public function isFirstRequest($boolean = null)
    {
        if (is_null($boolean)) {
            return $this->getAttribute('first_request', true);
        } else {
            $this->setAttribute('first_request', $boolean);
        }    
    }

    /**
     * Executes method login and set authenticate for login user, make credential, set attribute
     * 
     * @param mix     $oUser    user object
     * @param boolean $remember boolean value
     * 
     * @return void
     */
    public function setSessionUser($oUser, $remember = false)
    {
        $this->setAuthenticated(true);
        $this->addCredential($oUser->getUserType());
        $this->setAttribute('id', $oUser->getId(), 'oUserInfoClient');
        $this->setAttribute('email', $oUser->getEmail(), 'oUserInfoClient');
        $this->setAttribute('nickname', $oUser->getNickname(), 'oUserInfoClient');
        $this->setAttribute('type', $oUser->getUserType(), 'oUserInfoClient');
        $this->setAttribute('status', $oUser->getStatus(), 'oUserInfoClient');


        if ($remember) {
            $value = base64_encode(serialize(array($oUser->getSalt(), $oUser->getEmail())));
            sfContext::getInstance()->getResponse()->setCookie('loadBox', $value, (time() + (int) sfConfig::get('app_login')), '/');
        }
    }

    /**
     * Executes method logout and unset authenticate for login user, remove credential, unset attribute
     * 
     * @return void
     */
    public function logoutUser()
    {
        $this->getAttributeHolder()->removeNamespace('oUserInfoClient');
        $this->getAttributeHolder()->removeNamespace('sess_postad');
        $this->setAuthenticated(false);
        $this->clearCredentials();
        sfContext::getInstance()->getResponse()->setCookie('loadBox', '', time() - 3600, '/');
    }

}