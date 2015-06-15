<?php

require_once dirname(__FILE__).'/../lib/pagesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pagesGeneratorHelper.class.php';

/**
 * pages actions.
 *
 * @package    classifieds
 * @subpackage pages
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfProjectConfiguration::getActive()->loadHelpers(array('I18N','General','Url')); 
class pagesActions extends autoPagesActions
{
}
