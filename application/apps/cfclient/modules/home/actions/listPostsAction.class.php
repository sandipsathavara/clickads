<?php

/**
 * listpostsAction
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
 * listpostsAction
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

class listpostsAction extends sfAction
{
    /**
     * List of Classifleds 
     *
     * @param sfRequest $request request parameter
     *
     * @return void
     */
    public function execute($request)
    {
        //--- Get PHP Pager ---//
        $this->pager = $this->getPager($request);
        $this->pagerFeature = $this->getPager($request, true);

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial('home/listposts', array('pager' => $this->pager, 'pagerFeature' => $this->pagerFeature));
        }

        $this->setLayout('listlayout');
    }

    /**
     * Prepar list of Classifleds pagination  
     *
     * @param sfRequest $request    request parameter
     * @param boolean   $is_feature boolean value
     *
     * @return object
     */
    protected function getPager($request, $is_feature = false)
    {
        //--- Get Integer from slug ---//
        $id = getIdFromSulg($request->getParameter('sub_cat_slug'));

        $state_id = $request->getCookie('state_id');
        if (!isset($id)) {
            $this->getUser()->setFlash('worning', __('cap_select_path'));
            $this->redirect('/');
        }

        //--- Create BreadCrum Url ---//
        $obj = new Breadcrumb();

        $cat_slug = ucfirst(getNameFromSulg($request->getParameter('cat_slug')));
        $sub_cat_slug = ucfirst(getNameFromSulg($request->getParameter('sub_cat_slug')));

        $obj->add($sub_cat_slug, $request->getUri(), 3);

        $this->getResponse()->setTitle($cat_slug . " | " . $sub_cat_slug);
        $this->getResponse()->addMeta('description', $cat_slug . " | " . $sub_cat_slug);

        $pager = new sfDoctrinePager('Posts', sfConfig::get('app_post_pagination'));
        $pager->setPage($request->getParameter('page', 1));

        $q = $pager->getQuery()
            ->select('p.*,pi.image as image,c.currency,ct.id')
            ->from('Posts p')
            ->leftJoin('p.PostImages pi')
            ->leftJoin('p.Citys ct')
            ->leftJoin('p.Countries c')
            ->addWhere('p.lang = "' . $this->getUser()->getCulture() . '"')
            ->addWhere('(pi.is_cover = 1 OR pi.is_cover IS NULL)')
            ->addWhere('p.status = ?', 'publish')
            ->orderby('p.created_at DESC');

        switch ($request->getCookie('flag')) {
        case 'city':
            $q->addWhere('p.city_id = ? ', $request->getCookie('id'));
            break;

        case 'state':
            $q->addWhere('p.state_id = ? ', $request->getCookie('id'));
            break;
        }

        $q->addWhere('p.cat_id = ?', $id);
        if ($is_feature == true) {    
            $q->addWhere('p.is_featured = 1');
        } else {
            $q->addWhere('p.is_featured = 0');
        }
        
        $pager->init();
        return $pager;
    }

}

