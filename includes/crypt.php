<?php
/**
 * paartherapietest :: Encryption and hash testing
 *
 * @version 1.0
 * @package paartherapietests
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_Crypt
{
    public static function encrypt($data)
    {
        $key = md5('Mailand oder Madrid - Hauptsache Italien');
        $iv = substr(md5('Hans Maulwurf'), 0, mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CFB));
        return base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $data, MCRYPT_MODE_CFB, $iv));
    }

    public static function decrypt($data)
    {
        $key = md5('Mailand oder Madrid - Hauptsache Italien');
        $iv = substr(md5('Hans Maulwurf'), 0, mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CFB));
        return trim(mcrypt_decrypt(MCRYPT_BLOWFISH, $key, base64_decode($data), MCRYPT_MODE_CFB, $iv));
    }

    public static function generate_hash($text)
    {
        $salt = substr(md5(uniqid(rand(), true)), 0, 10);
        return $salt.substr(sha1($salt.$text), -22);
    }

    public static function test_hash($text, $hash)
    {
        $salt = substr($hash, 0, 10);
        return $hash == ($salt.substr(sha1($salt.$text), -22));
    }
}
?>
