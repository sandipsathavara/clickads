<?php

/**
 * SettingGroupForm
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
 * SettingGroupForm
 * 
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com
 * Copyright (c) Experts Web Solution  2012-2013
 * 
 */
class SettingGroupForm extends sfForm
{

    /**
     * Configure
     *
     * @return void
     */
    public function configure()
    {

        $obj = SettingTable::getAllSettingByName();

        $settingWrapperForm = new sfForm();

        foreach ($obj as $objForm) {
            $settingWrapperForm->embedForm($objForm->getName(), new SettingForm($objForm));
        }

        
        

        $this->embedForm('setting', $settingWrapperForm);
        $this->widgetSchema->setNameFormat('setting_field[%s]');
    }

    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $values = $this->getValues();

        foreach ($this->embeddedForms['setting']->getEmbeddedForms() as $key => $oForm) {

            if ($values['setting'][$key]['name']) {
                 
                switch ($values['setting'][$key]['name']) {
                    case 'site_logo':
                       
                        if ($values['setting']['site_logo']['value'] ) {
                            $values['setting']['site_logo']['value']->save('bq_logo.png',0777);
                        }
                        break;

                    case 'favicon':

                        if ($values['setting']['favicon']['value'] ) {
                            $values['setting']['favicon']['value']->save('favicon.png',0777);
                        }
                        break;

                    default:
                        $oForm->updateObject($values['setting'][$key]);
                        break;
                }
                
                
                $oForm->getObject()->save();
               
            }
            
             
        }
        
       
    }

}
