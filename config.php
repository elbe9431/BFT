<?php
/**
 * paartherapietest :: Configuration
 *
 * @version 1.0
 * @package paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_Config
{
    // MySQL settings
	
	
    const mysql_host        = 'db644810719.db.1and1.com';
    const mysql_username    = 'dbo644810719';
    const mysql_passwd      = '11rogers';
    const mysql_dbname      = 'db644810719';
    const mysql_prefix      = 'bft_';
	
	
    // General settings for the test
    const max_berufsfelder  = 13;   // Anzahl Berufsfelder
    const max_berufswege    = 10;   // Anzahl Berufswege pro Berufsfeld
    const min_relevante     = 3;    // Phase 1: Minimale Anzahl Relevante
    const max_relevante     = 8;    // Phase 1: Maximale Anzahl Relevante
    const max_sortables     = 5;    // Phase 2: Maximale Anzahl für Sortiertabellen
    const max_gerettete     = 4;    // Phase 2: Maximale Anzahl Gerettete
    const max_platzierte    = 5;    // Phase 2: Maximale Anzahl Berufswege falls keine Sieger
    const max_todelete      = 4;    // Phase 3: Maximale Anzahl Berufswege zum Löschen
    const round2_berufe     = 26;   // Phase 3: Berufe für Runde 2
    const round3_berufe     = 22;   // Phase 3: Berufe für Runde 3
    const round4_berufe     = 20;   // Phase 3: Berufe für Runde 4
    const round5_berufe     = 18;   // Phase 3: Berufe für Runde 5
    const buchh_faktor      = 100;  // Phase 3: Faktor für Buchholz Wertung
    const max_punkte        = 6.65; // Phase 3: Punkte für 100%
	
	//Seite in den Testmode schalten:
	//test_mode_kostenlos an: 1 || test_mode_kostenlos aus :0
    const test_mode_kostenlos=0;
	
	
    // General system settings
    const debug_mode        = 0;    // Debug mode: 1 = on, 0 = off
}
?>
