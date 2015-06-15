<?php

require_once dirname(__FILE__) . '/../lib/statesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/statesGeneratorHelper.class.php';

/**
 * states actions.
 *
 * @package    classifieds
 * @subpackage states
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com> 
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class statesActions extends autoStatesActions
{
    #--- Add State With Country ID ---#

    public function executeAddstate(sfWebRequest $request)
    {
        #--- Get country_id from query string ---# 
        $country_id = $request->getParameter('country_id');
        $this->forward404If(!$country_id);

        #--- Get Object Assign Value To For Country --- #  
        $this->form = $this->configuration->getForm();

        #--- Set Value For Country --- #  
        $this->form->setDefault('country_id', $country_id);

        #--- Get Blank Object for State --- # 
        $this->states = $this->form->getObject();

        #--- Set Templete New --- #
        $this->setTemplate('new');
    }

    #--- Redirect to city ---#

    public function executeAddcity(sfWebRequest $request)
    {
        #--- Get State Id From Query String ---#
        $state_id = $request->getParameter('id');

        #--- Country Id Is Not Exist In Query String ---#
        $this->forward404If(!$state_id);
        
        
        $objCountries = Doctrine_Core::getTable('States')->findOnebyId($state_id);
        
        #--- Country Id Is Not Exist In Query String ---#
        $this->forward404If(!$objCountries);

        #--- Redirect To City Managment ---#
        $this->redirect('@city_by_state_country_id?&state_id=' . $state_id.'&country_id='.$objCountries->getCountryId());
    }

}
