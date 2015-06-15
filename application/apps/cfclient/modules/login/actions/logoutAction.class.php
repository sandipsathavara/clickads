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
sfProjectConfiguration::getActive()->loadHelpers('I18N');
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
class logoutAction extends sfAction
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function execute($request)
    {
        if ($this->getUser()->isAuthenticated()) {
            $this->getUser()->logoutUser();
            $this->getUser()->setFlash('error', __('cap_logout_success', '', 'login'));
        }
        $this->redirect('login/index');
    }

}

?>
