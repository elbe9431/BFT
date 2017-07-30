<?php
/**
 * Berufsfindungstest :: Data processing for phase 3
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

// Shufflefunktion
function kshuffle(&$array) {
    if(!is_array($array) || empty($array)) {
        return false;
    }
    $tmp = array();
    foreach($array as $key => $value) {
        $tmp[] = array('k' => $key, 'v' => $value);
    }
    shuffle($tmp);
    $array = array();
    foreach($tmp as $entry) {
        $array[$entry['k']] = $entry['v'];
    }
    return true;
}

switch ($this->substep) {
    case 0:
        // Einleitung
        if (isset($_POST[BFT_NEXT])) {
            $this->step++;
            if ($this->step > 3) {
                // Paarungen generieren und Vergleiche starten
                $this->substep = 1;
                $this->modus = 1;

                // Generate starting list
                $berufswege = array();
                
                // Berufswege Ergebnisse aus phase 2 kopieren
                foreach ($this->berufswege as $bwid => $val) {
                    $berufswege[$bwid] = array('val' => $val, 'bholz' => 0, 'matches' => array());
                }
                
                // In data speichern
                $this->berufswege2 = $berufswege;
                $this->berufswege3 = $this->berufswege;
                
                // Durcheinander würfeln und neu sortieren
                kshuffle($this->berufswege3);
                asort($this->berufswege3);
                
                // Todo liste erstellen
                unset($this->todo);
                $this->todo = array();
                reset($this->berufswege3);
                do {
                    $a = key($this->berufswege3);
                    next($this->berufswege3);
                    $b = key($this->berufswege3);
                    $this->todo[] = $a.'_'.$b;
                } while (next($this->berufswege3));
                
                // Matches und Bresenham speichern
                foreach ($this->todo as $key => $val) {
                    $bw = explode('_', $val);
                    $this->berufswege2[$bw[0]]['matches'][] = $bw[1];
                    $this->berufswege2[$bw[1]]['matches'][] = $bw[0];
                    $this->berufswege2[$bw[0]]['bholz'] += $this->berufswege2[$bw[1]]['val'];
                    $this->berufswege2[$bw[1]]['bholz'] += $this->berufswege2[$bw[0]]['val'];
                }
                
                // Werte der verbleibenden Berufe berechnen
                foreach ($this->berufswege3 as $bw => $val) {
                    $this->berufswege3[$bw] = $this->berufswege2[$bw]['val'] + $this->berufswege2[$bw]['bholz'] / BFT_Config::buchh_faktor;
                }

                // Zufällige Reihenfolge
                shuffle($this->todo);

                // Set first match
                $this->step = 1;
                $this->maxsteps = count($this->todo);
                $this->save = 1;
            }
        }
        break;
        
    case 1:
        // Seite vor Vergleichen
        if (isset($_POST[BFT_NEXT])) {
            $this->substep = 2;
            $this->match = explode('_', array_shift($this->todo));
        }
        break;
        
    case 2:
        // Vergleiche
        if (isset($_POST['match'])) {
            $lastmatch = explode('_', $_POST['match']);
            $ok = 0;

            if (isset($_POST['A'])) {
                $this->berufswege2[$lastmatch[0]]['val'] += 1;
                $this->berufswege3[$lastmatch[0]] += 1;
                $ok = 1;
            }
            elseif (isset($_POST['B'])) {
                $this->berufswege2[$lastmatch[0]]['val'] += 0.75;
                $this->berufswege2[$lastmatch[1]]['val'] += 0.25;
                $this->berufswege3[$lastmatch[0]] += 0.75;
                $this->berufswege3[$lastmatch[1]] += 0.25;
                $ok = 1;
            }
            elseif (isset($_POST['C'])) {
                $this->berufswege2[$lastmatch[0]]['val'] += 0.25;
                $this->berufswege2[$lastmatch[1]]['val'] += 0.75;
                $this->berufswege3[$lastmatch[0]] += 0.25;
                $this->berufswege3[$lastmatch[1]] += 0.75;
                $ok = 1;
            }
            elseif (isset($_POST['D'])) {
                $this->berufswege2[$lastmatch[1]]['val'] += 1;
                $this->berufswege3[$lastmatch[1]] += 1;
                $ok = 1;
            }
	     elseif (isset($_POST['E'])) {
                $this->berufswege2[$lastmatch[0]]['val'] += -0.25;
                $this->berufswege2[$lastmatch[1]]['val'] += -0.25;
                $this->berufswege3[$lastmatch[0]] += -0.25;
                $this->berufswege3[$lastmatch[1]] += -0.25;
                $ok = 1;
            }

            else {
                // Fehler
            }

            if ($ok) {
                $this->step++;
                $this->match = explode('_', array_shift($this->todo));
                $this->save = 1;
            }

            if ($this->step > $this->maxsteps) {
                // Durchgang beendet, gehe zu Papierkorb
                unset($this->match);
                kshuffle($this->berufswege3);
                asort($this->berufswege3);
                $this->save = 1;
                if ($this->modus == 5) {
                    // Ende - Ergebnis berechnen
                    arsort($this->berufswege3);
                    $this->result_phase3 = array_slice($this->berufswege3, 0, 10, true);
                    
                    // Berechne Studien- und Ausbildungsgänge
                    $this->studium = array();
                    $this->ausbildung = array();

                    foreach ($this->berufswege2 as $bwid => $arr) {
                        $sql = 'SELECT
                                    bwtyp
                                FROM
                                    bft_berufswege
                                WHERE
                                    bwid = '.$bwid;
                        if (!$result = $db->query($sql)) {
                            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                        }
                        $row1 = $result->fetch_assoc();
                        $result->close();
                        if ($row1['bwtyp'] == 's') {
                            $this->studium[$bwid] = $arr['val'] + $arr['bholz'] / BFT_Config::buchh_faktor;
                        }
                        else {
                            $this->ausbildung[$bwid] = $arr['val'] + $arr['bholz'] / BFT_Config::buchh_faktor;
                        }
                    }

                    arsort($this->studium);
                    arsort($this->ausbildung);
                    $this->studium = array_slice($this->studium, 0, 10, true);
                    $this->ausbildung = array_slice($this->ausbildung, 0, 10, true);
                    
                    // Set status in db for modul 2 to done
                    $sql = 'UPDATE
                                bft_users
                            SET
                                p2 = 8
                            WHERE
                                userid = '.$this->userid;
                    $db->query($sql);

                    // Send mail
                    if ($user->data['email2'] and $user->data['email'] != '') {
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
                        
                        // Pdf erstellen
                        $pdf = new BFT_PDF($user->data['email']);
                        $pdf->AliasNbPages();
                        $pdf->AddPage();
                        $pdf->SetFont('Arial', '', 11);
                        $pdf->Table0($this->berufsfelder, $berufsfelder, $berufswege);
                        $pdf->Ln(10);
                        $pdf->Table1($this->result_phase3, $berufsfelder, $berufswege);
                        $pdf->AddPage();
                        $pdf->Table2($this->studium, $berufsfelder, $berufswege);
                        $pdf->Ln(10);
                        $pdf->Table3($this->ausbildung, $berufsfelder, $berufswege);
                        $pdf->AddPage();
                        $pdf->Hinweise();
                        
                        // Mail
                        $file_name = "Ergebnis Test 2 Berufswahl.pdf";
                        $file_content = chunk_split(base64_encode($pdf->Output('', 'S')));
                        $mail = new BFT_Mail(1, $file_name, $file_content);
                        $mail->SendErgebnis($this->userid);
                        
                        // Ergebnis Status updaten
                        $sql = 'UPDATE
                                    bft_users
                                SET
                                    verified = 2
                                WHERE
                                    userid = '.$this->userid;
                        $db->query($sql);
                    }

                    if ($user->data['erg2'] == 0) {
                        // Kein Ergebnis anzeigen
                        $this->substep = 6;
                        $this->step = 1;
                    }
                    else {
                        // Ergebnis anzeigen
                        $this->substep = 5;
                        $this->step = 1;
                    }
                }
                else {
                    $this->substep = 3;
                    if ($this->modus == 1) {
                        $this->todelete = count($this->berufswege3) - BFT_Config::round2_berufe;
                    }
                    elseif ($this->modus == 2) {
                        $this->todelete = count($this->berufswege3) - BFT_Config::round3_berufe;
                    }
                    elseif ($this->modus == 3) {
                        $this->todelete = count($this->berufswege3) - BFT_Config::round4_berufe;
                    }
                    elseif ($this->modus == 4) {
                        $this->todelete = count($this->berufswege3) - BFT_Config::round5_berufe;
                    }
                    
                    if ($this->todelete > BFT_Config::max_todelete) {
                        $this->todelete = BFT_Config::max_todelete;
                    }
                    
                    $this->todo = array();
                    reset($this->berufswege3);
                    for ($i = 0; $i < $this->todelete + 2; $i++) {
                        $this->todo[] = key($this->berufswege3);
                        next($this->berufswege3);
                    }
                }
            }
        }
        else {
            // Fehler
        }
        break;
        
    case 3:
        // Erklärung Papierkorb
        if (isset($_POST[BFT_NEXT])) {
            $this->substep = 4;
        }
        break;
        
    case 4:
        // Papierkorb
        if (isset($_POST[BFT_NEXT]) and isset($_POST[BFT_BERUFSWEGE])) {
            $deleted = explode(",", str_replace(BFT_BERUFSWEGE."_", "", $_POST[BFT_BERUFSWEGE]));
            foreach ($deleted as $bw) {
                unset($this->berufswege3[$bw]);
            }
            arsort($this->berufswege3);
            $this->substep = 1;
            $this->modus++;

            // Todo Liste erstellen für nächsten Durchgang
            $this->todo = $this->match($this->berufswege3);

            // Matches und Bresenham speichern
            foreach ($this->todo as $key => $val) {
                $bw = explode('_', $val);
                $this->berufswege2[$bw[0]]['matches'][] = $bw[1];
                $this->berufswege2[$bw[1]]['matches'][] = $bw[0];
                $this->berufswege2[$bw[0]]['bholz'] += $this->berufswege2[$bw[1]]['val'];
                $this->berufswege2[$bw[1]]['bholz'] += $this->berufswege2[$bw[0]]['val'];
            }
            
            // Werte der verbleibenden Berufe berechnen
            foreach ($this->berufswege3 as $bw => $val) {
                $this->berufswege3[$bw] = $this->berufswege2[$bw]['val'] + $this->berufswege2[$bw]['bholz'] / BFT_Config::buchh_faktor;
            }

            // Zufällige Reihenfolge
            shuffle($this->todo);

            // Set first match
            $this->step = 1;
            $this->maxsteps = count($this->todo);
            unset($this->todelete);
            $this->save = 1;
        }
        break;
        
    case 5:
        // Ergebnis
        if (isset($_POST[BFT_NEXT])) {
            $this->step++;
            if ($this->step == 2 and $user->data['erg2'] == 2) {
                $this->step = -10;
            }
            if ($this->step == 7 and $user->data['druck2'] == 0) {
                $this->step = 8;
            }
            if ($this->step == 16) {
                // If the user entered feedback we save it in the database.
                if (isset($_POST['feedback']) && strlen(trim($_POST['feedback'])) > 0) {
                    $sql = 'INSERT INTO
                              bft_feedbacks (userid, feedbacktext)
                            VALUES
                              ('.$this->userid.',\''.$db->real_escape_string($_POST['feedback']).'\')';
                    $db->query($sql);
                }
            }
            if ($this->step > 15) {
                if ($user->data['buchen'] == 1) {
                    header('Location: http://www.paarentwicklung.de');
                }
                else {
					
                    header('Location: http://www.paarentwicklung.de');
                }
                exit;
            }
            if ($this->step == -8) {
                $this->step = 2;
            }
        }
        break;
            
    case 6:
        // Kein Ergebnis anzeigen
        if (isset($_POST[BFT_NEXT])) {
            if ($user->data['buchen'] == 1) {
                header('Location: http://www.paarentwicklung.de');
            }
            else {
                header('Location: http://www.paarentwicklung.de');
            }
            exit;
        }
        break;
}
?>
