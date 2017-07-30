<?php
/**
 * Berufsfindungstest :: Backend layout test for text
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

// Ausgabe von Testergebnissen
if ($page == 'layout') {
    $sql = 'SELECT * FROM bft_berufswege';
    if (!$result = $db->query($sql)) {
        die('Error ('.$db->errno.') '.$db->error);
    }
    else {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="sortable-item clear">'.($row['bwname'] == 'Kommunikationswissenschaften' ? 'Kommunikations-<br />wissenschaften' : $row['bwname']).'</div>';
            echo '<div class="sortable-item">'.preg_replace('/'.$row['bwhighlight2'].'/', '<strong>'.$row['bwhighlight2'].'</strong>', $row['bwbeschreibung'], 1).'</div>';
            echo '<div class="sortable-dest">'.preg_replace('/'.$row['bwhighlight2'].'/', '<strong>'.$row['bwhighlight2'].'</strong>', $row['bwbeschreibung'], 1).'</div>';
            echo '<div class="compare-box">
                    <p class="top">Berufsweg A</p>
                    <h3 class="headline">'.($row['bwtyp'] == 's' ? 'Studium' : 'Ausbildung').' '.$row['bwname'].'</h3>
                    <p class="text">'.str_replace('Ich will Inhalte', '<strong>Ich will Inhalte</strong>', $row['bwlerninhalt']).'</p>
                    <p class="text"><img src="images/arrow.png" />'.str_replace('Im Berufsleben', '<strong>Im Berufsleben</strong>', $row['bwtätigkeit']).'</p>
                    <p class="handle handle1">Berufsberater-Tipps</p>
                    <p class="hinweise hinweise1">'.$row['bwberater'].'</p>
                  </div>';
        }
    }
    $result->close();
}
?>
