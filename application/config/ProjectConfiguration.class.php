<?php

set_time_limit(0);

require_once dirname(__FILE__) . '/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';

sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{

    public function setup()
    {
        #--- Change Path ---#
        sfConfig::set('sf_root_dir', $this->getRootDir());
        sfConfig::set('sf_upload_dir', sfConfig::get('sf_root_dir') . '/../uploads/');

        $this->enablePlugins(array('sfDoctrinePlugin', 'sfJqueryReloadedPlugin', 'sfCaptchaGDPlugin',
            'sfFormExtraPlugin', 'sfDomainRoutePlugin', 'sfImageTransformPlugin', 'sfDependentSelectPlugin',
            'sfPanelThemePlugin'));

        sfWidgetFormSchema::setDefaultFormFormatterName('CustomList');
    }

}

