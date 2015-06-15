<?php

require_once dirname(__FILE__) . '/../lib/countriesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/countriesGeneratorHelper.class.php';

/**
 * countries actions.
 *
 * @package    classifieds
 * @subpackage countries
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com> 
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfProjectConfiguration::getActive()->loadHelpers(array('I18N', 'General', 'Url'));

class countriesActions extends autoCountriesActions
{

    public function executeListAddstate(sfWebRequest $request)
    {

        #--- Get Country Id From Query String ---#
        $country_id = $request->getParameter('id');

        #--- Country Id Is Not Exist In Query String ---#
        $this->forward404If(!$country_id);

        #--- Redirect To State Managment ---#
        $this->redirect('@states_by_country_id?country_id=' . $country_id);
    }

    public function executeImport(sfWebRequest $request)
    {
        $this->objForm = new ImportLocationForm();
        $this->objLang = LanguagesTable::getAllActiveLanguageFullName();

        if ($request->isMethod('post')) {
            
            $this->objForm->bind($request->getParameter('import'), $request->getFiles('import'));

            if ($this->objForm->isValid()) {
                
                $csvFile = $this->objForm->getValues();
                
                foreach ($this->objLang as $k => $v) {
                    $csvFile['file_'.$v['culture']]->save('import_location_'.$v['culture'].'.csv', 0777);
                    $data = csv2Array(sfConfig::get('sf_upload_dir') . '/import_location_'.$v['culture'].'.csv');
                    
                    
                    print_r($data);
                    
                    //unlink(sfConfig::get('sf_upload_dir') . '/import_location'.$v['culture'].'.csv');
                }
                die();

                if ($oUser) {
                    $this->getUser()->setFlash('error', 'Username or Password worng');
                }

                $this->redirect('login/index');
            }
        }
    }

}
