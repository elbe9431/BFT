<?php
/**
 * Berufsfindungstest :: Backend tests
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

// Ausgabe von Testergebnissen
if ($page == 'test') {
    $sql = 'SELECT
                *
            FROM
                bft_tests
            WHERE
                testid = ' . $id;
    if (!$result = $db->query($sql)) {
        die('Error ('.$db->errno.') '.$db->error);
    }
    else {
        $row = $result->fetch_assoc();
        $result->close();
        $userid = $row['userid'];
        $data = new BFT_Data();
        $serialized = BFT_Crypt::decrypt($row['data']);
        $data = unserialize($serialized);
        echo '<ul>';
        echo '<li>UserId: ' . output('userid', $userid) . '</li>';
        echo '<li>Datum: ' . $row['date'] . '</li>';
        
        if (isset($data->anz_relevante1)) {
            echo '<li>Modul 1: Erster Durchlauf:';
            echo '<ul>';
            echo '<li>Relevante: '.(isset($data->anz_relevante1) ? $data->anz_relevante1 : $data->anz_relevante).'</li>';
            echo '<li>Gerettete: '.(isset($data->anz_gerettete1) ? $data->anz_gerettete1 : $data->anz_gerettete).'</li>';
            echo '<li>Streicher: '.(isset($data->anz_streicher1) ? $data->anz_streicher1 : $data->anz_streicher).'</li>';
            echo '</ul>';
            echo '</li>';
        }
        
        if (isset($data->relevante)) {
            echo '<li>Modul 1: Relevante:';
            $sql = 'SELECT
                        bfname
                    FROM
                        bft_berufsfelder
                    WHERE
                        bfid IN ('.implode(',', $data->relevante).')';
            if (!$result = $db->query($sql)) {
                die('Error ('.$db->errno.') '.$db->error);
            }
            echo '<ol>';
            while ($row = $result->fetch_assoc()) {
                echo '<li>'.$row['bfname'].'</li>';
            }
            $result->close();
            echo '</ol>';
            echo '</li>';
        }
        
        if (isset($data->gerettete)) {
            echo '<li>Modul 1: Gerettete:';
            if (count($data->gerettete) == 0) {
                echo '<ul><li>keine</li></ul>';
            }
            else {
                $sql = 'SELECT
                            bft_berufswege.bwnameshort, bft_berufsfelder.bfname
                        FROM
                            bft_berufswege
                        JOIN
                            bft_berufsfelder
                        ON
                            (bft_berufswege.bfid = bft_berufsfelder.bfid)
                        WHERE
                            bwid IN ('.implode(',', $data->gerettete).')';
                if (!$result = $db->query($sql)) {
                    die('Error ('.$db->errno.') '.$db->error);
                }
                echo '<ol>';
                while ($row = $result->fetch_assoc()) {
                    echo '<li>'.$row['bwnameshort'].' ('.$row['bfname'].')</li>';
                }
                $result->close();
                echo '</ol>';
            }
            echo '</li>';
        }
        
        if (isset($data->streicher)) {
            echo '<li>Modul 1: Streicher:';
            if (count($data->streicher) == 0) {
                echo '<ul><li>keine</li></ul>';
            }
            else {
                $sql = 'SELECT
                            bfname
                        FROM
                            bft_berufsfelder
                        WHERE
                            bfid IN ('.implode(',', $data->streicher).')';
                if (!$result = $db->query($sql)) {
                    die('Error ('.$db->errno.') '.$db->error);
                }
                echo '<ol>';
                while ($row = $result->fetch_assoc()) {
                    echo '<li>'.$row['bfname'].'</li>';
                }
                $result->close();
                echo '</ol>';
            }
            echo '</li>';
        }
        
        if (isset($data->berufsfelder)) {
            echo '<li>Modul 1: Berufsfelder:';
            echo '<ol>';
            foreach ($data->berufsfelder as $bfid => $prozente) {
                $sql = 'SELECT
                            bfname
                        FROM
                            bft_berufsfelder
                        WHERE
                            bfid = '.$bfid;
                if (!$result = $db->query($sql)) {
                    die('Error ('.$db->errno.') '.$db->error);
                }
                $row = $result->fetch_assoc();
                $result->close();
                echo '<li>'.$row['bfname'].' ('.round($prozente).'%)</li>';
            }
            echo '</ol>';
            echo '</li>';
        }
        
        if (isset($data->result_phase2)) {
            echo '<li>Modul 1: Studiengänge:';
            echo '<ol>';
            foreach ($data->result_phase2['s'] as $bwid) {
                $sql = 'SELECT
                            bft_berufswege.bwname, bft_berufsfelder.bfname
                        FROM
                            bft_berufswege
                        INNER JOIN
                            bft_berufsfelder
                        ON
                            (bft_berufswege.bfid = bft_berufsfelder.bfid)
                        WHERE
                            bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die('Error ('.$db->errno.') '.$db->error);
                }
                $row = $result->fetch_assoc();
                $result->close();
                echo '<li>'.$row['bwname'].' ('.$row['bfname'].')</li>';
            }
            echo '</ol>';
            echo '</li>';
            
            echo '<li>Modul 1: Ausbildungsgänge:';
            echo '<ol>';
            foreach ($data->result_phase2['a'] as $bwid) {
                $sql = 'SELECT
                            bft_berufswege.bwname, bft_berufsfelder.bfname
                        FROM
                            bft_berufswege
                        INNER JOIN
                            bft_berufsfelder
                        ON
                            (bft_berufswege.bfid = bft_berufsfelder.bfid)
                        WHERE
                            bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die('Error ('.$db->errno.') '.$db->error);
                }
                $row = $result->fetch_assoc();
                $result->close();
                echo '<li>'.$row['bwname'].' ('.$row['bfname'].')</li>';
            }
            echo '</ol>';
            echo '</li>';
        }
        
        if (isset($data->result_phase3)) {
            echo '<li>Modul 2: Berufswege:';
            echo '<ol>';
            foreach ($data->result_phase3 as $bwid => $val) {
                $sql = 'SELECT
                            bft_berufswege.bwname, bft_berufsfelder.bfname
                        FROM
                            bft_berufswege
                        INNER JOIN
                            bft_berufsfelder
                        ON
                            (bft_berufswege.bfid = bft_berufsfelder.bfid)
                        WHERE
                            bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die('Error ('.$db->errno.') '.$db->error);
                }
                $row = $result->fetch_assoc();
                $result->close();
                echo '<li>'.$row['bwname'].' ('.$row['bfname'].') => '.min(100, round($val / BFT_Config::max_punkte * 100)).'%</li>';
            }
            echo '</ol>';
            echo '</li>';
            
            echo '<li>Modul 2: Studiengänge:';
            echo '<ol>';
            foreach ($data->studium as $bwid => $val) {
                $sql = 'SELECT
                            bft_berufswege.bwname, bft_berufsfelder.bfname
                        FROM
                            bft_berufswege
                        INNER JOIN
                            bft_berufsfelder
                        ON
                            (bft_berufswege.bfid = bft_berufsfelder.bfid)
                        WHERE
                            bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die('Error ('.$db->errno.') '.$db->error);
                }
                $row = $result->fetch_assoc();
                $result->close();
                echo '<li>'.$row['bwname'].' ('.$row['bfname'].') => '.min(100, round($val / BFT_Config::max_punkte * 100)).'%</li>';
            }
            echo '</ol>';
            echo '</li>';
            
            echo '<li>Modul 2: Ausbildungsgänge:';
            echo '<ol>';
            foreach ($data->ausbildung as $bwid => $val) {
                $sql = 'SELECT
                            bft_berufswege.bwname, bft_berufsfelder.bfname
                        FROM
                            bft_berufswege
                        INNER JOIN
                            bft_berufsfelder
                        ON
                            (bft_berufswege.bfid = bft_berufsfelder.bfid)
                        WHERE
                            bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die('Error ('.$db->errno.') '.$db->error);
                }
                $row = $result->fetch_assoc();
                $result->close();
                echo '<li>'.$row['bwname'].' ('.$row['bfname'].') => '.min(100, round($val / BFT_Config::max_punkte * 100)).'%</li>';
            }
            echo '</ol>';
            echo '</li>';
            echo '<li><a href="pdf.php?id=' . $userid . '" target="_blank">Ergebnis als PDF ausgeben</a></li>';
        }
        
        echo '</ul>';
    }
}
?>
