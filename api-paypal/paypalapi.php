<?php
/**
 * paartherapietest :: API for Paypal
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

    // ToDo: Test if user exists (and hasn't payed yet?)
    $sql = 'UPDATE
                bft_users
            SET
                bez = 1,
                bezart = 1
            WHERE
                userid = '.$user;
    $db->query($sql);
    $status = 'ok';

    // Mail senden mit Teilnahmebedingungen
    $mail = new BFT_Mail();
    $mail->SendPaypalBestaetigung($user);
}
else {
    $status = 'error';
}

/*
$response = 'status=' . $status;
echo $response;
*/
?>
