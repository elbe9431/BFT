<?php
/**
 * Berufsfindungstest :: Generate password
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_Password
{
    // Generate password
    public static function generate_password($length = 8, $chars = 'ABCDEFGHJKMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789')
    {
        $chars_length = (strlen($chars) - 1);
        $string = $chars{rand(0, $chars_length)};

        for ($i = 1; $i < $length; $i = strlen($string)) {
            $r = $chars{rand(0, $chars_length)};
            if ($r != $string{$i - 1}) $string .=  $r;
        }

        return $string;
    }
}
?>
