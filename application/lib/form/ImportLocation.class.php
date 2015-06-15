<?php

/**
 * ImportLocationForm
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
 * ImportLocationForm
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
class ImportLocationForm extends sfForm
{

    /**
     * Configure
     *
     * @return void
     */
    public function configure()
    {
        $objLang = LanguagesTable::getAllActiveLanguageFullName();
        $arrFile = array();
        $arrFileValidator = array();
        
        //--- Display Language Lable ---//
        foreach ($objLang as $lang) {
          $arrFile['file_'.$lang['culture']] = new sfWidgetFormInputFile();
          
          $arrFileValidator['file_'.$lang['culture']] = new sfValidatorFile(array(
                'path' => sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR,
                'mime_types' => array('text/comma-separated-values',
                    'text/csv',
                    'application/csv',
                    'application/excel',
                    'application/vnd.ms-excel',
                    'application/vnd.msexcel',
                    'text/anytext')), array(
                'invalid' => 'Invalid file.',
                'required' => 'Select a file to upload.',
                'mime_types' => 'The file must be a supported type.'
                    ));
          
        }
        
        //$arrFile['lang'] = new sfWidgetFormInputHidden();
        
        $this->setWidgets($arrFile);

        $this->widgetSchema->setNameFormat('import[%s]');

        
        //$arrFileValidator['lang'] = new sfValidatorString (array('required'=>false));
        
        
        $this->setValidators($arrFileValidator);
    }

}

