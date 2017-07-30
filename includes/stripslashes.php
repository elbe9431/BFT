<?php
/**
 * Berufsfindungstest :: Strip slashes from form data
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_Stripslashes
{
    // Strip slashes from form data if magic quotes is set
    public static function stripslashes_data()
    {
        if (get_magic_quotes_gpc()) {
            $in = array(&$_GET, &$_POST, &$_COOKIE);
            while (list($k, $v) = each($in)) {
                foreach ($v as $key => $val) {
                    if (!is_array($val)) {
                        $in[$k][$key] = stripslashes($val);
                        continue;
                    }
                    $in[] =& $in[$k][$key];
                }
            }
            unset($in);
        }
    }
}
?>
