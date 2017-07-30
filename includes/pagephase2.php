<?php
/**
 * Berufsfindungstest :: Prepare phase 2 for output
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

// General page settings
$this->step = $data->step;
$this->maxsteps = $data->maxsteps;
$this->substep = $data->substep;
$this->modus = $data->modus;
$this->nav = 'Phase 2 > Schritt '.$this->step.' von '.$this->maxsteps;

switch ($data->substep) {
    case 0:
        // Start Phase 2
        $this->template = 'headline';
        $this->nav = 'Phase 2 > Start';
        $this->headline = BFT_Lang::phase2_headline;
        $this->text = BFT_Lang::phase2_headline_text;
        break;

    case 1:
        // Papierkorb
        if ($data->modus == 11) {
            $this->todelete = $data->anz_relevante - BFT_Config::max_sortables;
            $this->template = 'textpapierkorb';
            $this->text[] = BFT_Lang::phase2_einleitung111;
            $this->text[] = sprintf(BFT_Lang::phase2_einleitung112, $data->anz_relevante);
            if ($this->todelete == 1) {
                $this->text[] = BFT_Lang::phase2_einleitung113a;
            }
            else {
                $this->text[] = sprintf(BFT_Lang::phase2_einleitung113b, $this->todelete);
            }
            $this->text[] = BFT_Lang::phase2_einleitung114;
        }
        elseif ($data->modus == 12) {
            $this->todelete = $data->anz_relevante - BFT_Config::max_sortables;
            $this->template = 'textpapierkorb';
            $this->text[] = BFT_Lang::phase2_einleitung121;
            $this->text[] = BFT_Lang::phase2_einleitung122;
            $this->text[] = BFT_Lang::phase2_einleitung123;
        }
        elseif ($data->modus == 41) {
            $this->todelete = $data->anz_gerettete - BFT_Config::max_gerettete;
            $this->template = 'textpapierkorb';
            $this->text[] = BFT_Lang::phase2_einleitung411;
            if ($this->todelete == 1) {
                $this->text[] = BFT_Lang::phase2_einleitung412a;
            }
            else {
                $this->text[] = sprintf(BFT_Lang::phase2_einleitung412b, $this->todelete);
            }
            $this->text[] = BFT_Lang::phase2_einleitung413;
            $this->text[] = BFT_Lang::phase2_einleitung414;
        }
        else {
            $this->todelete = $this->modus == 42 ? $data->anz_gerettete - BFT_Config::max_gerettete : $data->anz_relevante - BFT_Config::max_sortables;
            $this->template = 'phase2draggable';
            $sql = 'SELECT
                        bwid, bwlerninhaltshort, bwhighlight2
                    FROM
                        '.BFT_Config::mysql_prefix.'berufswege
                    WHERE
                        bwid in ('.implode(',', $data->todo).')';
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            while ($row = $result->fetch_assoc()) {
                $this->berufswege[] = $row;
            }
            $result->close();
        }
        break;

    case 2:
        // Sortieren
        if ($data->modus == 21) {
            $this->template = 'text';
            $this->text[] = sprintf(BFT_Lang::phase2_einleitung211, min($data->anz_relevante, BFT_Config::max_sortables));
            $this->text[] = BFT_Lang::phase2_einleitung212;
            $this->text[] = sprintf(BFT_Lang::phase2_einleitung213, BFT_Config::max_berufswege);
        }
        elseif ($data->modus == 31) {
            $this->template = 'text';
            $this->text[] = sprintf(BFT_Lang::phase2_einleitung311, min($data->anz_relevante, BFT_Config::max_sortables));
            $this->text[] = BFT_Lang::phase2_einleitung312;
            $this->text[] = sprintf(BFT_Lang::phase2_einleitung313, BFT_Config::max_berufswege - 1);
        }
        elseif ($data->modus == 22 or $data->modus == 32) {
            $this->template = 'text';
            $this->text[] = BFT_Lang::phase2_einleitung221;
            $this->text[] = BFT_Lang::phase2_einleitung222;
            $this->text[] = sprintf(BFT_Lang::phase2_einleitung223, min($data->anz_relevante, BFT_Config::max_sortables));
            $this->text[] = BFT_Lang::phase2_einleitung224;
        }
        elseif ($data->modus == 42) {
            $this->template = 'text';
            $this->text[] = BFT_Lang::phase2_einleitung421;
        }
        else {
            $this->tosort = count($data->todo);
            $this->template = 'phase2sortable';
            $sql = 'SELECT
                        bwid, bwlerninhaltshort, bwhighlight2
                    FROM
                        '.BFT_Config::mysql_prefix.'berufswege
                    WHERE
                        bwid in ('.implode(',', $data->todo).')';
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            while ($row = $result->fetch_assoc()) {
                $this->berufswege[] = $row;
            }
            $result->close();
        }
        break;
        
    case 3:
        $this->nav = 'Phase 2 > Ergebnis';
        if ($this->step == 1) {
            if ($user->data['erg1']) {
                $this->template = 'text';
                if ($this->modus == 0) $this->text[] = BFT_Lang::phase2_ergebnis1;
                $this->text[] = BFT_Lang::phase2_ergebnis2;
                if ($user->data['erg1'] == 1) {
                    $this->text[] = '';
                }
                else {
                    $this->text[] = BFT_Lang::phase2_ergebnis3;
                }
            }
            else {
                $this->template = 'text';
                if ($this->modus == 0) $this->text[] = BFT_Lang::phase2_ergebnis1;
                $this->text[] = 'Ihr Ergebnis erhalten Sie, nachdem Sie auch das nachfolgende Tool "Lösungen finden" durchlaufen haben.';
            }
        
        
        }
        elseif ($this->step == 2) {
            // Top 3
            $this->template = 'table';
            $this->headline = BFT_Lang::phase2_table1;
            $this->tableheader = array(BFT_Lang::phase2_table1col1, BFT_Lang::phase2_table1col2, BFT_Lang::phase2_table1col3, BFT_Lang::phase2_table1col4,);
            $this->tablerows = array();
            reset($data->berufsfelder);
            for ($i = 0; $i < 3; $i++) {
                $bf = each($data->berufsfelder);
                $sql = 'SELECT
                            bfname, bfbeschreibung
                        FROM
                            '.BFT_Config::mysql_prefix.'berufsfelder
                        WHERE
                            bfid = '.$bf[0];
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row = $result->fetch_assoc();
                $this->tablerows[] = array($i + 1, $row['bfname'], $row['bfbeschreibung'], round($bf[1]));
                $result->close();
            }
        }
        elseif ($this->step == 3) {
            $this->template = 'text';
            $this->text[] = BFT_Lang::phase2_ergebnis8;
        }
        elseif ($this->step == 4) {
            // Gesamttabelle Berfusfelder
            $this->template = 'table';
            $this->headline = BFT_Lang::phase2_table2;
            $this->tableheader = array(BFT_Lang::phase2_table2col1, BFT_Lang::phase2_table2col2, BFT_Lang::phase2_table2col3);
            $this->tablerows = array();
            $i = 1;
            foreach ($data->berufsfelder as $bfid => $prozente) {
                $sql = 'SELECT
                            bfname, bfbeschreibung
                        FROM
                            '.BFT_Config::mysql_prefix.'berufsfelder
                        WHERE
                            bfid = '.$bfid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row = $result->fetch_assoc();
                if ($i > 3) {
                    $this->tablerows[] = array($i++, $row['bfname'], round($prozente) == 0 ? 'okay' : round($prozente));
                }
                else {
                    $this->tablerows[] = array('<strong>'.$i++.'</strong>', '<strong>'.$row['bfname'].'</strong>', '<strong>'.round($prozente).'</strong>');
                }
                $result->close();
            }
        }
        elseif ($this->step == 5) {
            $this->template = 'text';
            $this->text[] = BFT_Lang::phase2_ergebnis4;
            $this->text[] = BFT_Lang::phase2_ergebnis5;
            $this->text[] = BFT_Lang::phase2_ergebnis6;
        }
        elseif ($this->step == 6) {
            // Studiengänge
            $this->template = 'table';
            $this->headline = BFT_Lang::phase2_table3;
            
            $this->tableheader = array(BFT_Lang::phase2_table3col2, BFT_Lang::phase2_table3col3);
            
            $this->tablerows = array();
            foreach ($data->result_phase2[BFT_STUDIUM] as $key => $bwid) {
                $sql = 'SELECT
                            bwname
                        FROM
                            '.BFT_Config::mysql_prefix.'berufswege
                        WHERE
                            bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();

                $bfid = floor(($bwid + 9) / 10);
                $sql = 'SELECT
                            bfname
                        FROM
                            '.BFT_Config::mysql_prefix.'berufsfelder
                        WHERE
                            bfid = '.$bfid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row2 = $result->fetch_assoc();
                $result->close();
            
                $this->tablerows[] = array($row1['bwname'], $row2['bfname']);
            }
        }
        elseif ($this->step == 7) {
            // Ausbildungsgänge
            $this->template = 'table';
            $this->headline = BFT_Lang::phase2_table4;
            
            $this->tableheader = array(BFT_Lang::phase2_table4col2, BFT_Lang::phase2_table4col3);
            
            $this->tablerows = array();
            foreach ($data->result_phase2[BFT_AUSBILDUNG] as $key => $bwid) {
                $sql = 'SELECT
                            bwname
                        FROM
                            '.BFT_Config::mysql_prefix.'berufswege
                        WHERE
                            bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();

                $bfid = floor(($bwid + 9) / 10);
                $sql = 'SELECT
                            bfname
                        FROM
                            '.BFT_Config::mysql_prefix.'berufsfelder
                        WHERE
                            bfid = '.$bfid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row2 = $result->fetch_assoc();
                $result->close();
            
                $this->tablerows[] = array($row1['bwname'], $row2['bfname']);
            }
        }
        elseif ($this->step == 8) {
            // Print results
            $this->template = 'print';
            
            // Load Berufsfelder
            $sql = 'SELECT
                        bfid, bfname, bfbeschreibung
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
                        bwid, bwname
                    FROM
                        '.BFT_Config::mysql_prefix.'berufswege';
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            while ($row = $result->fetch_assoc()) {
                $berufswege[$row['bwid']] = $row;
            }
            $result->close();

            $table1 = '<table cellspacing="0">
                <colgroup>
                    <col width="5%" />
                    <col width="30%" />
                    <col width="60%" />
                    <col width="5%" />
                </colgroup>
                <tr>
                    <th><font size="4">Platz</font></th>
                    <th><font size="4">Themenfeld</font></th>
                    <th><font size="4">Beschreibung</font></th>
                    <th><font size="4">Prozent</font></th>
                </tr>';
            $i = 1;
            foreach ($data->berufsfelder as $key => $val) {
                $table1 .= '
                    <tr>
                    <td><font size="4">'.$i++.'</font></td>
                    <td><font size="4">'.$berufsfelder[$key]['bfname'].'</font></td>
                    <td><font size="4">'.$berufsfelder[$key]['bfbeschreibung'].'</font></td>
                    <td><font size="4">'.round($val).'</font></td>
                    </tr>';
                if ($i > 3) break;
            }
            $table1 .= '</table>';

            $table2 = '<table cellspacing="0">
                <colgroup>
                    <col width="5%" />
                    <col width="90%" />
                    <col width="5%" />
                </colgroup>
                <tr>
                    <th><font size="4">Platz</font></th>
                    <th><font size="4">Themenfeld</font></th>
                    <th><font size="4">Prozent</font></th>
                </tr>';
            $i = 1;
            foreach ($data->berufsfelder as $key => $val) {
                $table2 .= '
                    <tr>
                    <td><font size="4">'.$i++.'</font></td>
                    <td><font size="4">'.$berufsfelder[$key]['bfname'].'</font></td>
                    <td><font size="4">'.round($val).'</font></td>
                    </tr>';
            }
            $table2 .= '</table>';

            $table3 = '<table cellspacing="0">
                <colgroup>
                    <col width="50%" />
                    <col width="50%" />
                </colgroup>
                <tr>
                    <th>Wunsch</th>
                    <th>Gehört zu Themenfeld</th>
                </tr>';
            foreach ($data->result_phase2['s'] as $key => $val) {
                $table3 .= '
                    <tr>
                    <td>'.$berufswege[$val]['bwname'].'</td>
                    <td>'.$berufsfelder[floor(($val + 9) / 10)]['bfname'].'</td>
                    </tr>';
            }
            $table3 .= '</table>';
            
            $table4 = '<table cellspacing="0">
                <colgroup>
                    <col width="50%" />
                    <col width="50%" />
                </colgroup>
                <tr>
                    <th>Wunsch</th>
                    <th>Gehört zu Themenfeld</th>
                </tr>';
            foreach ($data->result_phase2['a'] as $key => $val) {
                $table4 .= '
                    <tr>
                    <td>'.$berufswege[$val]['bwname'].'</td>
                    <td>'.$berufsfelder[floor(($val + 9) / 10)]['bfname'].'</td>
                    </tr>';
            }
            $table4 .= '</table>';
            
            // Load Userdata
            if ($user->data['userid'] > 0) {
                if ($user->data['vorname'] != '' and $user->data['nachname'] != '') {
                    $username = '<p class="username">Benutzer: '.$user->data['vorname'].' '.$user->data['nachname'].' - Kennwort: '.$user->data['username'].'</p>';
                }
                else {
                    $username = '<p class="username">Benutzer: '.$user->data['email'].' - Kennwort: '.$user->data['username'].'</p>';
                }
            }
            else {
                $username = '';
            }
            
            $this->printer = '<h2>Hamburger Paartherapietest</h2>';
            $this->printer .= '<h3>Ergebnis Selbsttest "Wünsche klären"</h3>';
            $this->printer .= $username;
            $this->printer .= '<hr />';
            $this->printer .= '<h4>1) Rangliste Top 3 Themenfelder, deren Wünsche häufig gewählt wurden</h4>';
            $this->printer .= $table1;
            if ($user->data['druck1'] > 1) {
                $this->printer .= '<h4>2) Gesamtrangliste Themenfelder, deren Wünsche häufig gewählt wurden</h4>';
                $this->printer .= $table2;
                if ($user->data['druck1'] == 3) {
                    $this->printer .= '<h3 class="page-break-before">Hamburger Paartherapietest</h3>';
                    $this->printer .= '<h3>Ergebnis Selbsttest "Wünsche klären"</h3>';
                    $this->printer .= $username;
                    $this->printer .= '<hr />';
                    $this->printer .= '<h4>3) Handlungsorientierte Wünsche, von denen einige Bedeutung haben könnten</h4>';
                    $this->printer .= $table3;
                    $this->printer .= '<h4>4) Einstellungsorientierte Wünsche, von denen einige Bedeutung haben könnten</h4>';
                    $this->printer .= $table4;
					$this->printer .= '<br>Nicht alle dargestellten Wünsche werden für Sie besondere Bedeutung haben. Wenn Sie Ihre Wünsche in eine klare Rangfolge bringen wollen - und Hinweise von Paartherapeuten zu deren Umsetzung erhalten möchten - dann starten Sie bitte das Tool "Lösungen finden": <br/><br/><strong>www.paartherapietest.eu | Klick auf: "Start Tool Lösungen finden" </strong>| Kennwort: '.$user->data['username'].'';
                }
            }
            
            $this->email = $user->data['email1'];
        }
        elseif ($this->step == 9) {
            // Code ausgeben
            $this->template = 'text';
            if ($user->data['email1']) {
                $this->text[] = 'Wollen Sie es genauer wissen? Aufbauend auf "Wünsche klären", können Sie auf der nächsten Seite direkt das Tool <strong>"Lösungen finden" starten!</strong>. <br/><br/>Die Testautoren empfehlen, "Lösungen finden" <strong>kurzfristig</strong> nach "Wünsche klären" durchzuführen - um ein verlässliches Gesamtergebnis zu erhalten.';
            }
            else {
                $this->text[] = 'Sie erhalten nun ein <strong>persönliches Kennwort: </strong> zum Login für Test 2, Berufswahl - falls Sie Pause machen wollen.';
            }
            $this->text[] = 'Wenn Sie jetzt oder während "Lösungen finden" eine <strong>Pause</strong> machen wollen, dann gelangen Sie wie folgt wieder genau dahin, wo Sie aufgehört haben:';
            $this->text[] = '•	unter www.paartherapietest.eu auf "Start Tool Lösungen finden" klicken; <br/>•	Ihr persönliches Kennwort eingeben. Es lautet: <strong>'.$user->data['username'].'</strong>';
        }
        break;
        
    case 4:
        $this->nav = 'Phase 2 > Ergebnis';
        if ($this->step == 1) {
            // Save results
            $this->template = 'save';
        }
        elseif ($this->step == 2) {
            // Saved feedback
            $this->template = 'text';
            $this->text[] = 'Testergebnisse wurden erfolgreich gespeichert.';
        }
        elseif ($this->step == 4) {
            // Saved feedback
            $this->template = 'text';
            $sql = 'SELECT
                        bez, buchen
                    FROM
                        bft_users
                    WHERE
                        userid = '.$data->userid;
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            $row = $result->fetch_assoc();
            $result->close();
            $this->text[] = BFT_Lang::phase2_endseite1;
            if ($row['bez'] == 0 and $row['buchen'] == 1) {
                $this->text[] = BFT_Lang::phase2_endseite4;
                $this->text[] = BFT_Lang::phase2_endseite5;
            }
            elseif ($row['bez'] == 0) {
                $this->text[] = BFT_Lang::phase2_endseite3;
            }
            else {
                $this->text[] = BFT_Lang::phase2_endseite2;
            }
        }
        if ($this->step == 3) {
            // Print results
            $this->template = 'print';
            
            // Load Berufsfelder
            $sql = 'SELECT
                        bfid, bfname, bfbeschreibung
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
                        bwid, bwname
                    FROM
                        '.BFT_Config::mysql_prefix.'berufswege';
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            while ($row = $result->fetch_assoc()) {
                $berufswege[$row['bwid']] = $row;
            }
            $result->close();

            $table1 = '<table cellspacing="0">
                <colgroup>
                    <col width="5%" />
                    <col width="30%" />
                    <col width="60%" />
                    <col width="5%" />
                </colgroup>
                <tr>
                    <th>Platz</th>
                    <th>Themenfeld</th>
                    <th>Beschreibung</th>
                    <th>Prozent</th>
                </tr>';
            $i = 1;
            foreach ($data->berufsfelder as $key => $val) {
                $table1 .= '
                    <tr>
                    <td>'.$i++.'</td>
                    <td>'.$berufsfelder[$key]['bfname'].'</td>
                    <td>'.$berufsfelder[$key]['bfbeschreibung'].'</td>
                    <td>'.round($val).'</td>
                    </tr>';
                if ($i > 3) break;
            }
            $table1 .= '</table>';

            $table2 = '<table cellspacing="0">
                <colgroup>
                    <col width="5%" />
                    <col width="90%" />
                    <col width="5%" />
                </colgroup>
                <tr>
                    <th>Platz</th>
                    <th>Themenfeld</th>
                    <th>Prozent</th>
                </tr>';
            $i = 1;
            foreach ($data->berufsfelder as $key => $val) {
                $table2 .= '
                    <tr>
                    <td>'.$i++.'</td>
                    <td>'.$berufsfelder[$key]['bfname'].'</td>
                    <td>'.round($val).'</td>
                    </tr>';
            }
            $table2 .= '</table>';

            $table3 = '<table cellspacing="0">
                <colgroup>
                    <col width="50%" />
                    <col width="50%" />
                </colgroup>
                <tr>
                    <th>Wunsch</th>
                    <th>Gehört zu Themenfeld</th>
                </tr>';
            foreach ($data->result_phase2['s'] as $key => $val) {
                $table3 .= '
                    <tr>
                    <td>'.$berufswege[$val]['bwname'].'</td>
                    <td>'.$berufsfelder[floor(($val + 9) / 10)]['bfname'].'</td>
                    </tr>';
            }
            $table3 .= '</table>';
            
            $table4 = '<table cellspacing="0">
                <colgroup>
                    <col width="50%" />
                    <col width="50%" />
                </colgroup>
                <tr>
                    <th>Wunsch</th>
                    <th>Gehört zu Themenfeld</th>
                </tr>';
            foreach ($data->result_phase2['a'] as $key => $val) {
                $table4 .= '
                    <tr>
                    <td>'.$berufswege[$val]['bwname'].'</td>
                    <td>'.$berufsfelder[floor(($val + 9) / 10)]['bfname'].'</td>
                    </tr>';
            }
            $table4 .= '</table>';
            
            // Load Userdata
            $sql = 'SELECT
                        username, vorname, nachname, ergebnism1
                    FROM
                        bft_users
                    WHERE
                        userid = '.$data->userid;
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            $user = $result->fetch_assoc();
            $result->close();

            $username = '<p class="username">Benutzer: '.$user['vorname'].' '.$user['nachname'].' ('.$user['username'].')</p>';
            
            $this->printer = '<h3>Hamburger Paartherapietest</h3>';
            $this->printer .= '<h3>Testergebnis Test 1 - Themenfelder</h3>';
            $this->printer .= $username;
            $this->printer .= '<hr />';
            $this->printer .= '<h4>1) Rangliste Top 3 Themenfelder, deren Wünsche häufig gewählt wurden</h4>';
            $this->printer .= $table1;
            $this->printer .= '<h4>2) Gesamtrangliste der Themenfelder, deren Wünsche häufig gewählt wurden</h4>';
            $this->printer .= $table2;
            if ($user['ergebnism1']) {
                $this->printer .= '<h3 class="page-break-before">Hamburger Paartherapietest</h3>';
                $this->printer .= '<h3>Testergebnis "Wünsche klären"</h3>';
                $this->printer .= $username;
                $this->printer .= '<hr />';
                $this->printer .= '<h4>3) Einige Studiengänge, die erwägenswert sein könnten</h4>';
                $this->printer .= $table3;
                $this->printer .= '<h4>4) Einige Berufsausbildungen, die erwägenswert sein könnten</h4>';
                $this->printer .= $table4;
            }
        }
        break;
        
    case 5:
        $this->nav = 'Phase 2 > Ergebnis';
        if ($this->step == 1) {
            $this->template = 'phase2email';
            $this->text[] = '<strong>Sie haben Test 1, Berufsinteressen erfolgreich beendet!</strong>';
            $this->text[] = 'Wir möchten Sie nun bitten, Ihre <strong>Emailadresse</strong> einzugeben. Hierdurch können wir die Testergebnisse für Sie speichern (notwendig, um auch Test 2, Berufswahl, nutzen zu können) und Ihnen zumailen.  Wenn Sie dies nicht wünschen, dann klicken Sie direkt auf "Weiter".';
            $this->text[] = 'Die Psychodiagnostische Beratungspraxis wird Ihre Emailadresse nur für die Hamburger Berufsfindungstests nutzen. <br/><br/>Die Adresse wird <strong>nicht weitergegeben</strong>, Sie erhalten von uns auch <strong>keine Werbemails</strong>, Newsletter oder sonstige unerwünschte Mails.';
            $this->error = $data->error;
        }
        elseif ($this->step == 2) {
            $this->template = 'text4';
            $this->text[] = 'Sie wollen darauf Verzichten, das Testergebnis per Mail zu erhalten? Den Aufbautest "Berufswahl" wollen Sie nicht durchführen? <br/><br/> Dann klicken Sie bitte auf Weiter. Sie können Ihr Testergebnis dann ausdrucken. Andernfalls auf "Zurück", zur Eingabe Ihrer Emailadresse.';
        }
        elseif ($this->step == 3) {
            $this->template = 'text';
            $this->text[] = 'Ihre Email wurde erfolgreich gespeichert.';
        }
        break;

    case 6:
        // Testende und Weiterleitung nach www.berufsziele.de
        if ($this->step == 1) {
            $this->nav = 'Phase 2 -> Testende';
            $this->template = 'phase2email';
            $this->text[] = 'Der Hamburger Berufsfindungstest 1 - Berufsinteressen endet hier.';
            $this->text[] = 'Sie haben an dieser Stelle nochmals die Möglichkeit, Ihre Emailadresse anzugeben. Hierdurch können wir die Ergebnisse für Sie speichern (notwendig, um auch <strong>Test 2, Berufswahl</strong>, nutzen zu können) und ihnen zuzumailen. Wenn Sie dies nicht wünschen, dann klicken Sie bitte ohne weitere Eingabe direkt auf "weiter".';
            $this->text[] = 'Sie werden dann auf unsere Seite http://www.paarentwicklung.de weitergeleitet, wo Sie sich über weiter Angebote zur Berufsberatung informieren können.';
            $this->error = $data->error;
        }
        break;
        
    case 7:
        if ($this->step == 1) {
            $this->nav = 'Test 2 > Einleitung';
            $this->template = 'text';
            $this->text[] = 'Der Hamburger Paartherapietest besteht aus zwei Teilen, dem Selbsttest <br><strong>"Wünsche klären"</strong> und dem Tool <strong>"Lösungen finden"</strong>. <br>Sie haben den Test <strong>"Wünsche klären"</strong> durchlaufen. <br>Es folgt nun das Tool <strong>"Lösungen finden"</strong> (Dauer ca. 30 Minuten).';
        }
        elseif ($this->step == 2) {
            $this->nav = 'Test 2 > Teilnahmebedingungen';
            $this->template = 'copyright';
        }
}
?>
