<?php

require_once dirname(__FILE__) . '/../lib/languagesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/languagesGeneratorHelper.class.php';

/**
 * languages actions.
 *
 * @package    classifieds
 * @subpackage languages
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com> 
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class languagesActions extends autoLanguagesActions
{

    public function executeSetDefault(sfWebRequest $request)
    {
        LanguagesTable::setDefaultLanguage($request->getParameter('id'));
        $this->getUser()->setFlash('msg', 'Language set as Default');
        $this->redirect('@languages');
    }

}
