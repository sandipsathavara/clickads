<?php

/**
 * PostImagesForm
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
 * PostImagesForm
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
class PostImagesForm extends BasePostImagesForm
{
    /**
     * configure
     *
     * @return void
     */
    public function configure()
    {
        unset($this['created_at'], $this['updated_at']);
    }
    /**
     * setup
     *
     * @return void
     */
    public function setup()
    {

        $post_id = sfContext::getInstance()->getUser()->getAttribute('post_id', '', 'sess_postad');

        //-- Get Default culture ---//
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'post_id' => new sfWidgetFormInputHidden(),
            // 'caption'    => new sfWidgetFormInputText(),
            'image' => new sfWidgetFormInputFile(),
        ));

        //--- Set form InputHidden value ---//
        $this->setDefault("post_id", $post_id);

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'post_id' => new sfValidatorString(array('required' => false), array()),
            // 'caption'    => new sfValidatorString(array('max_length' => 25,'required' => false)),
            'image' => new sfValidatorFile(array(
                'required' => false,
                'path' => sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . 'o',
                'mime_types' => 'web_images',
                    )),
        ));

        $this->widgetSchema->setNameFormat('post_images[%s]');
    }

}
