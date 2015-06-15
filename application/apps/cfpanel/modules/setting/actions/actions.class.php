<?php

/**
 * setting actions.
 *
 * @package    classifieds
 * @subpackage setting
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfProjectConfiguration::getActive()->loadHelpers(array('General','Url'));

class settingActions extends sfActions
{

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->oForm = new SettingGroupForm();

        if ($request->isMethod('post')) {
            $this->oForm->bind($request->getParameter('setting_field'), $request->getFiles('setting_field'));
            
            if ($this->oForm->isValid()) {
                $this->oForm->save();
                
                deleteCache();

                $this->getUser()->setFlash('notice', 'Setting has been updated successfully');
                $this->redirect('setting/index');
            }
        }
    }

    public function executeFeaturelist(sfWebRequest $request)
    {
        $this->oForm = new SettingGroupForm();

        if ($request->isMethod('post')) {
            $this->oForm->bind($request->getParameter('setting_field'), $request->getFiles('setting_field'));

            if ($this->oForm->isValid()) {
                $this->oForm->save();

                $this->getUser()->setFlash('notice', 'Setting has been updated successfully');
                $this->redirect('setting/featurelist');
            }
        }
    }

}
