<?php
/**
 * Berufsfindungstest :: Backend show pdf
 *
 * @version 1.0
 * @package Berufsfindungstest
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

// Always show errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get id to show
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$type = isset($_GET['type']) ? $_GET['type'] : 'alles';

// Load user data
$sql = 'SELECT
            vorname, nachname, email, testid
        FROM
            bft_users
        WHERE
            userid = ' . $id;
if (!$result = $db->query($sql)) {
    die('Error ('.$db->errno.') '.$db->error);
}
$row = $result->fetch_assoc();
$result->close();
$name = $row['vorname'] . ' ' . $row['nachname'];
if ($row['email']) {
    $name .= ' <' . $row['email'] . '>';
}
$testid = $row['testid'];

// Load test data
$sql = 'SELECT
            *
        FROM
            bft_tests
        WHERE
            testid = ' . $testid;
if (!$result = $db->query($sql)) {
    die('Error ('.$db->errno.') '.$db->error);
}
$row = $result->fetch_assoc();
$result->close();
$data = new BFT_Data();
$serialized = BFT_Crypt::decrypt($row['data']);
$data = unserialize($serialized);

// Load Berufsfelder
$sql = 'SELECT
            bfid, bfname
        FROM
            '.BFT_Config::mysql_prefix.'berufsfelder';
if (!$result = $db->query($sql)) {
    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
}
while ($row = $result->fetch_assoc()) {
    $berufsfelder[$row['bfid']] = $row;
}
$result->close();

// Load Berufswege
$sql = 'SELECT
            bwid, bfid, bwname, bwtyp
        FROM
            '.BFT_Config::mysql_prefix.'berufswege';
if (!$result = $db->query($sql)) {
    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
}
while ($row = $result->fetch_assoc()) {
    $berufswege[$row['bwid']] = $row;
}
$result->close();
                    
// Create Pdf
$pdf = new BFT_PDF($name);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 11);

if ($type == 'berufsfelder') {
    $pdf->Table0($data->berufsfelder, $berufsfelder, $berufswege);
}
elseif ($type == 'berufe') {
    $pdf->Table1($data->result_phase3, $berufsfelder, $berufswege);
}
else {
    $pdf->Table0($data->berufsfelder, $berufsfelder, $berufswege);
    $pdf->Ln(10);
    $pdf->Table1($data->result_phase3, $berufsfelder, $berufswege);
    $pdf->AddPage();
    $pdf->Table2($data->studium, $berufsfelder, $berufswege);
    $pdf->Ln(10);
    $pdf->Table3($data->ausbildung, $berufsfelder, $berufswege);
    $pdf->AddPage();
    $pdf->Hinweise();
}

// Output Pdf
$file_name = "BFT_" . time() . ".pdf";
$pdf->Output($file_name, "D");
?>
