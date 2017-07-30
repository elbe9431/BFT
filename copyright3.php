<?php
/**
 * paartherapietest :: Copyright module 2
 *
 * @version 1.0
 * @package paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Set flag that this is a parent file
define('_BFT_EXEC', 1);

// Set base path
define('BFT_PATH_BASE', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

// Initialisation
require_once BFT_PATH_BASE.DS.'includes'.DS.'init.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="de" lang="de">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="expires" content="0">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="pragma" content="no-cache">
<title>Nutzungsbedingungen Test 2 Berufswahl - <?php echo BFT_Lang::shorttitle; ?></title>
<meta name="robots" content="noindex,follow" />
<link rel="stylesheet" href="../paartherapietest/css/copyright.css" type="text/css" />
</head>
<body>
<h3>Teilnahmebedingungen für den Hamburger paartherapietest – Gruppen, Schulen, Berufsberatungen.</h3>
<h3>1. Zweck des Tests</h3>
<p>Der Hamburger paartherapietest "Berufswahl" verfolgt das Ziel, dass der Testteilnehmer aus einer Vielzahl vorgegebener Berufe diejenigen Ausbildungsgänge und Studiengänge herausfiltert, und in eine Reihenfolge sortiert, für die er sich aktuell entscheiden könnte.</p>
<h3>3. Kostenfreier Test für ausgewählte Gruppen und Schulen</h3>
<p>An ausgewählten Schulen und im Rahmen unserer Berufsberatungen in Hamburg gilt: Der Test ist kostenfrei. Dies ist dadurch geregelt, dass ein bestimmter Schlüssel eingegeben wird, welcher den Test für den Teilnehmer kostenfrei schaltet.</p>
<h3>4. Testverlauf</h3>
<p>Zu Beginn geben Sie Name, Alter, Geschlecht und Emailadresse ein.</p>
<p>Die Daten benötigen wir, um die Ergebnisse bei einer späterem Berufsberatung angemessen interpretieren zu können. Die Emailadresse wird nur zum Zusenden der Testergebnisse genutzt sowie zum Zusenden eines Zugangscodes für den Test Hamburgere paartherapietest.  Die Emailadresse wird nicht an Dritte weitergegeben.</p>
<p>Mit diesem Zugangscode kann der Teilnehmer jederzeit Pausen im Test machen – und sich später an der gleichen Stelle wieder einloggen.</p>
<h3>6. Datenspeicherung</h3>
<p>Die PDB speichert die persönlichen Daten des Testteilnehmers lediglich kurzfristig – drei Monate - für die Auswertung des Tests. Nach Ablauf dieser Frist werden die Testdaten anonymisiert, so dass eine Zuordnung von Namen und Anschrift zu den Angaben im Test nicht möglich ist. Die Antworten werden jedoch in anonymisierter Form, zur Weiterentwicklung des Testes, gespeichert.</p>
<p>Ist ein Testteilnehmer mit der Speicherung seiner Daten, auch in anonymisierter Form, nicht einverstanden, so besteht die Möglichkeit, durch eine entsprechende Mitteilung an Psychodiagnostische Beratungspraxis, Enno Heyken, Wandsbeker Königstr. 11, 22041 Hamburg oder per Mail an berufsziele@aol.com die Löschung der Daten zu verlangen.</p>
<h3>7. Haftung</h3>
<p>Die PDB übernimmt keinerlei Gewähr für die Aktualität des Tests. Die PDB wird sich stets bemühen, den Test nach bestem Wissen und Gewissen und unter Verwendung aktueller Kenntnisse aktuell zu halten. Sie kann jedoch keine Gewähr dafür übernehmen, dass das Ergebnis des Testes tatsächlich dem individuellen Wünschen und Neigungen entspricht oder eine Gewähr dafür übernehmen, dass der Testteilnehmer für diesen Beruf besonders geeignet ist. Insofern bestehen auch keine Haftungsansprüche gegen die PDB, deren Inhaber oder deren Mitarbeiter, die sich auf Schäden materieller oder ideeller Art beziehen, welche durch die Nutzung der durch den Test erhaltenen Informationen entstanden sein könnten.</p>
</body>
</html>
