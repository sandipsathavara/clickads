<?php
/**
 * Prepar Breadcrumb
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
 * Prepar Breadcrumb
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
class Breadcrumb
{
 
    var $output;
    var $crumbs = array();
    var $location;
    var $objUser;

    /**
     * Breadcrumb
     *
     * @return void
     */
    function Breadcrumb()
    {  
        $this->objUser = sfContext::getInstance()->getUser();

        if ($this->objUser->hasAttribute('breadcrumb', 'sessBreadcrumb')) {
            $this->crumbs = $this->objUser->getAttribute('breadcrumb', '', 'sessBreadcrumb');
        }  
    }

    /**
     * Add a crumb to the trail:
     * 
     * @param string $label The string to display
     * @param string $url   The url underlying the label
     * @param string $level The level of this link.  
     *
     * @return void
     */
    function add($label, $url, $level)
    {
        $crumb = array();
        $crumb['label'] = utf8_decode($label);
        $crumb['url'] = $url;

        if ($crumb['label'] != null && $crumb['url'] != null && isset($level)) {       
           
            while (count($this->crumbs) > $level) {
                 array_pop($this->crumbs); 
            }
          
            if (!isset($this->crumbs[0]) && $level > 0) { 
                $this->crumbs[0]['url'] = "/index.php";
                $this->crumbs[0]['label'] = __('cap_home');
            }
            $this->crumbs[$level] = $crumb;  
        }

         $this->objUser->setAttribute('breadcrumb', $this->crumbs, 'sessBreadcrumb'); //Persist the data
         $this->crumbs[$level]['url'] = null; //Ditch the underlying url for the current page.
    }

    
    /**
     * Output a semantic list of links.  See above for sample CSS.  Modify this to suit your design.
     * 
     * @return void
     */
    function output()
    {
        $crumbs = $this->objUser->getAttribute('breadcrumb', '', 'sessBreadcrumb');
        echo "<ul>";
        foreach ($crumbs as $crumb) {  
            if ($crumb['url'] != null) {
                echo "<li>"; 
                echo link_to(utf8_encode($crumb['label']), $crumb['url'], array('title'=>$crumb['label']));	
                echo "</li>"; 
            } else {
                echo "<li> ".utf8_encode($crumb['label'])."</li> ";
            }
        }
        echo "</ul>";
    }
}