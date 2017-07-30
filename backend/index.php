<?php
/**
 * Paartherapietest :: Backend main file
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Enno Heyken berufsziele@aol.com
 * @copyright 2016 Ennpo Heyken. All rights reserved.
 */

// Set flag that this is a parent file
define('_BFT_EXEC', 1);

// Set base path
define('BFT_PATH_BASE', dirname(__FILE__) . '/..');
define('DS', DIRECTORY_SEPARATOR);

// Initialisation
require_once BFT_PATH_BASE.DS.'includes'.DS.'init.php';

// Always show errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get id to show
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$page = isset($_GET['page']) ? $_GET['page'] : '';
$bezart=isset($_GET['bezart']) ? $_GET['bezart'] : '';

// Database keys for list view
$grouplist = array('groupid', 'name', 'beschreibung', 'aktiv', 'preis', 'belehrung', 'kennwort', 'daten', 'erg1', 'druck1', 'email1', 'erg2', 'druck2', 'email2', 'buchen');
$userlist = array('userid', 'Username', 'email', 'Vorname', 'Nachname', 'groupname', 'verified', 'activated', 'testid', 'p1', 'p2', 'bez', 'bezart', 'buchen', 'Preis','regDate');
$keylist = array('keyid', 'keyname', 'verifikation');
$feedbacklist = array('feedbackid','userid', 'feedbacktext', 'datum');

// Additional information for database keys
$groups = array(
    'groupid' => array(0, 'interne Id - nicht veränderbar'),
    'name' => array(1, 'der Code beim Anmelden - muss eindeutig sein'),
    'beschreibung' => array(1, ''),
    'aktiv' => array(1, 'ist diese Gruppe aktiv zum Anmelden (0 oder 1) - nur Anmeldung, bestehende Accounts können sich weiter einloggen'),
    'preis' => array(1, 'in Cent - 0 für muss nicht bezahlen'),
    'belehrung' => array(1, 'Belehrung (1 = Selbstzahler, 2 = Gruppen)'),
    'kennwort' => array(1, 'Ausgabe des persönlichen Kennworts (0 = gar nicht, 1 = am Anfang von Test 1, 2 = am Ende von Test 2)'),
    'daten' => array(1, 'Eingabe persönlicher Daten (1 = nur Email, 2 = zusätzlich Name, Alter, Geschlecht)'),
    'erg1' => array(1, 'Ausgabe Ergebnis Test 1 (0 = nein, 1 = nur Berufsfelder 1, 2 = plus Berufsfelder 2, 3 = plus Berufe)'),
    'druck1' => array(1, 'Druckoption Test 1 (0 = nein, 1 = nur Berufsfelder 1, 2 = plus Berufsfelder 2, 3 = plus Berufe)'),
    'email1' => array(1, 'Versand Email Test 1 (0 = nein, 1 = ja)'),
    'erg2' => array(1, 'Ausgabe Ergebnis Test 2 (0 = nein, 1 = nur Ergebnis Test 2, 2 = plus Berufsfelder)'),
    'druck2' => array(1, 'Druckoption Test 2 (0 = nein, 1 = nur Ergebnis Test 2, 2 = plus Berufsfelder 2)'),
    'email2' => array(1, 'Versand Email Test 2 (0 = nein, 1 = ja)'),
    'buchen' => array(1, 'Weiterleitung auf Anmeldepage Berufsberatung für Schule (0 oder 1)'),
    'ergebnis' => array(0, 'nicht mehr benutzt'),
    'ergebnism1' => array(0, 'nicht mehr benutzt'),
    'verifikation' => array(0, 'nicht mehr benutzt'),
);

$users = array(
    'userid' => array(0, 'interne Id - nicht veränderbar'),
    'username' => array(1, 'Username oder E-Mail - muss eindeutig sein'),
    'password' => array(0, 'Md5-Hash des Passworts - hier nicht änderbar'),
    'regdate' => array(0, 'Datum der Registrierung'),
    'regip' => array(0, 'Ip-Adresse bei der Registrierung'),
    'verified' => array(1, 'Ist die E-Mail verifiziert (1 oder 0)'),
    'login' => array(0, 'Ist der User gerade eingeloggt (1 oder 0) - ist nur für interne Zwecke, um Abmeldung zu überprüfen'),
    'lastaction' => array(0, 'Datum und Zeit der letzten Aktion'),
    'email' => array(1, 'E-Mail-Adresse - muss hier nicht eindeutig sein'),
    'groupname' => array(1, 'Name der Gruppe - hier eher für statistische Zwecke'),
    'testid' => array(0, 'für interne Zwecke'),
    'p1' => array(1, 'Fortschritt in Modul 1 (0 = noch nicht gestartet, 4 = gestartet, 8 = beendet)'),
    'p2' => array(1, 'Fortschritt in Modul 2 (0 = noch nicht gestartet, 4 = gestartet, 8 = beendet)'),
    'bez' => array(1, 'Hat der User bezahlt, bzw. ist Modul 2 freigeschaltet (1 oder 0) - hier ändern, falls Modul 2 von Hand freigeschaltet werden soll'),
    'bezart' => array(1, 'Welche Bezahloption wurde verwendet (0 = noch nicht bezahlt/musste nicht bezahlen, 1 = Paypal, 2 = Lastschrift, 3 = Onlineüberweisung, 4 = Banküberweisung, 5 = Sonstiges)'),
    'bankueberwmail' => array(1, 'Wurde die Mail mit den Informationen zur Banküberweisung bereits versendet (1 oder 0)'),
    'activated' => array(1, 'ist der Account aktiviert, kann er sich einloggen (1 oder 0) - hier ändern, falls man einen User von Hand sperren oder aktivieren will'),
    'geschlecht' => array(1, 'Geschlecht (1 = männlich, 2 = weiblich)'),
    'vorname' => array(1, ''),
    'nachname' => array(1, ''),
    'age' => array(1, 'als Zahl'),
    'klasse' => array(1, 'Klasse, Ausbildung oder auch z.B. Student'),
    'ergebnis' => array(1, 'bekommt User am Ende das Ergebnis angezeigt/zugeschickt (0 = nein, 1 = ja, 2 = ja und wurde bereits zugemailt)'),
    'ergebnism1' => array(1, 'werden auch Berufe beim Ergebnis für Modul 1 angezeigt (1 oder 0) - sonst nur Berufsfelder'),
    'preis' => array(1, 'in Cent'),
    'buchen' => array(1, 'wird zur Buchung der Gruppenberatung auf berufsziele.de weitergeleitet (1 oder 0)'),
);

$keys = array(
    'keyid' => array(0, 'interne Id'),
    'keyname' => array(1, 'Groß- und Kleinschreibung wird beim Login ignoriert - maximal 20 Zeichen'),
    'verifikation' => array(1, 'muss User sich mit E-Mail anmelden und diese verifizieren (1 oder 0) - sonst Anmeldung mit Username'),
);

// Function to output ids as links
function output($key, $val) {
    $links = array('groupid' => 'group', 'userid' => 'user', 'keyid' => 'key', 'testid' => 'test', 'groupname' => 'userlist', 'name' => 'userlist');
    return ($val and isset($links[$key])) ? '<a href="?page=' . $links[$key] . '&id=' . $val . '">' . $val . '</a>' : $val;
}

// Header
header('Content-Type: text/html; charset=utf-8');

// HTML start
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="de" lang="de">';
echo '<head>';
echo '<meta http-equiv="content-type" content="text/xml; charset=utf-8" />';
echo '<title>Backend - Hamburger Paartherapietest online</title>';
echo '<meta name="description" content="Backend für den Hamburger Paartherapietest." />';
echo '<meta name="author" content="Enno Heyken" />';
echo '<meta name="contact" content="berufsziele@aol.de" />';
echo '<meta name="language" content="de" />';
echo '<meta name="robots" content="noindex,nofollow" />';
echo '<link rel="stylesheet" href="backend.css" type="text/css" />';
echo '</head>';
echo '<body>';

?>

<table width="600" border="0">
	<tr>
    	<td>
        	<?
				if ($_SERVER['REQUEST_METHOD'] == 'GET') {
					echo '<ul>';
					echo '<li><a href=".">Home</a></li>';
					echo '<li><a href="?page=userlist">Alle User anzeigen</a></li>';
					echo '<li><a href="?page=grouplist">Gruppen</a></li>';
					echo '<li><a href="?page=keylist">Schlüssel Berufsberatung HH</a></li>';
					echo '<li><a href="?page=layout">Layout Test für Texte</a></li>';
					echo '<li><a href="?page=feedbacks">User-Feedbacks ansehen</a></li>';
					echo '</ul>';
					echo '<hr />';}
			?>
        <td>
        <td>
        	
        <td>
        <td valign="top">
        	User nach Bezahlart:<br />
            <form method="get" action="index.php">
            <select name="bezart">
            	<option value="-1" <?php if(isset($_GET['bezart']) && $_GET['bezart']=="-1") echo "selected" ?>>bezahlt</option>
            	<option value="0" <?php if(isset($_GET['bezart']) && $_GET['bezart']=="0") echo "selected" ?>>0: noch nicht bezahlt</option>
                <option value="1" <?php if(isset($_GET['bezart']) && $_GET['bezart']=="1") echo "selected" ?>>1: Paypal</option>
                <option value="2" <?php if(isset($_GET['bezart']) && $_GET['bezart']=="2") echo "selected" ?>>2: Lastschrift</option>
                <option value="3" <?php if(isset($_GET['bezart']) && $_GET['bezart']=="3") echo "selected" ?>>3: Onlineüberweisung</option>
                <option value="4" <?php if(isset($_GET['bezart']) && $_GET['bezart']=="4") echo "selected" ?>>4: Banküberweisung</option>
                <option value="5" <?php if(isset($_GET['bezart']) && $_GET['bezart']=="5") echo "selected" ?>>5: Sonstiges</option>
            </select>
            <input type="hidden" name="page" value="userlist"/>
            <input type="submit" value="Anzeigen"/>
            </form>
        <td>
    </tr>
</table>

<?
include 'users.php';
include 'groups.php';
include 'keys.php';
include 'test.php';
include 'layout.php';
include 'feedbacks.php';
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

echo '</body>';
echo '</html>';
?>
