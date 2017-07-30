<?php
/**
 * paartherapietest :: Hauptmenü
 *
 * @version 1.0
 * @package paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

switch ($this->substep) {
    case 1:
        // Bestätigung
        if (isset($_POST[BFT_NEXT])) {
            $this->substep = 2;
        }
        break;
        
    case 2:
        // Auswahlbildschirm
        // Read test data for user
        $sql = 'SELECT
                    testid, p1, p2, bez
                FROM
                    bft_users
                WHERE
                    userid = '.$this->userid;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        if ($row = $result->fetch_assoc()) {
            $this->testid = $row['testid'];
            $this->p1 = $row['p1'];
            $this->p2 = $row['p2'];
            $this->bez = $row['bez'];

            if (isset($_POST['BFT_TEST_END'])) {
                $this->substep = 10;
            }

            if (isset($_POST[BFT_P1_START])) {
                // Start new phase 1
                $sql = 'INSERT INTO
                            bft_tests
                        VALUES
                            (NULL, NOW(), '.$this->userid.', "", "")';
                $db->query($sql);
                $this->testid = $db->insert_id;
                $sql = 'UPDATE
                            bft_users
                        SET
                            testid = '.$this->testid.',
                            p1 = 4,
                            p2 = 0
                        WHERE
                            userid = '.$this->userid;
                $db->query($sql);

                $this->section = 'phase1';
                $this->step = 1;
                $this->maxsteps = BFT_Config::max_berufsfelder;
                $this->substep = 0;
                $this->modus = 1;
                $this->berufsfeld = 1;
                $this->relevante = array();
                $this->streicher = array();
                $this->gerettete = array();
                $this->todo = range(0, $this->maxsteps);
                unset($this->todo[0]);
                unset($this->p1);
                unset($this->p2);
                unset($this->error);
                unset($this->anz_relevante);
                unset($this->anz_streicher);
                unset($this->anz_gerettete);
                unset($this->anz_relevante1);
                unset($this->anz_streicher1);
                unset($this->anz_gerettete1);
                unset($this->sorted);
                unset($this->gerettete2);
                unset($this->berufsfelder);
                unset($this->berufswege);
                unset($this->berufswege2);
                unset($this->berufswege3);
                unset($this->result_phase2);
                unset($this->result_phase3);
                unset($this->studium);
                unset($this->ausbildung);
                $this->save = 1;
            }
            elseif (isset($_POST[BFT_P1_FORTS]) and $this->p1 == 4) {
                // Fortsetzen phase 1
                $sql = 'SELECT
                            data, hash
                        FROM
                            bft_tests
                        WHERE
                            testid = '.$this->testid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row = $result->fetch_assoc();
                $serialized = BFT_Crypt::decrypt($row['data']);
                $this->loaded_data = unserialize($serialized);
                unset($this->loaded_data->p1);
                unset($this->loaded_data->p2);
            }
            elseif (isset($_POST[BFT_P1_ERGEBNIS]) and $this->p1 == 8) {
                // Ergebnisse phase 1
                $sql = 'SELECT
                            data, hash
                        FROM
                            bft_tests
                        WHERE
                            testid = '.$this->testid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row = $result->fetch_assoc();
                $serialized = BFT_Crypt::decrypt($row['data']);
                $this->loaded_data = unserialize($serialized);
                unset($this->loaded_data->p1);
                unset($this->loaded_data->p2);
                $this->loaded_data->save = 0;
                
                // Set correct steps to show results
                $this->loaded_data->section = 'phase2';
                $this->loaded_data->substep = 3;
                $this->loaded_data->step = 1;
            }
            elseif (isset($_POST[BFT_P2_BEZ]) and $this->bez == 0) {
                // Modul 2 bezahlen
                $this->substep = 7;
                $this->step = 1;
                break;
            }
            elseif (isset($_POST[BFT_P2_START]) and $this->p1 == 8 and $this->bez > 0) {
                // Start modul 2
                // Load test data from modul 1
                $sql = 'SELECT
                            data, hash
                        FROM
                            bft_tests
                        WHERE
                            testid = '.$this->testid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row = $result->fetch_assoc();
                $serialized = BFT_Crypt::decrypt($row['data']);
                $this->loaded_data = unserialize($serialized);
                unset($this->loaded_data->p1);
                unset($this->loaded_data->p2);

                // Set settings for modul 2
                $this->loaded_data->section = 'phase3';
                $this->loaded_data->substep = 0;
                $this->loaded_data->step = 0;
                $this->loaded_data->maxsteps = 10;
                unset($this->loaded_data->p1);
                unset($this->loaded_data->p2);
                unset($this->loaded_data->berufswege2);
                unset($this->loaded_data->berufswege3);
                unset($this->loaded_data->todo);
                unset($this->loaded_data->match);
                unset($this->loaded_data->todelete);
                unset($this->loaded_data->result_phase3);
                unset($this->loaded_data->studium);
                unset($this->loaded_data->ausbildung);
                $this->save = 1;

                // Update User in db
                $sql = 'UPDATE
                            bft_users
                        SET
                            testid = '.$this->testid.',
                            p2 = 4
                        WHERE
                            userid = '.$this->userid;
                $db->query($sql);
            }
            elseif (isset($_POST[BFT_P2_FORTS]) and $this->p1 == 8 and $this->p2 == 4 and $this->bez > 0) {
                // Fortsetzen modul 2
                $sql = 'SELECT
                            data, hash
                        FROM
                            bft_tests
                        WHERE
                            testid = '.$this->testid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row = $result->fetch_assoc();
                $serialized = BFT_Crypt::decrypt($row['data']);
                $this->loaded_data = unserialize($serialized);
                unset($this->loaded_data->p1);
                unset($this->loaded_data->p2);
            }
            elseif (isset($_POST[BFT_P2_ERGEBNIS]) and $this->p1 == 8 and $this->p2 == 8 and $this->bez > 0) {
                // Ergebnisse modul 2
                $sql = 'SELECT
                            data, hash
                        FROM
                            bft_tests
                        WHERE
                            testid = '.$this->testid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row = $result->fetch_assoc();
                $serialized = BFT_Crypt::decrypt($row['data']);
                $this->loaded_data = unserialize($serialized);
                unset($this->loaded_data->p1);
                unset($this->loaded_data->p2);

                // Set correct steps to show results
                $this->loaded_data->section = 'phase3';
                $this->loaded_data->substep = 5;
                $this->loaded_data->step = 1;
            }
            elseif (isset($_POST[BFT_PREVIEW])) {
                // Anleitung
                $this->substep = 8;
                $this->step = 1;
            }
            elseif (isset($_POST[BFT_CANCEL])) {
                // Abmelden
                $sql = 'UPDATE
                            '.BFT_Config::mysql_prefix.'users
                        SET
                            login = 0,
                            lastaction = NOW()
                        WHERE
                            userid = '.$this->userid;
                $db->query($sql);
                unset($this->userid);
                // Call www.berufsziele.de
                header('Location: http://www.paarentwicklung.de');
                exit;
            }
        }
        else {
            // UserId not found
        }
        break;
        
    case 3:
        // Bezahlseite
        if (isset($_POST[BFT_UEBERW])) {
            $this->substep = 6;
        }
        elseif (isset($_POST[BFT_CANCEL])) {
            $this->substep = 2;
            $this->step = 1;
        }
        break;
        
    case 4:
        // Bezahlung erfolgreich
        if (isset($_POST[BFT_NEXT])) {
                // Start modul 2
                // Get test id
                $sql = 'SELECT
                            testid
                        FROM
                            bft_users
                        WHERE
                            userid = '.$this->userid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row = $result->fetch_assoc();
                $this->testid = $row['testid'];

                // Load test data from modul 1
                $sql = 'SELECT
                            data, hash
                        FROM
                            bft_tests
                        WHERE
                            testid = '.$this->testid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row = $result->fetch_assoc();
                $serialized = BFT_Crypt::decrypt($row['data']);
                $this->loaded_data = unserialize($serialized);
                unset($this->loaded_data->p1);
                unset($this->loaded_data->p2);
                
                // Set settings for modul 2
                $this->loaded_data->section = 'phase3';
                $this->loaded_data->substep = 0;
                $this->loaded_data->step = 0;
                $this->loaded_data->maxsteps = 10;
                unset($this->loaded_data->p1);
                unset($this->loaded_data->p2);
                unset($this->loaded_data->berufswege2);
                unset($this->loaded_data->berufswege3);
                unset($this->loaded_data->todo);
                unset($this->loaded_data->match);
                unset($this->loaded_data->todelete);
                unset($this->loaded_data->result_phase3);
                unset($this->loaded_data->studium);
                unset($this->loaded_data->ausbildung);
                $this->save = 1;

                // Update User in db
                $sql = 'UPDATE
                            bft_users
                        SET
                            testid = '.$this->testid.',
                            p2 = 4
                        WHERE
                            userid = '.$this->userid;
                $db->query($sql);
        }
        break;

    case 5:
        // Bezahlung abgebrochen
        // Do something
        if (isset($_POST[BFT_NEXT])) {
            $this->substep = 2;
            $this->step = 1;
        }
        break;
        
    case 6:
        // Banküberweisung
        if (isset($_POST[BFT_NEXT])) {
            // Mail senden mit Teilnahmebedingungen
            $sql = 'SELECT
                        bankueberwmail
                    FROM
                        bft_users
                    WHERE
                        userid = '.$this->userid;
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            $row = $result->fetch_assoc();
            if (!$row['bankueberwmail']) {
                $mail = new BFT_Mail();
                $mail->SendBankueberweisungDaten($this->userid);
                $mail->SendBankueberweisungNachricht($this->userid);
            }
            
            // Userdaten updaten
            $sql = 'UPDATE
                        bft_users
                    SET
                        bezart = 4,
                        bankueberwmail = 1
                    WHERE
                        userid = '.$this->userid;
            $db->query($sql);
            $this->substep = 2;
            $this->step = 1;
        }
        break;
        
    case 7:
        // Teilnahmebedingungen
        if (isset($_POST[BFT_NEXT])) {
            // Modul 2 bezahlen
            $this->substep = 3;
            $this->step = 1;
        }
        else {
            $this->substep = 2;
        }
        break;

    case 8:
        // Infos zum Test
        if (isset($_POST[BFT_NEXT])) {
            // Zuzrück zum Menü
            $this->step++;
            if ($this->step > 5) {
                $this->substep = 2;
                $this->step = 1;
            }
        }
        break;
}
?>
