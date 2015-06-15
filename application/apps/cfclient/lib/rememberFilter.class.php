<?php


/**
 * Prepar remmeber me password
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
 * Prepar setting for site
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

class rememberFilter extends sfFilter
{
    /**
     * Prepar remmeber me.
     *
     * @param sfFilter $filterChain .
     *
     * @return string
     */
    public function execute($filterChain)
    {

        //--- execute this filter only once ---//
        if ($this->isFirstCall()) {
            if ($cookie = $this->getContext()->getRequest()->getCookie('loadBox')) {
                $value = unserialize(base64_decode($cookie));

                $oUser = UsersTable::checkIsEmailExist($value[1]);

                if ($oUser) {
                    //--- Login ---//
                    $this->getContext()->getUser()->setSessionUser($oUser);
                }
            }
        }
        //--- execute next filter ---//
        $filterChain->execute();
    }

}
