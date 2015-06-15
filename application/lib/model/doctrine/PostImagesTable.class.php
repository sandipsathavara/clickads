<?php

/**
 * PostImagesTable
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
 * PostImagesTable
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
class PostImagesTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object PostImagesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PostImages');
    }

    /**
     * set Cover Image.
     * 
     * @param interger $post_id post id
     * @param interger $id      id
     * 
     * @return object PostImagesTable
     */
    public static function setCoverImage($post_id, $id)
    {
        //--- Update Post Images Covar Status ---// 
        $sql = Doctrine_Query::create()
                ->update('PostImages pi')
                ->set('pi.is_cover', 'IF (id=? , 1 , 0 )', $id)
                ->andWhere("pi.post_id = '$post_id'")
                ->limit(sfConfig::get('app_file_limit'))
                ->execute();
    }

}