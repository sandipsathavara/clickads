<?php

/**
 * posts module helper.
 *
 * @package    classifieds
 * @subpackage posts
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class postsGeneratorHelper extends BasePostsGeneratorHelper
{

  public function linkToStatus($object, $params)
  {
  	$status = $object->getStatus()=='publish' ? 'unpublish' : 'publish';
    return link_to(__( ucfirst($object->getStatus()), array(), 'sf_admin'), url_for('@change_status?id='.$object->getId()."&status=".$status));
  }


}


