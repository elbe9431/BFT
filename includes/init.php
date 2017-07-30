<?php
/**
 * paartherapietest :: Initialisation
 *
 * @version 1.0
 * @package paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

// Load defines
require_once BFT_PATH_BASE.DS.'includes'.DS.'defines.php';

// Auto load for classes
function __autoload($classname) {
    $classname = str_replace('bft_', '', strtolower($classname));
    $path = array(BFT_PATH_BASE.DS.'includes', BFT_PATH_BASE.DS.'locale', BFT_PATH_BASE);
    foreach ($path as $val) {
        if (file_exists($val.DS.$classname.'.php')) {
            require_once $val.DS.$classname.'.php';
            break;
        }
    }
}

// Set debug mode
error_reporting(BFT_Config::debug_mode ? E_ALL : 0);
ini_set('display_errors', BFT_Config::debug_mode);
if (BFT_Config::debug_mode) {
    $debug = new BFT_Debug();
}

// Connect to MySQL database
$db = new mysqli(BFT_Config::mysql_host, BFT_Config::mysql_username, BFT_Config::mysql_passwd, BFT_Config::mysql_dbname);
if ($db->connect_error) {
    die('MySQL Error ('.$db->connect_errno.') '.$db->connect_error);
}

// Set MySQL connection character set to UTF-8
if (!$db->set_charset('utf8')) {
    die('MySQL Error ('.$db->errno.') '.$db->error);
}

// Start session
//ini_set('session.use_trans_sid', 1);
session_cache_limiter('private_no_expire, must_revalidate');
session_start();

// Reset session
if (isset($_POST[BFT_RESET])) {
    $_SESSION = array();
    session_regenerate_id(true);
}

//header("Expires: Mon, 10 Jan 1970 01:01:01 GMT");
//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//header("Cache-Control: no-store, no-cache, must-revalidate");
//header("Pragma: no-cache");

// Check if sessionID is valid
/*if (isset($_POST['sid']) AND $_POST['sid'] != md5(md5(BFT_KEY).session_id())) {
    $_SESSION = array();
    session_regenerate_id(true);
    $debug['INVALID'] = 'Invalid SessionID';
}*/

/*if (isset($data[BFT_SID]) and $data[BFT_SID] != session_id()) {
    $_SESSION = array();
    session_regenerate_id(true);
    $debug->add('ERROR_SESSION_INVALID', 'Invalid SessionID');
}*/

// Strip slashes from form data if magic quotes is on
BFT_Stripslashes::stripslashes_data();
?>
