<?php
/**
 * paartherapietest :: Main file
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

// Prepare exception object
// $exception = new BFT_Exception();

// Prepare data object
$data = new BFT_Data();

// Get posted data
if (isset($_GET['return'])) {
    // Return von Paypal
    $str = base64_decode($_GET['return']);
    $arr = explode('_', $str);
    if ((count($arr) == 3) and ($arr[0] == 'Paypal')) {
        if ($arr[1] == 'Success') {
            $data->userid = $arr[2];
            $data->section = 'menu';
            $data->substep = 4;
        }
        else {
            $data->userid = $arr[2];
            $data->section = 'menu';
            $data->substep = 5;
        }
    }
}
elseif (isset($_GET['mcrpymnt']) && isset($_GET['user'])) {
    // Successful return from Micropayment
    $data->userid = $_GET['user'];
    $data->section = 'menu';
    $data->substep = 4;
}
elseif (isset($_GET['content'])) {
    $content = strtolower($_GET['content']);
    if ($content == 'reg') {
        // Mail verifizieren
        if (isset($_GET['id'])) {
            $action = explode('_', base64_decode($_GET['id']));
            if ($action[0] == 'activate') {
                $data->userid = $action[1];
                $data->section = 'login';
                $data->substep = 6;
                $data->modus = 1;
                $sql = 'UPDATE
                            bft_users
                        SET
                            verified = 1,
                            activated = 1,
                            login = 1
                        WHERE
                            userid = '.$data->userid;
                $db->query($sql);
            }
        }
    }
    elseif ($content == 'logout') {
        // Ausloggen -> Weiterleitung
        if (isset($_GET['id'])) {
            $sql = 'UPDATE
                        bft_users
                    SET
                        login = 0
                    WHERE
                        userid = '.$_GET['id'];
            $db->query($sql);
        }
        Header("Location: http://www.paartherapietest.eu/");
        exit(); 
    }
    elseif ($content == 'test') {
        // Test
        if (isset($_POST[BFT_DATA], $_POST[BFT_HASH])) {
            // Post data einlesen, wenn vorhanden
            $serialized = BFT_Crypt::decrypt($_POST[BFT_DATA]);
            if (BFT_Crypt::test_hash($serialized, $_POST[BFT_HASH])) {
                $data = unserialize($serialized);
            }
            else {
                die(sprintf(BFT_Lang::error, 1, 'Es ist ein Fehler in der Datenübertragung aufgetreten'));
            }
        }
        else {
            // sonst neuen Test starten, Login Übersicht anzeigen
            if (isset($_GET['id']) and ($_GET['id'] == 'impressum')) {
                // Impressum anzeigen
                $data->section = 'impressum';
                $data->substep = 1;
                $data->modus = 1;
            }
            else if (isset($_GET['id']) && ($_GET['id'] == 'newTestOrContinueTest')) {
                // This code is executed when the user clicks the button "Start Hamburger
                // Paartherapie-Test" on the start page. Clicking that button results in a GET
                // request with test?id=newTestOrContinueTest
                // 
                // We show a page on which the user can chose if he wants to continue a test that
                // was interrupted before or if he wants to start a new test.
                $data->section = 'login';
                // substep = 31 does not execute any code in datalogin.php and executes case 31 in
                // pagelogin.php
                $data->substep = 31;
                // The property modus is not evaluated. We set it anyway to prevent an undefined
                // property notice.
                $data->modus = 0;
            }
            elseif (isset($_GET['id']) and ($_GET['id'] == 'group')) {
                // This code is executed when the user clicks the link "Bereits begonnenen Test
                // fortsetzen" on the page where he can choose if he wants to continue an
                // interrupted test or if he wants to start a new test. Clicking that link results
                // in a GET request with test?id=group. In that case we show the user a field where
                // he can enter a password to continue an interrupted test.
                $data->section = 'login';
                $data->substep = 1;
                $data->modus = 1;
            }
            elseif (isset($_GET['id']) and ($_GET['id'] == '2')) {
                // Test 2 starten
                $data->section = 'login';
                $data->substep = 1;
                $data->modus = 0;
                $data->substep = 10;
            }
            else {
                // Code execution is here after the following two things have happened:
                // 1. User clicked the button "Start Hamburger Paartherapie-Test" on the start page.
                // 2. User clicked the button "Weiter". That click results in the GET request:
                //    GET /test HTTP/1.1
                // We want to run the test as group "start". Therefore we have to set the array key
                // 'gruppenid' in the $_POST array to the value "start". Because the array key
                // $_POST[BFT_NEXT] is evaluated later we have to set that as well. In order to
                // execute the correct code later we also must set several properties in the data
                // object.
                $data->section = 'login';
                $data->substep = 1;
                $data->modus = 1;
                $data->error = 0;
                $data->save = 0;
                $_POST['gruppenid'] = 'bft001';
                $_POST[BFT_NEXT] = 'Weiter';
             }
        }
    }
    elseif ($content == 'about') {
        $data->section = 'start';
        $data->substep = 3;
    }
    elseif ($content == 'preview') {
        $data->section = 'start';
        $data->substep = 4;
    }
    elseif ($content == 'fragen') {
        $data->section = 'start';
        $data->substep = 5;
    }
    elseif ($content == 'kontakt') {
        $data->section = 'start';
        $data->substep = 6;
    }
    elseif ($content == 'impressum') {
        $data->section = 'start';
        $data->substep = 7;
    }
    elseif ($content == 'service') {
        $data->section = 'start';
        $data->substep = 8;
    }
 elseif ($content == 'videos') {
        $data->section = 'start';
        $data->substep = 9;
    }



    
}

// Load user data
$user = new BFT_User($data);

// Debug messages
if (BFT_Config::debug_mode) {
    $debug->add('GET', $_GET);
    $debug->add('POST', $_POST);
    $debug->add('COOKIE', $_COOKIE);
    $debug->add('SESSION', $_SESSION);
    $debug->add('DATA1', clone $data);
}

// Process data
$data->processdata();

// If we loaded data from db
if (isset($data->loaded_data)) {
    $data = $data->loaded_data;
}

// Debug message
if (BFT_Config::debug_mode) {
    $debug->add('DATA2', clone $data);
    $debug->add('USER', clone $user);
}

// Prepare page
$page = new BFT_Page($data);

// Encrypt data
$serialized = serialize($data);
$page->encrypted = BFT_Crypt::encrypt($serialized);
$page->hash = BFT_Crypt::generate_hash($serialized);

// Save current test
$data->save_actions($page->encrypted, $page->hash);

// Debug message
if (BFT_Config::debug_mode) {
    $debug->add('PAGE', clone $page);
}

// Output page
$page->show();

// Save session
$_SESSION[BFT_DATA] = $page->encrypted;
$_SESSION[BFT_HASH] = $page->hash;

// Close MySQL connection
$db->close();

?>
