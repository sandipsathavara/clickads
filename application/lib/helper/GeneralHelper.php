<?php

/**
 * Returnt Subdomain Name 
 *
 * @params $subdomain  subdoaine name 
 * @params $sf_request request object
 * */
function createSubDomain($sf_request, $subdomain)
{
    $protocol = $sf_request->isSecure() ? 'https' : 'http';
    $url = $protocol . '://' . str_replace(" ", '', strtolower($subdomain)) . "." . getDomain($sf_request->getHost()) . '/' . $sf_request->getParameter('sf_culture');
    return $url;
}

/**
 * Return Host Name from Uri
 *
 * @params url current uri  
 * */
function getDomain($host)
{
   /* if (preg_match('/[^.]+\.[^.]+$/', $host, $matches)) {
        return $matches[0];
    }
    */
   return preg_replace("/^www\./", "", $host);
    //return false;
}

/**
 * Return slugify
 *
 * @params text for convert  
 * */


function slugify($text)
{
    
     // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
//  $text = preg_replace('~[^-\w]+~', '', $text);

  if (empty($text))
  {
    return 'n-a';
  }

  return $text;
  
  /*  $text = preg_replace('/\W+/', '-', $text);
    $text = strtolower(trim($text, '-'));
    return utf8_encode($text);*/
}

/**
 * Generate Password format  
 * 
 * 
 * @param string $salt
 * @param string $password 
 */
function generatePassword($salt, $password)
{
    return sha1($salt . $password);
}

/**
 * Generate Salt format  
 * 
 * @param  string $username
 * @return string md5 string
 */
function generateSalt($username)
{
    return md5($username . gettimeofday(true));
}

/**
 * Generate Salt format  
 * 
 * @param string $slug
 * @return integer from array
 */
function getIdFromSulg($slug = '')
{
    #--- breaking Slug String ---#
    $arrSlug = explode('-', $slug);

    return (int) $arrSlug[(count($arrSlug) - 1)];
}

/**
 * Generate Salt format  
 * 
 * @param string $slug
 * @return integer from array
 */
function getNameFromSulg($slug = '')
{
    #--- breaking Slug String ---#
    $arrSlug = explode('-', $slug);
    $slug = is_numeric($arrSlug[(count($arrSlug) - 1)]) ? str_replace(array('-', $arrSlug[(count($arrSlug) - 1)]), ' ', $slug) : str_replace('-', ' ', $slug);

    return ucfirst(trim($slug, ' '));
}

/**
 * Send an email 
 * 
 * @param array $to Emailid of reciver 
 * @param string $from Emailid of sender
 * @param string $subject subject of email
 * @param text $body email body 
 * @return boolean 
 */
function sendEmail($to, $from, $subject, $body)
{
    #-- Create Mailer Object ---#
    $oMailer = sfContext::getInstance()->getMailer();

    $issent = $oMailer->send($oMailer->compose($to, $from, $subject, $body));

    return ($issent == true) ? true : false;
}

/**
 * Generate password 
 * 
 * @param integer $length legnth of password 
 * @param integer $use_upper number of upper case charater
 * @param integer $use_lower number of lower case charater
 * @param integer $use_number number of number charater
 * @param integer $use_custom use custom charater
 * @return string 
 */
function createPassword($length = 6, $use_upper = 1, $use_lower = 1, $use_number = 1, $use_custom = "")
{
    $upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $lower = "abcdefghijklmnopqrstuvwxyz";
    $number = "0123456789";
    $seed_length = $seed = 0;
    $password = '';
    if ($use_upper) {
        $seed_length += 26;
        $seed .= $upper;
    }
    if ($use_lower) {
        $seed_length += 26;
        $seed .= $lower;
    }
    if ($use_number) {
        $seed_length += 10;
        $seed .= $number;
    }
    if ($use_custom) {
        $seed_length +=strlen($use_custom);
        $seed .= $use_custom;
    }
    for ($x = 1; $x <= $length; $x++) {
        $password .= $seed{rand(0, $seed_length - 1)};
    }
    return($password);
}

/**
 * Generate password 
 * 
 * @param integer $length legnth of password 
 * @param integer $use_upper number of upper case charater
 * @param integer $use_lower number of lower case charater
 * @param integer $use_number number of number charater
 * @param integer $use_custom use custom charater
 * @return string 
 */
function distanceOfTimeInWords($date = '')
{
    $to_time = time();
    $from_time = strtotime($date);

    $distance_in_minutes = floor(abs($to_time - $from_time) / 60);
    $distance_in_seconds = floor(abs($to_time - $from_time));


    $string = '';
    $parameters = array();

    if ($distance_in_minutes <= 1 && $distance_in_seconds <= 0 && $distance_in_seconds <= 59) {
        $string = '%seconds% Seconds ago';
        $parameters['%seconds%'] = $distance_in_seconds;
    } else if ($distance_in_minutes >= 1 && $distance_in_minutes <= 59) {
        $string = '%minutes% Minutes ago';
        $parameters['%minutes%'] = $distance_in_minutes;
    } else if ($distance_in_minutes >= 60 && $distance_in_minutes <= 1439) {
        $string = '%hours% Hours ago';
        $parameters['%hours%'] = round($distance_in_minutes / 60);
    } else if ($distance_in_minutes >= 1440 && $distance_in_minutes <= 2879) {
        $string = 'Yesterday';
    } else {
        return format_date($date, 'p');
    }

    return __($string, $parameters);
}

/**
 * Recursively remove a directory
 * 
 * @param string $dir path of directory
 * @return void 
 */
function rrmdir($dir = '')
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir . "/" . $object) == "dir")
                    rrmdir($dir . "/" . $object);
                else
                    unlink($dir . "/" . $object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}

/**
 * Delete Cache
 *
 */
function deleteCache($f = 'application/cache')
{
    $sf = realpath(@$sf);

    if (is_dir($f)) {
        foreach (glob($f . '/*') as $sf) {
            if (is_dir($sf) && !is_link($sf)) {
                deleteCache($sf);
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
 * Read CSV 
 * 
 * @param string $filename path of csv file
 * @param string $delimiter delimiter of csv file
 * @return string 
 */
function csv2Array($filename='')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}


