<?php

/**
 * Posts
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
 * Posts
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
class Posts extends BasePosts
{
    /**
     * get Nickname
     *
     * @return object
     */
    public function getNickname()
    {
        return $this->getUsers()->getNickname();
    }
    
    /**
     * get Category
     *
     * @return object
     */
    public function getCategory()
    {
        return $this->getCategories()->getName();
    }

}