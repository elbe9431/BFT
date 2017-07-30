<?php
/**
 * Berufsfindungstest :: Prepare page for output
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_Page
{
    public function __construct($data)
    {
        global $db;
        global $user;
        $this->title = BFT_Lang::title;
        $this->description = BFT_Lang::description;
        $this->section = $data->section;
        $this->printer = 0;
        $this->nav = '';
        $this->back = ($this->section != 'start' or (isset($data->substep) and $data->substep == 2));
        $this->userid = isset($data->userid) ? $data->userid : 0;
        require_once BFT_PATH_BASE.DS.'includes'.DS.'page'.$data->section.'.php';
    }
    
    public function show()
    {
        //$L = new BFT_Locale();
        require_once BFT_PATH_BASE.DS.'templates'.DS.'html-header.php';
        if ($this->section != 'start' and $this->template != 'infos') require_once BFT_PATH_BASE.DS.'templates'.DS.'box-header.php';
        require_once BFT_PATH_BASE.DS.'templates'.DS.$this->template.'.php';
        if ($this->section != 'start' and $this->template != 'infos') require_once BFT_PATH_BASE.DS.'templates'.DS.'box-footer.php';
        require_once BFT_PATH_BASE.DS.'templates'.DS.'html-footer.php';
    }
}
?>
