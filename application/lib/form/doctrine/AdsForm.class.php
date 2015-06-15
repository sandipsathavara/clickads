<?php

/**
 * AdsForm
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
 * AdsForm
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
class AdsForm extends BaseAdsForm
{
    /**
     * Configure
     *
     * @return void
     */
    public function configure()
    {
        
    }

    /**
     * setup
     *
     * @return void
     */
    public function setup()
    {

        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'page' => new sfWidgetFormChoice(array('choices' => sfConfig::get('app_pages')), array('class' => 'styled')),
            'position' => new sfWidgetFormChoice(array('choices' => sfConfig::get('app_ad_position')), array('class' => 'styled')),
            'ad_type' => new sfWidgetFormChoice(array('expanded' => true, 'multiple' => false, 'choices' => sfConfig::get('app_ad_type')), array('class' => 'radio')),
            'banner_image' => new sfWidgetFormInputFileEditable(array(
                'label' => 'Banner Image',
                'file_src' => '/uploads/ads/' . $this->getObject()->getBannerImage() . '?' . rand(),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'with_delete' => false,
                'template' => '<div>%input%<br/><br/>%file%</div>',
                    ), array('class' => 'styled')),
            'ad_data' => new sfWidgetFormTextarea(array(), array('class' => 'text small')),
            'target_url' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'date' => new sfWidgetFormDateRange(array(
                'from_date' => new sfWidgetFormInputText(array(), array('class' => 'text date_picker')),
                'to_date' => new sfWidgetFormInputText(array(), array('class' => 'text date_picker')),
                'template' => 'Start Date: %from_date%&nbsp;&nbsp;&nbsp;&nbsp;End Date: %to_date%',
                    )),
            /* 'date'          => new sfWidgetFormDateRange(array(
              'from_date' => new sfWidgetFormJQueryDate() ,
              'to_date'   => new sfWidgetFormJQueryDate() ,
              'template'  => 'Start Date: %from_date%&nbsp;&nbsp;&nbsp;&nbsp;End Date: %to_date%',
              )) , */
            'is_published' => new sfWidgetFormInputCheckbox(),
        ));


        //--- Get All Values ---//
        $adsValues = sfContext::getInstance()->getRequest()->getParameter('ads');

        $arrImageParam = sfConfig::get('app_' . $adsValues['position']);

        list($width, $height, $size) = array('100', '150', '1500');

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 255), array('required' => 'Name is required')),
            'page' => new sfValidatorString(array('max_length' => 255), array('required' => 'Page is required')),
            'position' => new sfValidatorString(array('max_length' => 255), array('required' => 'Position is required')),
            'ad_type' => new sfValidatorString(array('max_length' => 255), array('required' => 'Ad type is required')),
            'ad_data' => new sfValidatorString(array('required' => ( $adsValues['ad_type'] != 'BANNER') ? true : false), array('required' => 'Ad data is required')),
            'banner_image' => new sfImageFileValidator(array('path' => sfConfig::get('sf_upload_dir') . '/ads/',
                'required' => (!$this->isNew() || $adsValues['ad_type'] != 'BANNER') ? false : true,
                'mime_types' => 'web_images',
                'min_height' => $arrImageParam['height'],
                'min_width' => $arrImageParam['width'],
                'max_height' => $arrImageParam['height'],
                'max_width' => $arrImageParam['width'],
                'max_size' => $arrImageParam['size']), array('invalid' => 'Invalid file.',
                'required' => 'Select a file to upload.',
                'min_height' => "Custom message for height vaidation.",
                'min_width' => "File is too thin (minimum is %min_width% pixels, %width% given).",
                'min_height' => "Custom message for height vaidation.",
                'min_width' => "File is too thin (minimum is %min_width% pixels, %width% given).",
                'mime_types' => 'The file must be a supported type.( valid images are jpg,png,gif )')),
            'target_url' => new sfValidatorUrl(array('required' => false), array('invalid' => 'Invalid Target url, Enter like http://www.example.com')),
            'date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false))), array('invalid' => 'The date must be after the end date!')),
            'is_published' => new sfValidatorBoolean(array('required' => false)),
        ));


        //--- Add Default Values ---//
        $this->setDefault('position', 'SIDEBAR125');
        $this->setDefault('ad_type', 'BANNER');

        $this->widgetSchema->setNameFormat('ads[%s]');

        $this->setupInheritance();
    }

    /**
     * updateDefaultsFromObject
     *
     * @return void
     */    
    public function updateDefaultsFromObject()
    {
        parent::updateDefaultsFromObject();

        if (isset($this->widgetSchema['date'])) {
            $this->setDefault('date', array("from" => $this->getObject()->getStartDt(), "to" => $this->getObject()->getEndDt()));
        }
    }
    
    /**
     * processValues
     *
     * @param sting $values value of parameter
     * 
     * @return void
     */
    public function processValues($values)
    {
        $values = parent::processValues($values);

        $values['start_dt'] = $values["date"]["from"];
        $values['end_dt'] = $values["date"]["to"];

        return $values;
    }

}
