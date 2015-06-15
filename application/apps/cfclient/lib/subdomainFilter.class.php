<?php

/**
 * Create subdomain in routing (URL)
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
 * Create subdomain in routing (URL)
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
class subdomainFilter extends sfFilter
{

    /**
     * Create subdomain using routing.
     *
     * @param sfFilter $filterChain .
     *
     * @return string
     */
    public function execute($filterChain)
    {
        if ($this->isFirstCall()) {
            if (preg_match('/(.*)\.(.*)\.[a-z]+/i', $this->getContext()->getRequest()->getHost(), $regs)) {
                $subdomain = $regs[1];
                if ($subdomain != '') {
                    sfConfig::set('app_subdomain', $subdomain);
                }    
            }
        }
        $filterChain->execute();
    }

}
