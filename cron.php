<?php

/**
 * Front devevelope Action 
 * 
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com
 * Copyright (c) Experts Web Solution  2012-2013
 */
require_once(dirname(__FILE__) . '/application/config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('cfclient', 'dev', true);

sfProjectConfiguration::getActive()->loadHelpers(array('General'));

new sfDatabaseManager($configuration);


//--- Delete post ---//
$objPosts = PostsTable::deleteFreePosts();

foreach ($objPosts as $post) :

    //--- Remove Images for this post ---//		
    rrmdir(sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . $post->getId());

    //--- Delete Post ---//
    $q = Doctrine_Query::create()
            ->delete('Posts')
            ->where('id = ?', $post->getId())
            ->limit(1);

    $q->execute();

endforeach;


$objPosts = PostsTable::featureToFreePosts();

die('Done');




