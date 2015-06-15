<?php

/**
 * UsersFormFilter
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
 * UsersFormFilter
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
class UsersFormFilter extends BaseUsersFormFilter
{
    
    /**
     * Configure
     *
     * @return void
     */
    public function configure()
    {
        unset($this['created_at'], $this['updated_at'], $this['alert_flag'], $this['skype_flag'], $this['unique_code'], $this['watch_list_count'], $this['last_login'], $this['ip_address'], $this['ads_count'], $this['post_ads_limit'], $this['ads_count'], $this['password']
        );
    }

    /**
     * Setup form
     *
     * @return void
     */
    public function setup()
    {
        $this->setWidgets(array(
            'email' => new sfWidgetFormFilterInput(array('with_empty' => false), array('class' => 'text small')),
            'nickname' => new sfWidgetFormFilterInput(array('with_empty' => false), array('class' => 'text small')),
            'status' => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Enable', 0 => 'Disable')), array('class' => 'styled')),
        ));

        $this->setValidators(array(
            'email' => new sfValidatorPass(array('required' => false)),
            'nickname' => new sfValidatorPass(array('required' => false)),
            'status' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        ));

        $this->widgetSchema->setNameFormat('users_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

}
