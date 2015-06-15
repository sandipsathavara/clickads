<?php

/**
 * PostImages
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
 * PostImages
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
class PostImages extends BasePostImages
{

    /**
     * get Image Count      
     * 
     * @param interger $post_id post id
     * 
     * @return string
     */
    public static function getImageCount($post_id = '')
    {
        $images = PostImagesTable::getInstance()->findByPostId($post_id)->count();
        return $images >= sfConfig::get('app_file_limit') ? false : $images;
    }

    /**
     * return images by post_id 
     * 
     * @param interger $post_id post id
     * @param interger $id      id 
     * 
     * @return object
     */
    public static function getImageByPostId($post_id = '', $id = '')
    {
        return ($id == '') ?
                PostImagesTable::getInstance()->findByPostId($post_id) :
                PostImagesTable::getInstance()->findOneByPostIdAndId($post_id, $id);
    }

}