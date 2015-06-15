<?php

class cfpanelConfiguration extends sfApplicationConfiguration
{

    public function configure()
    {
        $this->deleteCache();
    }

    /**
     * Delete Cache
     *
     */
    public function deleteCache($f = 'application/cache/cfpanel/prod')
    {
        $sf = realpath(@$sf);

        if (is_dir($f)) {
            foreach (glob($f . '/*') as $sf) {
                if (is_dir($sf) && !is_link($sf)) {
                    $this->deleteCache($sf);
                    if (is_writable($sf)) {
                        // echo 'Delete dir.: ' . $sf . "\n";
                        rmdir($sf);
                    }
                } else {
                    if (is_writable($sf)) {
                        //    echo 'Delete file: ' . $sf . "\n";
                        unlink($sf);
                    }
                }
            }
        } else {
            // die('Error: ' . $f . ' not a directory');
        }
    }

    /**
     * Recursively remove a directory
     * 
     * @param string $dir path of directory
     * @return void 
     */
    public function rrmdir($dir = '')
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        $this->rrmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

}
