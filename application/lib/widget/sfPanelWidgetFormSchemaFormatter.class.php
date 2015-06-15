<?php 
/**
 * sfPanelWidgetFormSchemaFormatter form.
 *
 * @package    classifieds
 * @subpackage form
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: sfPanelWidgetFormSchemaFormatter.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
 
class sfPanelWidgetFormSchemaFormatter extends sfWidgetFormSchemaFormatter
{

  protected
    $rowFormat                 = '',
    $helpFormat                = '%help%',
    $errorRowFormat            = '%errors%',
    $errorListFormatInARow     = "  %errors% ",
    $errorRowFormatInARow      = "    %error%",
    $namedErrorRowFormatInARow = "    %name%: %error%",
    $decoratorFormat           = '',
    $widgetSchema              = null,
    $translationCatalogue      = null;

}
