<?php
/**
 * paartherapietest :: API for Micropayment
 *
 * @version 1.0
 * @package paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Set flag that this is a parent file
define('_BFT_EXEC', 1);

// Set base path
define('BFT_PATH_BASE', dirname(__FILE__) . '/..');
define('DS', DIRECTORY_SEPARATOR);

// Initialisation
require_once BFT_PATH_BASE.DS.'includes'.DS.'init.php';

// Get user and set to payed
if (isset($_GET['user'])) {
    $user = $_GET['user'];
    
    if (isset($_GET['bezart']) and ($_GET['bezart'] == 2)) {
        // Lastschrift
        $bezart = 2;
    }
    else {
        // Onlineüberweisung
        $bezart = 3;
    }
    
    // ToDo: Test if user exists (and hasn't payed yet?)
    $sql = 'UPDATE
                bft_users
            SET
                bez = 1,
                bezart = '.$bezart.'
            WHERE
                userid = '.$user;
    $db->query($sql);
    $status = 'ok';
    $url = 'http://www.paartherapietest.eu/index.php?mcrpymnt=1&user=' . $user;

    // Mail senden mit Teilnahmebedingungen
    $mail = new BFT_Mail();
    $mail->SendMicropaymentBestaetigung($user, $bezart);
}
else {
    $status = 'error';
    $url = 'http://www.paartherapietest.eu/index.php';
}

$trenner 	= "\n";

$target		= '_top';
$forward	= 0;

$response = 'status=' . $status;
$response.= $trenner;
$response.= 'url=' . $url;
$response.= $trenner;
$response.= 'target=' . $target;
$response.= $trenner;
$response.= 'forward=' . $forward;

echo $response;
?>
