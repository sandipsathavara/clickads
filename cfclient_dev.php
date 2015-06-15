<?php

/**
 * Front devevelope Action 
 * 
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com
 * Copyright (c) Experts Web Solution  2012-2013
 */
require_once(dirname(__FILE__) . '/application/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('cfclient', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
