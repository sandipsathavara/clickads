<?php 
/**
 * sfWidgetFormSchemaFormatterCustomList .
 *
 * @package    classifieds
 * @subpackage form
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: sfWidgetFormSchemaFormatterCustomTable.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class sfWidgetFormSchemaFormatterCustomList extends sfWidgetFormSchemaFormatter
{
	protected
      $rowFormat                 = '<li> %label% %field% %error% %help% %hidden_fields% <li>',
      $helpFormat                = '<span class="help">%help%</span>',
      $errorRowFormat            = 'Errors: %errors%',
      $errorListFormatInARow     = ' %errors% ',
      $errorRowFormatInARow      = '<span class="note error">%error%!</span>',
      $namedErrorRowFormatInARow = '',
      $decoratorFormat           = '<ul>%content%</ul>';
}




