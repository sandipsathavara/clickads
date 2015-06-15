<?php

/**
 * Creat Project cache 
 * 
 * PHP version 5.2
 * 
 * @category SfClassi
 * @package  Sfcc
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com
 * Copyright (c) Experts Web Solution  2012-2013
 */

function deltree($f) {
    $sf = realpath(@$sf);

    if (is_dir($f)) {
        foreach (glob($f . '/*') as $sf) {
            if (is_dir($sf) && !is_link($sf)) {
                deltree($sf);
                if (is_writable($sf)) {
                    echo 'Delete dir.: ' . $sf . "\n";
                    rmdir($sf);
                }
            } else {
                if (is_writable($sf)) {
                    echo 'Delete file: ' . $sf . "\n";
                    unlink($sf);
                }
            }
        }
    } else {
        die('Error: ' . $f . ' not a directory');
    }
}

echo '<pre>';
echo 'Clean symfony cache' . "\n";
echo "\n";
deltree('application/cache');
echo '</pre>';
