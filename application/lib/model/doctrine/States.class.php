<?php

/**
 * States
 *
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com/
 */

/**
 * States
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
class States extends BaseStates
{

    /**
     * Returns State Slug.
     *
     * @return object
     */
    public function getStateSlug()
    {
        return slugify($this->getName()) . '-' . $this->getId();
    }

    /**
     * Returns Country By Id.
     *
     * @return object
     */
    public function getCountryById()
    {
        return $this->getCountries()->getName();
    }

}