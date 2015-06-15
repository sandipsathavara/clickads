<?php

require_once dirname(__FILE__) . '/../lib/citysGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/citysGeneratorHelper.class.php';

/**
 * citys actions. 
 *
 * @package    classifieds
 * @subpackage citys
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>  
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $ 
 */
sfContext::getInstance()->getConfiguration()->loadHelpers(array('jQuery', 'Url'));

class citysActions extends autoCitysActions
{

    public function executeGetStateByCountryId(sfWebRequest $request)
    {

        #--- Check is xml http request ---# 
        if ($request->isXmlHttpRequest()) {

            #--- Get Country Id from request ---# 
            $cid = $request->getParameter('cid');

            #--- Fetch states by country id ---# 
            $rsStates = StatesTable::getStatesNameByCountryId($cid);


            #--- Prepar option for states dorpdown ---# 
            $output = '<option value="">Please Select</option>';
            foreach ($rsStates as $v)
                $output .= '<option value="' . $v->id . '">' . $v->name . '</option>';

            #--- Rander states options ---# 
            return $this->renderText($output);
        }
    }

    public function executeAddcity(sfWebRequest $request)
    {
        #--- Get Country Id from request ---# 
        $state_id = $request->getParameter('state_id');
        $this->forward404If(!$state_id);

        #--- Get country_id from query string ---# 
        $country_id = $request->getParameter('country_id');
        $this->forward404If(!$country_id);

        #--- Get Object Assign Value To For Country --- #  
        $this->form = $this->configuration->getForm();

        #--- Set Value For Country --- #  
        $this->form->setDefault('country_id', $country_id);
        $this->form->setDefault('state_id', $state_id);

        #--- Get Blank Object for State --- # 
        $this->citys = $this->form->getObject();

        #--- Set Templete New --- #
        $this->setTemplate('new');
    }

}
