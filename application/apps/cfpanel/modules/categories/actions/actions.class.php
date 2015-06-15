<?php

require_once dirname(__FILE__) . '/../lib/categoriesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/categoriesGeneratorHelper.class.php';

/**
 * categories actions. 
 *
 * @package    classifieds
 * @subpackage categories
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
sfContext::getInstance()->getConfiguration()->loadHelpers('General');

class categoriesActions extends autoCategoriesActions
{

    protected function addSortQuery($query)
    {

        //don't allow sorting; always sort by tree and lft
        $query->addOrderBy('root_id, lft');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $category =Doctrine_Core::getTable('Categories')->find($request->getParameter('id'));
        $category->getNode()->delete();
        
        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('@categories');
    }

    public function executeSaveorder(sfWebRequest $request)
    {
        if ($request->isXmlHttpRequest()) {
            $true = CategoriesTable::setCategoryOrder($request->getParameter('order'));
        }
        die;
    }

    public function executeListNew(sfWebRequest $request)
    {
        $this->executeNew($request);
        $this->form->setDefault('parent_id', $request->getParameter('id'));
        $this->setTemplate('edit');
    }

    public function executeBatch(sfWebRequest $request)
    {

        if ("batchOrder" == $request->getParameter('batch_action')) {
            return $this->executeBatchOrder($request);
        }

        parent::executeBatch($request);
    }

    public function executeBatchOrder(sfWebRequest $request)
    {
        $newparent = $request->getParameter('newparent');

        //make list of all ids
        $ids = array();
        foreach ($newparent as $key => $val) {
            $ids[$key] = true;
            if (!empty($val))
                $ids[$val] = true;
        }
        $ids = array_keys($ids);


        //validate if all id's exist
        try {
            $count = 0;
            $flash = "";

            foreach ($newparent as $id => $parentId) {
                if (!empty($parentId)) {
                    $node = Doctrine::getTable('Categories')->find($id);
                    $parent = Doctrine::getTable('Categories')->find($parentId);

                    if (!$parent->getNode()->isDescendantOfOrEqualTo($node)) {
                        $node->getNode()->moveAsFirstChildOf($parent);
                        $node->save();

                        $count++;

                        $flash .= "  Moved '" . $node['name'] . "' under '" . $parent['name'] . "'.";
                    }
                }
            }

            if ($count > 0) {
                $this->getUser()->setFlash('notice', sprintf("Tree order updated, moved %s item%s:" . $flash, $count, ($count > 1 ? 's' : '')));
            } else {
                $this->getUser()->setFlash('error', "You must at least move one item to update the tree order");
            }
        } catch (sfValidatorError $e) {
            $this->getUser()->setFlash('error', 'Cannot update the tree order, maybe some item are deleted, try again');
        }

        $this->redirect('@categories');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
       
        if ($form->isValid()) {
            $this->getUser()->setFlash('notice', $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.');

            $categories = $form->save();

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $categories)));

            if ($request->hasParameter('_save_and_add')) {
                $this->redirect('@categories_new');
            } else {
                $this->redirect(array('sf_route' => 'categories_edit', 'sf_subject' => $categories));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}
