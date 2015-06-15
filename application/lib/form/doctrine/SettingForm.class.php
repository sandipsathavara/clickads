<?php

/**
 * SettingForm
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
 * SettingForm
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
class SettingForm extends BaseSettingForm
{

    /**
     * configure
     *
     * @return void
     */
    public function setup()
    {
        switch ($this->getObject()->getType()) {
            case 'BOOLEAN':

                $arrWidgets = array(
                    'name' => new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getName())),
                    'value' => new sfWidgetFormInputCheckbox(array('value_attribute_value' => "on"), array('class' => 'checkbox')),
                );

                $arrValidators = array(
                    'name' => new sfValidatorString(),
                    'value' => new sfValidatorString(array('required' => false)),
                );
                break;

            case 'DROPDOWN':

                $arrWidgets = array(
                    'name' => new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getName())),
                    'value' => new sfWidgetFormI18nChoiceCurrency(array( 'culture' => 'en'), array('class' => 'styled')),
                );

                $arrValidators = array(
                    'name' => new sfValidatorString(),
                    'value' => new sfValidatorString(array('required' => false)),
                );

                break;

            case "FILE":

                $arrWidgets = array(
                    'name' => new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getName())),
                    'value' => new sfWidgetFormInputFileEditable(array(
                        'label' => 'Banner Image',
                        'file_src' => url_for('/images/' . $this->getObject()->getValue())."?".rand(),
                        'is_image' => true,
                        'edit_mode' => !$this->getObject()->isNew(),
                        'with_delete' => false,
                        'template' => '<div>%input%<br/><br/>%file%</div>',
                            ), array('class' => 'styled')));

                $arrValidators = array(
                    'name' => new sfValidatorString(),
                    'value' => new sfImageFileValidator(array('path' => $_SERVER['DOCUMENT_ROOT'].'/images',
                        'required' => (!$this->getObject()->isNew()) ? false : true,
                        'mime_types' => 'web_images',
                        'max_size' => 20000000), array('invalid' => 'Invalid file.',
                        'required' => 'Select a file to upload.',
                        'mime_types' => 'The file must be a supported type.( valid images are jpg,png,gif )')),
                );

                break;
            default:

                $arrWidgets = array(
                    'name' => new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getName())),
                    'value' => new sfWidgetFormInputText(),
                );

                $arrValidators = array(
                    'name' => new sfValidatorString(),
                    'value' => new sfValidatorString(),
                );
        }

        $this->setWidgets($arrWidgets);

        $this->setValidators($arrValidators);

        $this->widgetSchema->setNameFormat('setting[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

}
