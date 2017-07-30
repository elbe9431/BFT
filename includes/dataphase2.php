<?php
/**
 * Berufsfindungstest :: Data processing for phase 2
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

switch ($this->substep) {
    case 0:
        // Start Phase 2
        if (isset($_POST[BFT_NEXT])) {
            unset($this->berufsfeld);
            unset($this->todo);
            unset($this->min);
            unset($this->max);
            unset($this->auswahl);
            $this->substep = $this->anz_relevante > BFT_Config::max_sortables ? 1 : 2;
            $this->modus = ($this->substep) * 10 + 1;
            $this->maxsteps = BFT_Config::max_berufswege + ($this->anz_gerettete > BFT_Config::max_gerettete ? 1 : 0);
            $this->step = 1;
            $this->todo = array();
            foreach ($this->relevante as $rel) {
                $this->todo[] = ($rel - 1) * 10 + $this->step;
            }
        }
        break;
        
    case 1:
        // Papierkorb
        if (isset($_POST[BFT_NEXT])) {
            if ($this->modus == 11) {
                // Einführung 1
                // $this->modus++;
                $this->modus = 31;
            }
            elseif ($this->modus == 41) {
                // Einführung Papierkorb für Gerettete
                $this->modus = 42;
            }
            elseif ($this->modus == 12) {
                // Einführung 2
                $this->modus = 31;
            }
            elseif (isset($_POST[BFT_BERUFSWEGE])) {
                // Eigentlicher Papierkorb
                $this->deleted[$this->step - 1] = explode(",", str_replace(BFT_BERUFSWEGE."_", "", $_POST[BFT_BERUFSWEGE]));
                foreach ($this->deleted[$this->step - 1] as $bw) {
                    unset($this->todo[array_search($bw, $this->todo)]);
                }
                sort($this->todo);
                $this->substep = 2;
            }
            $this->save = 1;
        }
        break;
        
    case 2:
        // Sortables
        if (isset($_POST[BFT_NEXT])) {
            if ($this->modus == 21 or $this->modus == 31) {
                // Einführung 1
                // $this->modus++;
                $this->modus = 0;
            }
            elseif ($this->modus == 22 or $this->modus == 32 or $this->modus == 42) {
                // Einführung 2
                $this->modus = 0;
            }
            elseif (isset($_POST[BFT_BERUFSWEGE])) {
                // Eigentliche Sortiertabelle
                $this->sorted[] = explode("&", str_replace(BFT_BERUFSWEGE."[]=", "", $_POST[BFT_BERUFSWEGE]));
                $this->step++;
                $this->todo = array();
                if ($this->step == BFT_Config::max_berufswege + 1) {
                    if ($this->anz_gerettete > BFT_Config::max_gerettete) {
                        // Papierkorb für Gerettete vorbereiten
                        $this->substep = 1;
                        $this->modus = 41;
                        foreach ($this->gerettete as $ger) {
                            $this->todo[] = $ger;
                        }
                    }
                    elseif ($this->anz_gerettete > 1) {
                        // Sortiertabelle für Gerettete vorbereiten
                        $this->substep = 2;
                        $this->modus = 42;
                        foreach ($this->gerettete as $ger) {
                            $this->todo[] = $ger;
                        }
                    }
                    else {
                        // Nur 1 Geretteter => Ergebnisse berechnen
                        if ($user->data['userid'] > 0) {
                            // Zu Ergebnis anzeigen
                            $this->substep = 3;
                            $this->step = 1;
                            $this->modus = 0;
                        }
                        else {
                            // Zu Email eingeben
                            $this->substep = 5;
                            $this->step = 1;
                            $this->modus = 0;
                            $this->error = 0;
                        }
                        $this->gerettete2 = $this->gerettete;
                        sort($this->gerettete2);
                        $this->result_phase2();
                    }
                }
                elseif ($this->step == BFT_Config::max_berufswege + 2) {
                    // Keine Gerettete => Ergebnisse berechnen
                    if ($user->data['userid'] > 0) {
                        // Zu Ergebnis anzeigen
                        $this->substep = 3;
                        $this->step = 1;
                        $this->modus = 0;
                    }
                    else {
                        // Zu Email eingeben
                        $this->substep = 5;
                        $this->step = 1;
                        $this->modus = 0;
                        $this->error = 0;
                    }
                    $this->result_phase2();
                }
                else {
                    // Next step
                    $this->substep = $this->anz_relevante > BFT_Config::max_sortables ? 1 : 2;
                    foreach ($this->relevante as $rel) {
                        $this->todo[] = ($rel - 1) * 10 + $this->step;
                    }
                }
            }
            $this->save = 1;
        }
        break;

    case 3:
        // Result
        if (isset($_POST[BFT_NEXT])) {
            $this->step++;
            $this->save = 1;
            $this->modus = 0;
            if ($this->step == 2 and $user->data['erg1'] == 0) {
                $this->step = 9;
            }
            if ($this->step == 3 and $user->data['erg1'] == 1) {
                $this->step = 8;
            }
            if ($this->step == 5 and $user->data['erg1'] < 3) {
                $this->step = 8;
            }
            if ($this->step == 8) {
                $this->save = 1;
                if ($user->data['druck1'] == 0) {
                    $this->step = 9;
                }
            }
            if ($this->step == 9) {
                if ($user->data['userid'] < 0) {
                    $this->substep = 6;
                    $this->step = 1;
                }
                elseif ($user->data['kennwort'] != 2) {
                    $this->substep = 7;
                    $this->step = 1;
                }
            }
            if ($this->step > 9) {
                if ($user->data['bez'] > 0) {
                    $this->substep = 7;
                    $this->step = 1;
                }
                else {
                    $this->section = 'menu';
                    $this->substep = 2;
                }
            }
        }
        break;
        
    case 4:
        // Save result
        if ($this->step == 1) {
            if (isset($_POST['speichern'])) {
                if (!isset($_POST['name']) or $_POST['name'] == '') {
                    // Error: Name eingeben!
                    $this->modus = 1;
                }
                else {
                    global $db;
                    $sql = 'SELECT
                                name
                            FROM
                                bft_results';
                    if (!$result = $db->query($sql)) {
                        die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                    }
                    while ($row = $result->fetch_assoc()) {
                        $namen[] = $row['name'];
                    }
                    $result->close();
                    if (in_array($_POST['name'], $namen)) {
                        // Error: Name existiert schon!
                        $this->modus = 2;
                    }
                    else {       
                        // Speichern
                        $sql = 'INSERT INTO
                                    bft_results(date, name, data)
                                VALUES
                                    (NOW(), ?, ?)';
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param('ss', $username, $data);
                        $username = $_POST['name'];
                        $data = $_POST['data'];
                        $stmt->execute();
                        $stmt->close();
                        $this->username = $username;
                        $this->step = 2;
                    }
                }
            }
            elseif (isset($_POST['abbrechen'])) {
                // Nicht speichern
                $this->step = 3;
            }
        }
        elseif ($this->step == 2) {
            $this->step++;
        }
        elseif ($this->step == 3) {
            $this->step++;
        }
        else {
            // Back to Mainmenu
            $this->section = 'menu';
            $this->substep = 2;
        }
        break;
        
    case 5:
        // Enter Email
        if ($this->step == 1) {
            if (isset($_POST[BFT_NEXT])) {
                $email = isset($_POST[BFT_EMAIL]) ? $_POST[BFT_EMAIL] : '';
                $errors = 0;
            
                if (($email != '') and !preg_match('/.+@.+\..+/', $email)) {
                    $this->error = '<br /><br  />Ungültige E-Mail-Adresse! (Beispiel: <em>name@mail.de</em>)';
                    $errors++;
                }
                
                if ($errors == 0) {
                    if ($email == '') {
                        // Keine Email eingegeben
                        $this->step = 2;
                    }
                    else {
                        // Alles ok, Usernamen generieren ...
                        $ok = false;
                        while (!$ok) {
                            $u1 = BFT_Password::generate_password(1, 'abcdefghkpqstuvwxy');
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

                        // ... Gruppeninfos lesen ...
                        $sql = 'SELECT
                                    verifikation, preis, ergebnis, ergebnism1, buchen
                                FROM
                                    bft_groups
                                WHERE
                                    name = "bft001"';
                        if (!$result = $db->query($sql)) {
                            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                        }
                        $group = $result->fetch_assoc();
                        $result->close();

                        // ... neuen User speichern ...
                        $password = md5($username);
                        $regip = $_SERVER['REMOTE_ADDR'];
                        $login = ($group['verifikation'] == 0) ? 1 : 0;
                        $email = strtolower($email);
                        $groupname = 'bft001';
                        $bez = ($group['preis'] == 0) ? 1 : 0;
                        $activated = 1;
                        $geschlecht = 1;
                        $vorname = '';
                        $nachname = '';
                        $alter = 0;
                        $klasse = '';
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
                                    username = "'.strtolower($username).'"';
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

                        // ... Login Status setzen ...
                        $this->modus = 2;
                        $sql = 'UPDATE
                                    bft_users
                                SET
                                    login = 1
                                WHERE
                                    userid = '.$this->userid;
                        $db->query($sql);
                        
                        // ... Test speichern ...
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
                                    p1 = 8,
                                    p2 = 0
                                WHERE
                                    userid = '.$this->userid;
                        $db->query($sql);
                        $this->save = 1;
                        
                        // ... ToDo: Email mit Ergebnissen
                        // Get user data
                        $sql = 'SELECT
                                    ergebnis, email, username
                                FROM
                                    bft_users
                                WHERE
                                    userid = '.$this->userid;
                        if (!$result = $db->query($sql)) {
                            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                        }
                        if ($row = $result->fetch_assoc()) {
                            $ergebnis = $row['ergebnis'];
                            $email = $row['email'];
                            $username = $row['username'];
                        }
                        $result->close();
                        
                        if ($ergebnis == 1 and $email != '') {
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
                            $pdf = new BFT_PDF1($email);
                            $pdf->AliasNbPages();
                            $pdf->AddPage();
                            $pdf->SetFont('Arial', '', 11);
                            $pdf->Table1($this->berufsfelder, $berufsfelder, $berufswege);
                            $pdf->AddPage();
                            $pdf->Table2($this->result_phase2, $berufsfelder, $berufswege);
                            $pdf->Ln(6);
                            $pdf->Table3($this->result_phase2, $berufsfelder, $berufswege);
                            $pdf->AddPage();
                            $pdf->Hinweise($this->userid, $username);
                            
                            // Mail
                            $file_name = "Ergebnis Test 1 Berufsinteressen.pdf";
                            $file_content = chunk_split(base64_encode($pdf->Output('', 'S')));
                            $mail = new BFT_Mail(1, $file_name, $file_content);
                            $mail->SendErgebnisTest1($this->userid, $username);
                            
                            // Ergebnis Status updaten
                            $sql = 'UPDATE
                                        bft_users
                                    SET
                                        ergebnis = 2
                                    WHERE
                                        userid = '.$this->userid;
                            $db->query($sql);
                        }

                        // ... und weiter
                        $this->step = 3;
                    }
                }            
            }
        }
        elseif ($this->step == 2) {
            if (isset($_POST[BFT_NEXT])) {
                $this->substep = 3;
                $this->step = 1;
                $this->modus = 1;
            }
        }
        elseif ($this->step == 3) {
            if (isset($_POST[BFT_NEXT])) {
                $this->substep = 3;
                $this->step = ($this->modus == 3 ? 9 : 1);
                $this-> modus = 1;
            }
        }
        break;
        
    case 6:
        // Enter Email again
        if ($this->step == 1) {
            if (isset($_POST[BFT_NEXT])) {
                $email = isset($_POST[BFT_EMAIL]) ? $_POST[BFT_EMAIL] : '';
                $errors = 0;
            
                if (($email != '') and !preg_match('/.+@.+\..+/', $email)) {
                    $this->error = '<br /><br  />Ungültige E-Mail-Adresse! (Beispiel: <em>name@mail.de</em>)';
                    $errors++;
                }
                
                if ($errors == 0) {
                    if ($email == '') {
                        // Keine Email eingegeben
                        // Forward to www.berufsziele.de
                        header('Location: http://www.paarentwicklung.de');
                        exit;
                    }
                    else {
                        // Alles ok, Usernamen generieren ...
                        $ok = false;
                        while (!$ok) {
                            $u1 = BFT_Password::generate_password(1, 'abcdefghkpqstuvwxy');
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

                        // ... Gruppeninfos lesen ...
                        $sql = 'SELECT
                                    verifikation, preis, ergebnis, ergebnism1, buchen
                                FROM
                                    bft_groups
                                WHERE
                                    name = "bft001"';
                        if (!$result = $db->query($sql)) {
                            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                        }
                        $group = $result->fetch_assoc();
                        $result->close();

                        // ... neuen User speichern ...
                        $password = md5($username);
                        $regip = $_SERVER['REMOTE_ADDR'];
                        $login = ($group['verifikation'] == 0) ? 1 : 0;
                        $email = strtolower($email);
                        $groupname = 'bft001';
                        $bez = ($group['preis'] == 0) ? 1 : 0;
                        $activated = 1;
                        $geschlecht = 1;
                        $vorname = '';
                        $nachname = '';
                        $alter = 0;
                        $klasse = '';
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
                                    username = "'.strtolower($username).'"';
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

                        // ... Login Status setzen ...
                        $this->modus = 2;
                        $sql = 'UPDATE
                                    bft_users
                                SET
                                    login = 1
                                WHERE
                                    userid = '.$this->userid;
                        $db->query($sql);
                        
                        // ... Test speichern ...
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
                                    p1 = 8,
                                    p2 = 0
                                WHERE
                                    userid = '.$this->userid;
                        $db->query($sql);
                        $this->save = 1;
                        
                        // ... Send Email mit Ergebnissen ...
                        // Get user data
                        $sql = 'SELECT
                                    ergebnis, email, username
                                FROM
                                    bft_users
                                WHERE
                                    userid = '.$this->userid;
                        if (!$result = $db->query($sql)) {
                            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                        }
                        if ($row = $result->fetch_assoc()) {
                            $ergebnis = $row['ergebnis'];
                            $email = $row['email'];
                            $username = $row['username'];
                        }
                        $result->close();
                        
                        if ($ergebnis == 1 and $email != '') {
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
                            $pdf = new BFT_PDF1($email);
                            $pdf->AliasNbPages();
                            $pdf->AddPage();
                            $pdf->SetFont('Arial', '', 11);
                            $pdf->Table1($this->berufsfelder, $berufsfelder, $berufswege);
                            $pdf->AddPage();
                            $pdf->Table2($this->result_phase2, $berufsfelder, $berufswege);
                            $pdf->Ln(6);
                            $pdf->Table3($this->result_phase2, $berufsfelder, $berufswege);
                            $pdf->AddPage();
                            $pdf->Hinweise($this->userid, $username);
                            
                            // Mail
                            $file_name = "Ergebnis Test 1 Berufsinteressen.pdf";
                            $file_content = chunk_split(base64_encode($pdf->Output('', 'S')));
                            $mail = new BFT_Mail(1, $file_name, $file_content);
                            $mail->SendErgebnisTest1($this->userid, $username);
                            
                            // Ergebnis Status updaten
                            $sql = 'UPDATE
                                        bft_users
                                    SET
                                        ergebnis = 2
                                    WHERE
                                        userid = '.$this->userid;
                            $db->query($sql);
                        }

                        // ... und weiter zu
                        $this->substep = 5;
                        $this->step = 3;
                        $this->modus = 3;
                    }
                }            
            }
        }
        break;
        
    case 7:
        // Schon bezahlt / Gruppen
        $this->step++;

		//***Entfernt Geschäftsbedingungen für Gruppen (?)***
		if ($this->step > 1) {
        //***alter Code: if ($this->step > 2) {
            if (isset($_POST[BFT_CANCEL])) {
                // Go back to startpage
                $this->section = 'start';
                $this->substep = 1;
            }
            elseif (isset($_POST[BFT_NEXT])) {
                $this->section = 'phase3';
                $this->substep = 0;
                $this->step = 0;
                $this->maxsteps =10;
                unset($this->p1);
                unset($this->p2);
                unset($this->berufswege2);
                unset($this->berufswege3);
                unset($this->todo);
                unset($this->match);
                unset($this->todelete);
                unset($this->result_phase3);
                unset($this->studium);
                unset($this->ausbildung);
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
        }
        break;

}
