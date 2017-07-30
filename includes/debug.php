<?php
/**
 * Berufsfindungstest :: Debug
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_Debug
{
    private $msg = array();
    
    public function add($key, $val, $isArray = false)
    {
        if ($isArray) {
            $this->msg[$key][] = $val;
        }
        else {
            $this->msg[$key] = $val;
        }
    }
    
    public function show()
    {
        print_r($this->msg);
    }
}
?>
