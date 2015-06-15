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
sfProjectConfiguration::getActive()->loadHelpers(array('I18N', 'General', 'Url'));

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
class homeActions extends sfActions
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
        $this->oCountryStates = CountriesTable::getCountryNameWithState();

        //--- Set Breadcrumb url ---//	
        $obj = new Breadcrumb();
        $obj->add(__('cap_home'), $request->getUri(), 0);

        //--- Set meta tags ---// 
        $this->getResponse()->setTitle(__('home_page_title'));
        $this->getResponse()->addMeta('description', __('home_page_description'));
        $this->getResponse()->addMeta('keywords', __('home_page_keywords'));
    }

    /**
     * Executes all states action
     *
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executeAllStates(sfWebRequest $request)
    {
        $this->oStates = StatesTable::getAllStates();

        //--- Set Breadcrumb url ---//	
        $obj = new Breadcrumb();
        $obj->add(__('cap_more_states_cities'), '@homepage', 1);

        //--- Set meta tags ---// 
        $this->getResponse()->setTitle(__('cap_more_states_cities'));
        $this->getResponse()->addMeta('description', __('home_page_description'));
        $this->getResponse()->addMeta('keywords', __('home_page_keywords'));
    }

    /**
     * Executes state action
     *
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executeState(sfWebRequest $request)
    {
        //--- Get state Id from slug ---//
        $id = getIdFromSulg($request->getParameter('state_slug'));

        //--- Get State Name  ---//
        $stateName = getNameFromSulg($request->getParameter('state_slug'));

        //--- Get Cities By Cities Id ---//
        $this->objRs = StatesTable::getCitiesByStateId($id);

        //--- Redirect 404 if State not exist in DB ---//
        $this->forward404Unless($this->objRs);

        //--- set cookies for state_id ---//
        $this->getResponse()->setCookie('state_id', $id, time() + 24 * 3600 * 30, "/", getDomain($request->getHost()));

        //--- Set Breadcrumb url ---//	
        $obj = new Breadcrumb();
        $obj->add(ucfirst($stateName), $request->getUri(), 1);

        //--- Set meta tags ---// 
        $this->getResponse()->setTitle(__('state_page_title', array('%state%' => ucfirst($stateName))));
        $this->getResponse()->addMeta('description', __('state_page_description', array('%state%' => ucfirst($stateName))));
    }

    /**
     * Create Category list   
     *  
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executeCategory(sfWebRequest $request)
    {
        
        if (!$request->getCookie('flag')) {
            $this->executeChangeprovince($request);
        }

        //--- Get Category By Category slug ---//
        $this->objRs = CategoriesTable::getCategory();

        //--- Redirect 404 if State not exist in DB ---//
        $this->forward404Unless($this->objRs);

        //--- Set Breadcrumb url ---//
        $obj = new Breadcrumb();
        $obj->add(__('cap_home'), $request->getUri(), 0);

        //--- Set meta tags ---// 
        $this->getResponse()->setTitle(__('home_page_title', array('%location%' => strtolower($request->getCookie('name')))));
        $this->getResponse()->addMeta('description', __('category_page_description', array('%location%' => ucfirst($request->getCookie('name')))));
    }

    /**
     * Change Language  
     *  
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executeLanguage(sfWebRequest $request)
    {
        $sf_culture = $request->getParameter('sf_culture');

        //--- Set Default culture ---//
        $this->getUser()->setAttribute('language', $request->getParameter('language'));
        $this->getUser()->setCulture($sf_culture);
        $this->redirect($request->getReferer());
    }

    /**
     * CMS Pages  
     *  
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executePage(sfWebRequest $request)
    {

        $page = $request->getParameter('page');

        $this->objRs = PagesTable::getPageBySlug($page);

        //--- Redirect 404 if State not exist in DB ---//
        $this->forward404Unless($this->objRs);

        //--- Set Breadcrumb url ---//
        $obj = new Breadcrumb();
        $obj->add(ucfirst($this->objRs->getTitle()), '@cms_page?page=' . $page, 1);

        //--- Set meta tags ---// 
        $this->getResponse()->setTitle($this->objRs->getTitle());
        $this->getResponse()->addMeta('description', $this->objRs->getTitle());
    }

    /**
     * Error404  
     *  
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executeError404(sfWebRequest $request)
    {
        
    }

    /**
     * Executes category action  
     *  
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executeChangeprovince(sfWebRequest $request)
    {
        $arrLocation = array();

        switch ($request->getParameter('flag')) {
            case 'city';

                $this->arrLocation = CitysTable::getSingleCityName();
                $this->arrLocation['flag'] = 'city';
                break;

            case 'state';

                $this->arrLocation = StatesTable::getSingleStateName();
                $this->arrLocation['flag'] = 'state';

                break;
            default :
                $this->arrLocation = CountriesTable::getSingleCountryName();
                $this->arrLocation['flag'] = 'country';
        }
        
        
        //--- Redirect 404 if City not exist in DB ---//
        $this->forward404Unless($this->arrLocation);

        //--- Set City Id when user post ---//	  
        if (is_array($this->arrLocation)) {

            //--- set cookies for selection  ---//
            $this->getResponse()->setCookie('id', $this->arrLocation['id'], time() + 24 * 3600 * 30, "/", getDomain($request->getHost()));
            $this->getResponse()->setCookie('flag', $this->arrLocation['flag'], time() + 24 * 3600 * 30, "/", getDomain($request->getHost()));
            $this->getResponse()->setCookie('name', urlencode($this->arrLocation['name']), time() + 24 * 3600 * 30, "/", getDomain($request->getHost()));
        }
        
        if ($request->getReferer() && !$request->getParameter('isall')) {
            $this->redirect($request->getReferer());
        } else {
            $this->redirect('@homepage');
        }
        
        return is_array($this->arrLocation) ? $this->arrLocation : array();
    }

    /**
     * Change Province  
     *  
     * @param sfRequest $request A request object
     * 
     * @return void
     */
    public function executeProvince(sfWebRequest $request)
    {
        $this->oStates = StatesTable::getPopularStateOfCountry();
        $this->oCities = CitysTable::getPopularCitiesOfCountry();
        $this->setlayout('popup');
    }

}
