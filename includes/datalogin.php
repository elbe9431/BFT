<?php
/**
 * paartherapietest :: Data processing for login
 *
 * @version 1.0
 * @package paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');
switch ($this->substep) {
    case 0:
        // This code is executed on the page with the heading
        // Bitte geben Sie Ihre Email-Adresse ein:
        // followed by to fields for entering an email address.

        // Teilnahmebedingungen
        if (isset($_POST[BFT_CANCEL])) {
            // Go back to startpage
            $this->section = 'start';
            $this->substep = 1;
        }
        elseif (isset($_POST[BFT_NEXT])) {
            // After the user has clicked the button "Absenden" we are going to execute substep
            // four.
            // Goto Register page
            $this->substep = 4;
        }
        break;
    
    case 1:
        // This case block is reached in the following situations:
        // 1. When the user has clicked the link "Bereits begonnenen Test fortsetzen" on the page
        //    where he can choose if he wants to continue an interrupted test or if he wants to
        //    start a new test. In that situation no code in this case block is executed because
        //    there is no POST data available.
        // 2. When the user entered a group name (or a password) into the password field and clicked
        //    "Weiter". In that case the following code defines $this->anmeldung[BFT_GRUPPENID]
        //    which is important for the following steps.
        if (isset($_POST[BFT_CANCEL])) {
            $this->section = 'start';
            $this->substep = 1;
        }
        elseif (isset($_POST[BFT_NEXT])) {
        
            $this->error = 0;
            if ($this->modus == 1) {
                // This code is executed in the second situation mentioned in the comment for this
                // case block.
                // Gruppen Id oder Key einlesen
                $this->anmeldung[BFT_GRUPPENID] = isset($_POST[BFT_GRUPPENID]) ? strtolower($_POST[BFT_GRUPPENID]) : '';
            
                $sql = 'SELECT
                            aktiv, daten
                        FROM
                            bft_groups
                        WHERE
                            name = "'.$this->anmeldung[BFT_GRUPPENID].'"';
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    if ($row['aktiv'] == 1) {
                        $this->error = 0;
                        $this->modus = $row['daten'];
                        $this->substep = 0;
                    }
                    else {
                        $this->error = 'Ungültiges Kennwort!';
                    }
                }
                else {
                    $this->error = 'Ungültiges Kennwort!';
                }
                $result->close();
                
                if ($this->error) {
                    if (strlen($this->anmeldung[BFT_GRUPPENID]) > -1) {
                        $sql = 'SELECT
                                    userid, testid, password, activated
                                FROM
                                    bft_users
                                WHERE
                                    username = "'.strtolower($this->anmeldung[BFT_GRUPPENID]).'"';
                        if (!$result = $db->query($sql)) {
                            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                        }
                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            $this->substep = 11;
                            $this->userid = $row['userid'];
                            $this->testid = $row['testid'];
                            $sql = 'UPDATE
                                        bft_users
                                    SET
                                        login = 1,
                                        lastaction = NOW()
                                    WHERE
                                        userid = '.$this->userid;
                            $db->query($sql);
                            if (!$db->affected_rows) {
                                die(sprintf(BFT_Lang::error, 11, 'Ungültige User ID'));
                            }
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
                            $user->update($this->userid);
                        }
                        else {
                            $this->error = 'Ungültiges Kennwort.';
                        }
                        $result->close();
                    }
                    unset($this->login);
                }
            }
            else {
        
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
                $this->save = 0;
            }
        }
        
        /*

        // Login Übersicht
        if (isset($_POST[BFT_REGISTER])) {
            // Goto Register
            $this->substep = 2;
        }
        elseif (isset($_POST[BFT_LOGIN])) {
            // Login Eingabe speichern
            $this->login[BFT_USERNAME] = isset($_POST[BFT_USERNAME]) ? $_POST[BFT_USERNAME] : '';
            $this->login[BFT_PASSWORD] = isset($_POST[BFT_PASSWORD]) ? $_POST[BFT_PASSWORD] : '';
            
            // Login Eingabe mit Datenbank überprüfen
            $password = '';
            if (strlen($this->login[BFT_USERNAME]) > 0) {
                $sql = 'SELECT
                            userid, password, activated
                        FROM
                            '.BFT_Config::mysql_prefix.'users
                        WHERE
                            username = "'.strtolower($this->login[BFT_USERNAME]).'"';
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                if ($row = $result->fetch_assoc()) {
                    $userid = $row['userid'];
                    $password = $row['password'];
                    $activated = $row['activated'];
                }
                $result->close();
            }

            if (md5($this->login[BFT_PASSWORD]) == $password) {
                if ($activated != 1) {
                    // Nicht aktiviert
                    $this->error = 'Der Account wurde noch nicht aktiviert! Bitte folgen Sie den Anweisungen in Ihrer E-Mail.';
                    $this->login[BFT_PASSWORD] = '';
                }
                else {
                    // Login ok
                    $this->section = 'menu';
                    $this->substep = 2;
                    $this->userid = $userid;
                    $sql = 'UPDATE
                                '.BFT_Config::mysql_prefix.'users
                            SET
                                login = 1,
                                lastaction = NOW()
                            WHERE
                                userid = '.$userid;
                    $db->query($sql);
                    if (!$db->affected_rows) {
                        die(sprintf(BFT_Lang::error, 11, 'Ungültige User ID'));
                    }
                    unset($this->login);
                }
            }
            else {
                // Ein Fehler
                $this->error = 'Falscher Username oder falsches Passwort! Bitte versuchen Sie es erneut und achten Sie auf Groß- und Kleinschreibung.';
                $this->login[BFT_PASSWORD] = '';
            }
        }
        elseif (isset($_POST[BFT_PWD])) {
            // Passwort vergessen
            $this->substep = 20;
        }*/
        break;
        
    case 2:
        // Gruppenwahl
        if (isset($_POST[BFT_NEXT])) {
            if (isset($_POST[BFT_GRUPPE])) {
                if ($_POST[BFT_GRUPPE] == 'schule') {
                    $this->substep = 3;
                    $this->modus = 1;
                }
                elseif ($_POST[BFT_GRUPPE] == 'beratung') {
                    $this->substep = 3;
                    $this->modus = 2;
                }
                else {  // keine
                    $this->substep = 0;
                    $this->modus = 3;
                    $this->anmeldung[BFT_GRUPPENID] = 'bft001';
                }
            }
            else {
                // Keine Auswahl
                $this->error = 'Bitte wählen Sie eine Option!';
            }
        }
        break;
        
    case 3:
        if (isset($_POST[BFT_NEXT])) {
            // Gruppen Id oder Key einlesen
		
            $this->anmeldung[BFT_GRUPPENID] = isset($_POST[BFT_GRUPPENID]) ? $_POST[BFT_GRUPPENID] : '';
            
            if ($this->modus == 1) {
                $sql = 'SELECT
                            aktiv, verifikation
                        FROM
                            bft_groups
                        WHERE
                            name = "'.$this->anmeldung[BFT_GRUPPENID].'"';
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    if ($row['aktiv'] == 1) {
                        $this->error = 0;
                        $this->modus = ($row['verifikation'] == 1) ? 1 : 2;
                        $this->substep = 0;
                    }
                    else {
                        $this->error = 'Mit dieser Gruppenkennung ist keine Anmeldung mehr möglich!';
                    }
                }
                else {
                    $this->error = 'Falsche Gruppenkennung!';
                }
            }
            else {
                $sql = 'SELECT
                            keyid, verifikation
                        FROM
                            bft_keys
                        WHERE
                            keyname = "'.$this->anmeldung[BFT_GRUPPENID].'"';
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $this->error = 0;
                    $this->modus = $row['verifikation'];
                    $this->substep = 0;
                    $this->anmeldung[BFT_GRUPPENID] = 'bft002';
                }
                else {
                    $this->error = 'Falscher Registrierungsschlüssel!';
                }
            }
        }
        break;
        
    case 4:
        // The code in this case block does the following:
        // 1. It shows the page with the passwort which allows the user to continue the test later
        //    with the same question where he interrupted the test.
        // 2. If $this->modus is 2 then this code expects some input from the user which this code
        //    checks in that case.
        // 3. It generates a username, a password and inserts a new row into the db table bft_users.

        // Eigentliche Anmeldung überprüfen
        if (isset($_POST[BFT_NEXT])) {
            // Eingaben einlesen
            $this->anmeldung[BFT_ANREDE] = isset($_POST[BFT_ANREDE]) ? $_POST[BFT_ANREDE] : '';
            $this->anmeldung[BFT_VORNAME] = isset($_POST[BFT_VORNAME]) ? $_POST[BFT_VORNAME] : '';
            $this->anmeldung[BFT_NACHNAME] = isset($_POST[BFT_NACHNAME]) ? $_POST[BFT_NACHNAME] : '';
            $this->anmeldung[BFT_ALTER] = isset($_POST[BFT_ALTER]) ? $_POST[BFT_ALTER] : '';
            $this->anmeldung[BFT_KLASSE] = isset($_POST[BFT_KLASSE]) ? $_POST[BFT_KLASSE] : '';
            $this->anmeldung[BFT_EMAIL] = isset($_POST[BFT_EMAIL]) ? $_POST[BFT_EMAIL] : '';
            $this->anmeldung[BFT_EMAIL2] = isset($_POST[BFT_EMAIL2]) ? $_POST[BFT_EMAIL2] : '';
            $this->anmeldung[BFT_USERNAME] = isset($_POST[BFT_USERNAME]) ? $_POST[BFT_USERNAME] : '';
            $this->anmeldung[BFT_PASSWORD] = isset($_POST[BFT_PASSWORD]) ? $_POST[BFT_PASSWORD] : '';
            $this->anmeldung[BFT_PASSWORD2] = isset($_POST[BFT_PASSWORD2]) ? $_POST[BFT_PASSWORD2] : '';
            


            // Eingabefelder überprüfen
            $errors = 0;
            $this->error = array();

            // $this->modus == 2 means that first name, last name and other things are required.
            if ($this->modus == 2) {
                if ($this->anmeldung[BFT_ANREDE] == '') {
                    $this->error[BFT_ANREDE] = 'Bitte eine Auswahl treffen!';
                    $errors++;
                }
                if ($this->anmeldung[BFT_VORNAME] == '') {
                    $this->error[BFT_VORNAME] = 'Bitte Vornamen eingeben!';
                    $errors++;
                }
                if ($this->anmeldung[BFT_NACHNAME] == '') {
                    $this->error[BFT_NACHNAME] = 'Bitte Nachnamen eingeben!';
                    $errors++;
                }
                if ($this->anmeldung[BFT_ALTER] == '') {
                    $this->error[BFT_ALTER] = 'Bitte Alter eingeben!';
                    $errors++;
                }
                elseif (!preg_match('/[0-9]+/', $this->anmeldung[BFT_ALTER])) {
                    $this->error[BFT_ALTER] = 'Bitte eine Zahl eingeben!';
                    $errors++;
                }
            }
            
            /*  Pflicht der Mailangabe 
		if ($this->anmeldung[BFT_EMAIL] == '') {
                $this->error[BFT_EMAIL] = 'Bitte E-Mail-Adresse eingeben!';
                $errors++;
            }
            elseif (!preg_match('/.+@.+\..+/', $this->anmeldung[BFT_EMAIL])) {
                $this->error[BFT_EMAIL] = 'Ungültige E-Mail-Adresse! (Beispiel: <em>name@mail.de</em>)';
                $errors++;
            }

		*/



            /*else {
                    // TODO: Neue Abfrage für schon bestehende Email evtl.
                    $sql = 'SELECT
                                userid
                            FROM
                                bft_users
                            WHERE
                                username = "'.strtolower($this->anmeldung[BFT_EMAIL]).'"';
                    if (!$result = $db->query($sql)) {
                        die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                    }
                    if ($result->num_rows == 1) {
                        $this->error[BFT_EMAIL] = 'Es existiert schon ein Account mit dieser E-Mail-Adresse!';
                        $errors++;
                    }
                }*/

            /*if ($this->anmeldung[BFT_EMAIL2] == '') {
                $this->error[BFT_EMAIL2] = 'Bitte E-Mail-Adresse wiederholen!';
                $errors++;
            }
            elseif ($this->anmeldung[BFT_EMAIL] != $this->anmeldung[BFT_EMAIL2]) {
                $this->error[BFT_EMAIL2] = 'Fehler bei der Wiederholung der E-Mail-Adresse!';
                $errors++;
            }*/
            
            if ($errors == 0) {
                // Alles ok, Usernamen generieren ...
                $ok = false;
                while (!$ok) {
                    $u1 = BFT_Password::generate_password(1, 'abcdefghptuvwxy');
                    $u2 = BFT_Password::generate_password(5, '123456789');
                    $username = $u1.$u2;
                    $sql = 'SELECT
                                userid
                            FROM
                                bft_users
                            WHERE
                                username = "'.strtolower($username).'"';
                    if (!$result = $db->query($sql)) {
                        die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                    }
                    if ($result->num_rows < 1) {
                        $ok = true;
                    }
                }
                $this->anmeldung[BFT_USERNAME] = $username;

                // ... Gruppeninfos lesen ...
                $sql = 'SELECT
                            verifikation, preis, ergebnis, ergebnism1, buchen
                        FROM
                            bft_groups
                        WHERE
                            name = "'.$this->anmeldung[BFT_GRUPPENID].'"';
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $group = $result->fetch_assoc();
                $result->close();

                // ... neuen User speichern ...
                $username = strtolower($this->anmeldung[BFT_USERNAME]);
                $password = md5($this->anmeldung[BFT_PASSWORD]);
                $regip = $_SERVER['REMOTE_ADDR'];
                $login = ($group['verifikation'] == 0) ? 1 : 0;
                $email = strtolower($this->anmeldung[BFT_EMAIL]);
                $groupname = $this->anmeldung[BFT_GRUPPENID];
                $bez = ($group['preis'] == 0) ? 1 : 0;
                $activated = ($group['verifikation'] == 0) ? 1 : 0;
                $geschlecht = ($this->anmeldung[BFT_ANREDE] == 'herr') ? 1 : 2;
                $vorname = $this->anmeldung[BFT_VORNAME];
                $nachname = $this->anmeldung[BFT_NACHNAME];
                $alter = $this->anmeldung[BFT_ALTER];
                $klasse = $this->anmeldung[BFT_KLASSE];
                $ergebnis = $group['ergebnis'];
                $ergebnism1 = $group['ergebnism1'];
                $preis = $group['preis'];
                $buchen = $group['buchen'];
                $sql = 'INSERT INTO
                            bft_users(username, password, regdate, regip, email, groupname, bez, activated, geschlecht, vorname, nachname, age, klasse, ergebnis, ergebnism1, preis, buchen)
                        VALUES
                            (?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                $stmt = $db->prepare($sql);
                if (!$stmt) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $stmt->bind_param('sssssiiissisiiii', $username, $password, $regip, $email, $groupname, $bez, $activated, $geschlecht, $vorname, $nachname, $alter, $klasse, $ergebnis, $ergebnism1, $preis, $buchen);
                if (!$stmt->execute()) {
                    die(sprintf(BFT_Lang::error, $stmt->errno, $stmt->error));
                }                            
                $stmt->close();
                
                // ... UserId abfragen ...
                $sql = 'SELECT
                            userid
                        FROM
                            '.BFT_Config::mysql_prefix.'users
                        WHERE
                            username = "'.strtolower($this->anmeldung[BFT_USERNAME]).'"';
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                if ($row = $result->fetch_assoc()) {
                    $this->userid = $row['userid'];
                }
                else {
                    die(sprintf(BFT_Lang::error, 12, 'Kann User ID nicht finden'));
                }
                $result->close();

                $this->modus = 2;
                $sql = 'UPDATE
                            bft_users
                        SET
                            login = 1
                        WHERE
                            userid = '.$this->userid;
                $db->query($sql);
                
                // ... User object updaten ...
                $user->update($this->userid);
                
                // ... Eingaben löschen ...
                unset($this->anmeldung);
                
                // ... und weiter
                $this->substep = 5;
            }
            else {
                // Fehler ist aufgetreten, nochmal
                // $this->anmeldung[BFT_PASSWORD] = '';
                // $this->anmeldung[BFT_PASSWORD2] = '';
            }
        }
        break;

    case 5:
        // Bestätigungsseite
        if (isset($_POST[BFT_NEXT])) {
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
                $this->save = 0;
        }
        break;
    
    case 6:
        // E-Mail Aktivierung
        if (isset($_POST[BFT_NEXT])) {
            $this->section = 'menu';
            $this->substep = 2;
        }
        break;

    case 10:
        // Kennwort eingeben
        if (isset($_POST[BFT_CANCEL])) {
            $this->section = 'start';
            $this->substep = 1;
        }
        elseif (isset($_POST[BFT_NEXT])) {
            $this->login[BFT_USERNAME] = isset($_POST[BFT_USERNAME]) ? $_POST[BFT_USERNAME] : '';
            
            if (strlen($this->login[BFT_USERNAME]) > -1) {
                $sql = 'SELECT
                            userid, testid, password, activated
                        FROM
                            bft_users
                        WHERE
                            username = "'.strtolower($this->login[BFT_USERNAME]).'"';
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $this->substep = 11;
                    $this->userid = $row['userid'];
                    $this->testid = $row['testid'];
                    $sql = 'UPDATE
                                bft_users
                            SET
                                login = 1,
                                lastaction = NOW()
                            WHERE
                                userid = '.$this->userid;
                    $db->query($sql);
                    if (!$db->affected_rows) {
                        die(sprintf(BFT_Lang::error, 11, 'Ungültige User ID'));
                    }
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
                    $user->update($this->userid);
                }
                else {
                    $this->error = 'Ungültiges Kennwort.';
                }
                $result->close();
            }
            unset($this->login);
        }
        break;
        
    case 11:
        // Test erfolgreich geladen
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

        break;
        
    case 20:
        // Passwort vergessen
        if (isset($_POST[BFT_NEXT])) {
            unset($this->error);
            unset($this->longerror);
            $username = isset($_POST[BFT_USERNAME]) ? $_POST[BFT_USERNAME] : '';
            if ($username == '') {
                // Keine Eingabe
                $this->error = 'Bitte geben Sie Ihre E-Mail-Adresse oder Usernamen ein!';
            }
            else {
                $sql = 'SELECT
                            userid, email, verified
                        FROM
                            bft_users
                        WHERE
                            username = "'.strtolower($username).'"';
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                if ($row = $result->fetch_assoc()) {
                    if (!$row['verified']) {
                        // Nicht verifiziert
                        $this->longerror = 'Ihre E-Mail-Adresse ist nicht verifiziert! Bitte setzen Sie sich direkt mit uns in Verbindung.<br />Email: Berufsziele@aol.de oder Tel: 040 65993820';
                    }
                    else {
                        // Alles ok - Passwort generieren
                        unset($this->error);
                        unset($this->longerror);
                        $password = BFT_Password::generate_password();
                        
                        // Neues Passwort speichern
                        $passwordmd5 = md5($password);
                        $sql = 'UPDATE
                                    bft_users
                                SET
                                    password = "'.$passwordmd5.'"
                                WHERE
                                    userid = '.$row['userid'];
                        $db->query($sql);

                        // Mail zusenden
                        $mail = new BFT_Mail();
                        $mail->SendPassword($row['userid'], $password);

                        // Nachricht anzeigen
                        $this->substep = 21;
                    }
                }
                else {
                    $sql = 'SELECT
                                email, verified
                            FROM
                                bft_users
                            WHERE
                                email = "'.strtolower($username).'"';
                    if (!$result = $db->query($sql)) {
                        die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                    }
                    if ($row = $result->fetch_assoc()) {
                        // Nicht verifiziert
                        $this->longerror = 'Ihre E-Mail-Adresse ist nicht verifiziert! Bitte setzen Sie sich direkt mit uns in Verbindung.<br />Email: Berufsziele@aol.de oder Tel: 040 65993820';
                    }
                    else {
                        // Email/Username nicht gefunden
                        $this->error = 'E-Mail-Adresse oder Username nicht gefunden!';
                    }
                }
                $result->close();
            }
            // Userdaten lesen
        }
        break;
    
    case 21:
        // Bestätigung nach Passwort vergessen
        if (isset($_POST[BFT_NEXT])) {
            $this->substep = 1;
        }
        break;
        
    case 30:
        // Einzelner Login Bildschirm für Fehlerseiten
        break;
}
?>
