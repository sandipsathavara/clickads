<?php

/**
 * User Myaccount
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
 * User Myaccount
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
class myaccountAction extends sfAction
{
    /**
     * My account .
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */
    public function execute($request)
    {
        //--- Get PHP Pager ---//
        $this->pager = $this->getPager($request);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial('user/list', array('pager' => $this->pager));
        }

        //--- Set meta tags ---// 
        $this->getResponse()->setTitle(__('myaccount_page_title'));


        //--- Set Breadcrumb url ---//	
        $obj = new Breadcrumb();
        $obj->add(__('cap_my_ads', '', 'myaccount'), $request->getUri(), 1);
    }

    /**
     * My account .
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */
    protected function getPager($request)
    {
        $pager = new sfDoctrinePager('Posts', sfConfig::get('app_my_account_pagination'));
        $pager->setPage($request->getParameter('page', 1));

        //--- Get Pager Query ---//
        $q = $pager->getQuery()
            ->select('p.*,pi.image as image')
            ->from('Posts p')
            ->leftJoin('p.PostImages pi')
            ->addWhere('user_id = ?', $this->getUser()->getAttribute('id', '', 'oUserInfoClient'))
            ->addWhere('lang = ?', $this->getUser()->getCulture())
            ->orderBy('p.created_at DESC');

        $pager->init();
        return $pager;
    }

}
