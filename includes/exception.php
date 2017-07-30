<?php
/**
 * Berufsfindungstest :: Exception handling
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_Exception
{
    public function __construct()
    {
        $this->count = 0;
        $this->text = '';
    }
    
    public function make($text)
    {
        $this->count++;
        $this->text = $text;
    }
}
?>
