<?php
/**
 * Berufsfindungstest :: Prepare startpage for output
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

$this->template = 'start';

if (isset($data->substep) and $data->substep == 3) {
    // About
    $this->subpage = 'about';
    $this->title = 'About - ' . BFT_Lang::shorttitle;
    $this->description = 'Der Hamburger Paartherapietest online bietet Paartherapie Online kostenlos ohne Anmeldung. Von Diplom-Psychologen entwickelt.';
}
elseif (isset($data->substep) and $data->substep == 4) {
    // Infopage
    $this->subpage = 'preview';
    $this->title = 'Preview - ' . BFT_Lang::shorttitle;
    $this->description = 'Verlauf des Hamburger Paartherapietests online - ohne Anmeldung, kostenlos, durch Diplom-Psychologen entwickelt';
    $this->slimbox = 1;
}
elseif (isset($data->substep) and $data->substep == 5) {
    // Fragen
    $this->subpage = 'fragen';
    $this->title = 'Fragen - ' . BFT_Lang::shorttitle;
    $this->description = 'Fragen zum Hamburger Paartherapie-Test online.';
}
elseif (isset($data->substep) and $data->substep == 6) {
    // Kontakt
    $this->subpage = 'kontakt';
    $this->title = 'Kontakt - ' . BFT_Lang::shorttitle;
    $this->description = 'Kontaktinformationen zur Psychodiagnostischen Beratungspraxis - Bereich Paartherapie-Test online, Paartherapie, Paarberatung';
}
elseif (isset($data->substep) and $data->substep == 7) {
    // Impressum
    $this->subpage = 'impressum';
    $this->title = 'impressum - ' . BFT_Lang::shorttitle;
    $this->description = 'Impressum des Hamburger Paartherapietests.';
}
elseif (isset($data->substep) and $data->substep == 8) {
    // Service
    $this->subpage = 'service';
    $this->title = 'Service - ' . BFT_Lang::shorttitle;
    $this->description = 'Weiterführende Serviceinformationen zum Thema Paartherapie und Paarberatung.';
}
elseif (isset($data->substep) and $data->substep == 9) {
    // Videos
    $this->subpage = 'videos';
    $this->title = 'videos - ' . BFT_Lang::shorttitle;
    $this->description = 'Videos zur Paartherapie';
}


else {
    // Startpage
	if(BFT_Config::test_mode_kostenlos==0){
    	$this->subpage = 'index';
	}else{
		$this->subpage = 'index_kostenlos';	
	}
}
?>
