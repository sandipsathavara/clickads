<?php

/**
 * EmailsTranslationFormFilter
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
 * EmailsTranslationFormFilter
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
class EmailsTranslationFormFilter extends BaseEmailsTranslationFormFilter
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
     * Setup form
     *
     * @return void
     */
    public function setup()
    {
        $this->setWidgets(array(
            'title' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'from_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'subject' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'body' => new sfWidgetFormFilterInput(array('with_empty' => false)),
        ));

        $this->setValidators(array(
            'title' => new sfValidatorPass(array('required' => false)),
            'from_name' => new sfValidatorPass(array('required' => false)),
            'subject' => new sfValidatorPass(array('required' => false)),
            'body' => new sfValidatorPass(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('emails_translation_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

}
