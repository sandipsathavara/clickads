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

sfProjectConfiguration::getActive()->loadHelpers(array('I18N', 'General', 'Url'));

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
class searchAction extends sfAction
{
    /**
     * Classifled Search
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
            return $this->renderPartial('home/searchResult', array('pager' => $this->pager));
        }

        $this->setLayout('listlayout');
    }

    /**
     * Pager 
     *
     * @param sfRequest $request request parameter
     *
     * @return $pager
     */ 
    protected function getPager($request)
    {
        //--- Create BreadCrum Url ---//
        $obj = new Breadcrumb();
        $obj->add(ucfirst(__('cap_search')), $request->getUri(), 1);

        $pager = new sfDoctrinePager('Posts', sfConfig::get('app_post_pagination'));
        $pager->setPage($request->getParameter('page', 1));

        $q = $pager->getQuery()
            ->select('p.*,pi.image as image,c.currency,ct.id')
            ->from('Posts p')
            ->leftJoin('p.PostImages pi')
            ->leftJoin('p.Citys ct')
            ->leftJoin('ct.Countries c')
            ->leftJoin('p.Categories cat')
            ->addWhere('p.lang = "' . $this->getUser()->getCulture() . '"')
            ->addWhere('p.title LIKE ?', '%' . $request->getParameter('q') . '%')
            ->addWhere('(pi.is_cover = 1 OR pi.is_cover IS NULL)')
            ->orderby('p.created_at DESC');

        if ($request->getParameter('cat')) {
            $q->addWhere('cat.id = "' . $request->getParameter('cat') . '"');
        }

        $pager->init();
        return $pager;
    }

}

