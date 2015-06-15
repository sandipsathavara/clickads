<?php
require_once(dirname(__FILE__).'/application/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('cfpanel', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
