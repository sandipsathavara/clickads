<?php

/**
 * CategoriesForm
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
 * CategoriesForm
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
class CategoriesForm extends BaseCategoriesForm
{
    /**
     * Configure
     *
     * @return void
     */
    public function configure()
    {
        unset($this['created_at'], $this['updated_at'], $this['root'], $this['lft'], $this['rgt'], $this['level']);

        $objLang = LanguagesTable::getAllActiveLanguage();
        $objLangLable = LanguagesTable::getAllActiveLanguageFullName();

        //--- Embed I18N form ---//  
        $this->embedI18n($objLang);

        //--- Display Language Lable ---//
        foreach ($objLangLable as $lang) {
            $this->widgetSchema->setLabel($lang['culture'], $lang['name']);
        }
    }

    /**
    * setup
    *
    * @return void
    */
    public function setup()
    {
        
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'parent_id' => new sfWidgetFormDoctrineChoice(array(
                'model' => $this->getModelName(),
                'add_empty' => '~ (object is at root level)',
                'order_by' => array('root_id, lft', ''),
                'method' => 'getIndentedName',
                'table_method' => 'doSelect'
                    ), array('class' => 'styled')),
        ));


        $this->setDefault('parent_id', $this->getObject()->getParentId());

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'parent_id' => new sfValidatorDoctrineChoice(array(
                'required' => false,
                'model' => $this->getModelName())),
        ));


        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Categories', 'column' => array('slug')))
        );


        $this->widgetSchema->setNameFormat('categories[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

    /**
     * Update parentId field 
     * 
     * @param string $parentId parent id from post value
     * 
     * @return void
     */
    public function updateParentIdColumn($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * Update slug field value
     *
     * @return string     
     */
    public function updateSlugColumn()
    {
        //--- Create slug on base of category name ---//
        $cat_name = $this->getValue('en');

        return slugify($cat_name['name']);
    }

    /**
     * Save Categories in tree format
     * 
     * @param string $con connection
     * 
     * @return string   
     */
    protected function doSave($con = null)
    {
        parent::doSave($con);

        $node = $this->object->getNode();

        if ($this->parentId != $this->getObject()->getParentId() || !$node->isValidNode()) {
            if (empty($this->parentId)) {
                //--- Save as a root ---//
                if ($node->isValidNode()) {
                    $node->makeRoot($this->object['id']);
                    $this->getObject()->save($con);
                } else {
                    //--- calls $this->object->save internally ---//
                    $this->getObject()->getTable()->getTree()->createRoot($this->getObject());
                }
            } else {
                //--- form validation ensures an existing ID for $this->parentId ---//
                $parent = $this->object->getTable()->find($this->parentId);
                $method = ($node->isValidNode() ? 'move' : 'insert') . 'AsFirstChildOf';
                $node->$method($parent);
            }
        }
    }

}
