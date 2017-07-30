<?php
/**
 * Berufsfindungstest :: Prepare phase 3 for output
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

// General page settings
$this->substep = $data->substep;
$this->step = $data->step;
$this->maxsteps = $data->maxsteps;
if (isset($data->modus)) $this->modus = $data->modus;
$this->nav = 'Test 2 > Einleitung';

switch ($data->substep) {
    case 0:
        // Einleitung
        $this->nav = 'Test 2 > Einleitung';
        if ($this->step == 0) {
            $this->template = 'headline';
            $this->headline = BFT_Lang::phase3_headline;
            $this->text = BFT_Lang::phase3_headline_text;
        }
        elseif ($this->step == 1) {
            $this->template = 'text';
            $this->text[] = BFT_Lang::phase3_einleitung11;
            $this->text[] = BFT_Lang::phase3_einleitung12;
            $this->text[] = BFT_Lang::phase3_einleitung13;
            $this->text[] = BFT_Lang::phase3_einleitung14;
        }
        elseif ($this->step == 2) {
            $this->template = 'text';
            $this->text[] = BFT_Lang::phase3_einleitung21;
            $this->text[] = BFT_Lang::phase3_einleitung22;
            $this->text[] = BFT_Lang::phase3_einleitung23;
            $this->text[] = BFT_Lang::phase3_einleitung24;
        }
        elseif ($this->step == 3) {
            $this->template = 'text';
            $this->text[] = BFT_Lang::phase3_einleitung25;
        }
        break;

    case 1:
        // Seite vor Vergleichen
        $this->nav = 'Durchgang '.$this->modus.' von 5 > Einleitung';
        $this->template = 'text';
        $pp = array(1 => 'erste', 2 => 'zweite', 3 => 'dritte', 4 => 'vierte', 5 => 'fünfte');
        $this->text[] = sprintf(BFT_Lang::phase3_einleitung31, $pp[$this->modus], count($data->berufswege3));
        if ($this->modus < 5) {
            $this->text[] = BFT_Lang::phase3_einleitung32;
        }
        if ($this->modus == 1) {
            $this->text[] = BFT_Lang::phase3_einleitung33;
        }
        break;

    case 2:
        // Vergleiche
        $this->nav = 'Durchgang '.$this->modus.' von 5 > Vergleich '.$this->step.' von '.$this->maxsteps;
        $this->template = 'phase3compare';

        $sql = 'SELECT
                    bwid, bwtyp, bwname, bwlerninhalt, bwtätigkeit, bwberater
                FROM
                    bft_berufswege
                WHERE
                    bwid = '.$data->match[0];
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        $this->berufsweg[1] = $result->fetch_assoc();
        $this->berufsweg[1]['bwtyp'] = $this->berufsweg[1]['bwtyp'] == 's' ? 'Studium' : 'Ausbildung';
        $result->close();
        
        $sql = 'SELECT
                    bwid, bwtyp, bwname, bwlerninhalt, bwtätigkeit, bwberater
                FROM
                    bft_berufswege
                WHERE
                    bwid = '.$data->match[1];
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        $this->berufsweg[2] = $result->fetch_assoc();
        $this->berufsweg[2]['bwtyp'] = $this->berufsweg[2]['bwtyp'] == 's' ? 'Studium' : 'Ausbildung';
        $result->close();
        break;
    
    case 3:
        // Pre Papierkorb
        $this->nav = 'Durchgang '.$this->modus.' von 5 > Papierkorb';
        $this->template = 'text';
        $pp = array(1 => 'ersten', 2 => 'zweiten', 3 => 'dritten', 4 => 'vierten', 5 => 'fünften');
        $this->text[] = sprintf(BFT_Lang::phase3_einleitung41, $pp[$this->modus]);
        $this->text[] = BFT_Lang::phase3_einleitung42;
        break;

    case 4:
        // Papierkorb
        $this->nav = 'Durchgang '.$this->modus.' von 5 > Papierkorb';
        $this->template = 'phase3draggable';
        $this->todelete = $data->todelete;
        $this->todo = $data->todo;
        $sql = 'SELECT
                    bwid, bwname, bwlerninhalt, bwhighlight2
                FROM
                    '.BFT_Config::mysql_prefix.'berufswege
                WHERE
                    bwid in ('.implode(',', $this->todo).')';
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        while ($row = $result->fetch_assoc()) {
            $this->berufswege[] = $row;
        }
        $result->close();
        break;

    case 5:
        // Ergebnis
        $this->nav = 'Test 2 -> Ergebnisse';
        if ($this->step == 1) {
            $this->template = 'text';
            $this->text[] = BFT_Lang::phase3_ergebnis11;
            $this->text[] = BFT_Lang::phase3_ergebnis12;
            if ($user->data['erg2'] == 2) {
                $this->text[] = 'Zunächst vorab die Rangliste der <strong>Themenfelder</strong> als Ergebnis des Tests "Wünsche klären".';
            }
            else {
                $this->text[] = BFT_Lang::phase3_ergebnis13;#
            }
        }
        elseif ($this->step == -10) {
            $this->template = 'table';
            $this->headline = 'Gesamtrangliste der Themenfelder, deren Wünsche häufig gewählt wurden';
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
        elseif ($this->step == -9) {
            $this->template = 'text';
            $this->text[] = 'Jetzt die 3 eher handlungsorientierten Wünsche, die Sie am wichtigsten bewertet haben.';
        }
        
        
        if ($this->step == 2) {
            // 3 eher handlungsorientierten Wünsche
            $this->template = 'table';
            $this->headline = BFT_Lang::phase3_table2;
            $this->tableheader = array(BFT_Lang::phase3_table2col1, BFT_Lang::phase3_table2col2, BFT_Lang::phase3_table2col3, BFT_Lang::phase3_table2col4);

            $i = 1;
            $this->tablerows = array();
            foreach ($data->studium as $bwid => $val) {
			// $i bestimmt die Anzahl der Reihen (maximal 10) 
			if ($i > 3) break;
                $sql = 'SELECT
                            bwname, bwtyp
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
            
                $this->tablerows[] = array($i++, $row1['bwname'], $row2['bfname'], min(100, round($val / BFT_Config::max_punkte * 100)));
            }
        }
        if ($this->step == 3) {
            $this->template = 'text';
            $this->text[] = BFT_Lang::phase3_ergebnis31;
        }
        elseif ($this->step == 4) {
            // 3 Wünsche in Richtung „Einstellungen“
            $this->template = 'table';
            $this->headline = BFT_Lang::phase3_table3;
            $this->tableheader = array(BFT_Lang::phase3_table3col1, BFT_Lang::phase3_table3col2, BFT_Lang::phase3_table3col3, BFT_Lang::phase3_table3col4);

            $i = 1;
            $this->tablerows = array();
            foreach ($data->ausbildung as $bwid => $val) {
		// $i bestimmt die Anzahl der Reihen (maximal 10) 
			if ($i > 3) break;

                $sql = 'SELECT
                            bwname, bwtyp
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
            
                $this->tablerows[] = array($i++, $row1['bwname'], $row2['bfname'], min(100, round($val / BFT_Config::max_punkte * 100)));
            }
        }
elseif ($this->step == 5) {
            // Hier die 3 Wünsche, die Sie insgesamt als aktuell am wichtigsten bewertet haben
            $this->template = 'table';
            $this->headline = BFT_Lang::phase3_table1;
            $this->tableheader = array(BFT_Lang::phase3_table1col1, BFT_Lang::phase3_table1col2, BFT_Lang::phase3_table1col4, BFT_Lang::phase3_table1col5);

            $i = 1;
            $this->tablerows = array();
            foreach ($data->result_phase3 as $bwid => $val) {
			// $i bestimmt die Anzahl der Reihen (maximal 10) 
			if ($i > 3) break;

                $sql = 'SELECT
                            bwname, bwtyp
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
            
                $this->tablerows[] = array($i++, $row1['bwname'], $row2['bfname'], min(100, round($val / BFT_Config::max_punkte * 100)));
            }
        }

	if ($this->step == 6) {
            $this->template = 'text';
            $this->text[] = BFT_Lang::phase3_ergebnis21;
	     $this->text[] = BFT_Lang::phase3_ergebnis22;
        }


if ($this->step == 7) {
    // PRE Wunsch 1 von 3
    // Es wird nur über bwname der Wunsch ausgelesen. Der Rest ist Vorbereitung für die Videoeinbindung. Texte sind im Template gespeichert. 
            $this->template = 'pre-wunsch';
	$this->text[] = BFT_Lang::phase3_pre1img;
	     $this->headline = BFT_Lang::phase3_pre1;
            $this->tableheader = array(BFT_Lang::phase3_table3col2, BFT_Lang::phase3_table3col3);
			reset($data->result_phase3);
 			$bwid = key($data->result_phase3);
            $this->tablerows = array();
                $sql = 'SELECT
                           bwname, bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();
 
 
          $sql = 'SELECT
                           bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row3 = $result->fetch_assoc();
                $result->close();
 
           
           $sql = 'SELECT
                           youtube_ohne_Liste
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row4 = $result->fetch_assoc();
                $result->close();

                $this->tablerows[] = array($row1['bwname'], $row3['bwzukunft2'], $row4['youtube_ohne_Liste']);
 
            
        }
	
if ($this->step == 8) {
    // Wunsch 1 von 3
            $this->template = 'table-wunsch';
            
            $this->tableheader = array(BFT_Lang::phase3_table3col2, BFT_Lang::phase3_table3col3);
			reset($data->result_phase3);
 			$bwid = key($data->result_phase3);
            $this->tablerows = array();
                $sql = 'SELECT
                           bwzukunft1, bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();
 
 
          $sql = 'SELECT
                           bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row3 = $result->fetch_assoc();
                $result->close();

 
           
           
                $this->tablerows[] = array($row1['bwzukunft1'], $row3['bwzukunft2']);
 
            
        }

if ($this->step == 9) {
    // PRE Wunsch 2 von 3
    // Es wird nur über bwname der Wunsch ausgelesen. Der Rest ist Vorbereitung für die Videoeinbindung. Texte sind im Template gespeichert. 
            $this->template = 'pre-wunsch';
$this->text[] = BFT_Lang::phase3_pre2img;
	     $this->headline = BFT_Lang::phase3_pre2;
            $this->tableheader = array(BFT_Lang::phase3_table3col2, BFT_Lang::phase3_table3col3);
			reset($data->result_phase3);
			next($data->result_phase3);
 			$bwid = key($data->result_phase3);
            $this->tablerows = array();
                $sql = 'SELECT
                           bwname, bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();
 
 $sql = 'SELECT
                           bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row3 = $result->fetch_assoc();
                $result->close();


         $sql = 'SELECT
                           youtube_ohne_Liste
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row4 = $result->fetch_assoc();
                $result->close();

                $this->tablerows[] = array($row1['bwname'], $row3['bwzukunft2'], $row4['youtube_ohne_Liste']);
 
            
        }

if ($this->step == 10) {
    // Wunsch 2 von 3
            $this->template = 'table-wunsch';
            $this->headline = BFT_Lang::phase3_table3;
            $this->tableheader = array(BFT_Lang::phase3_table3col2, BFT_Lang::phase3_table3col3);
			reset($data->result_phase3);
			next($data->result_phase3);
 			$bwid = key($data->result_phase3);
            $this->tablerows = array();
                $sql = 'SELECT
                           bwzukunft1, bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();
 
 
          $sql = 'SELECT
                           bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row3 = $result->fetch_assoc();
                $result->close();
 
           
           
                $this->tablerows[] = array($row1['bwzukunft1'], $row3['bwzukunft2']);
 
            
        }

if ($this->step == 11) {
    // PRE Wunsch 3 von 3
    // Es wird nur über bwname der Wunsch ausgelesen. Der Rest ist Vorbereitung für die Videoeinbindung. Texte sind im Template gespeichert. 
            $this->template = 'pre-wunsch';
$this->text[] = BFT_Lang::phase3_pre3img;
	     $this->headline = BFT_Lang::phase3_pre3;
            $this->tableheader = array(BFT_Lang::phase3_table3col2, BFT_Lang::phase3_table3col3);
			reset($data->result_phase3);
			next($data->result_phase3);
			next($data->result_phase3);
 			$bwid = key($data->result_phase3);
            $this->tablerows = array();
                $sql = 'SELECT
                           bwname, bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();


 $sql = 'SELECT
                           bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row3 = $result->fetch_assoc();
                $result->close();

 
          $sql = 'SELECT
                           youtube_ohne_Liste
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row4 = $result->fetch_assoc();
                $result->close();

                $this->tablerows[] = array($row1['bwname'], $row3['bwzukunft2'], $row4['youtube_ohne_Liste']);
 
            
        }

if ($this->step == 12) {
    // Wunsch 3 von 3
            $this->template = 'table-wunsch';
            $this->headline = BFT_Lang::phase3_table3;
            $this->tableheader = array(BFT_Lang::phase3_table3col2, BFT_Lang::phase3_table3col3);
			reset($data->result_phase3);
			next($data->result_phase3);
			next($data->result_phase3);
 			$bwid = key($data->result_phase3);
            $this->tablerows = array();
                $sql = 'SELECT
                           bwzukunft1, bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();
 
 
          $sql = 'SELECT
                           bwzukunft2
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row3 = $result->fetch_assoc();
                $result->close();
 
           
           
                $this->tablerows[] = array($row1['bwzukunft1'], $row3['bwzukunft2']);
 
            
        }

	
        if ($this->step == 13) {
            // Print results 
            $this->template = 'print';
            
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
                        bwid, bfid, bwname, bwtyp, bwzukunft1, bwzukunft2_absatz
                    FROM
                        '.BFT_Config::mysql_prefix.'berufswege';
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            while ($row = $result->fetch_assoc()) {
                $berufswege[$row['bwid']] = $row;
            }
            $result->close();
		
            $table0 = '<table cellspacing="0">
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
	// $i bestimmt die Anzahl der Reihen (maximal 10) 
			if ($i > 3) break;
                $table0 .= '
                    <tr>
                    <td>'.$i++.'</td>
                    <td><font size="4">'.$berufsfelder[$key]['bfname'].'</font></td>
                    <td><font size="4">'.round($val).'</font></td>
                    </tr>';
            }
            $table0 .= '</table>';

            $table1 = '<table cellspacing="0">
                <colgroup>
                    <col width="5%" />
                    <col width="45%" />
                    <col width="45%" />
                    <col width="5%" />
                    
                </colgroup>
                <tr>
                    <th><font size="4">Platz</font></th>
                    <th><font size="4">Wunsch</font></th>
                    <th><font size="4">Themenfeld</font></th>
                    <th><font size="4">Prozent</font></th>
                </tr>';
            $i = 1;
            foreach ($data->result_phase3 as $key => $val) {
		// $i bestimmt die Anzahl der Reihen (maximal 10) 
			if ($i > 3) break;
                $table1 .= '
                    <tr>
                    <td><font size="4">'.$i++.'</font></td>
                    <td><font size="4">'.$berufswege[$key]['bwname'].'</font></td>
                    <td><font size="4">'.$berufsfelder[$berufswege[$key]['bfid']]['bfname'].'</font></td>
                    <td><font size="4">'.min(100, round($val / BFT_Config::max_punkte * 100)).'</font></td>
                    </tr>';
            }
            $table1 .= '</table>';

            $table2 = '<table cellspacing="0">
                <colgroup>
                    <col width="5%" />
                    <col width="45%" />
                    <col width="45%" />
                    <col width="5%" />
                </colgroup>
                <tr>
                    <th><font size="4">Platz</font></th>
                    <th><font size="4">Wunsch</font></th>
                    <th><font size="4">Themenfeld</font></th>
                    <th><font size="4">Prozent</font></th>
                </tr>';
            $i = 1;
            foreach ($data->studium as $key => $val) {
	// $i bestimmt die Anzahl der Reihen (maximal 10) 
			if ($i > 3) break;
                $table2 .= '
                    <tr>
                    <td><font size="4">'.$i++.'</font></td>
                    <td><font size="4">'.$berufswege[$key]['bwname'].'</font></td>
                    <td><font size="4">'.$berufsfelder[$berufswege[$key]['bfid']]['bfname'].'</font></td>
                    <td><font size="4">'.min(100, round($val / BFT_Config::max_punkte * 100)).'</font></td>
                    </tr>';
            }
            $table2 .= '</table>';

            $table3 = '<table cellspacing="0">
                <colgroup>
                    <col width="5%" />
                    <col width="45%" />
                    <col width="45%" />
                    <col width="5%" />
                </colgroup>
                <tr>
                    <th><font size="4">Platz</font></th>
                    <th><font size="4">Wunsch</font></th>
                    <th><font size="4">Themenfeld</font></th>
                    <th><font size="4">Prozent</font></th>
                </tr>';
            $i = 1;
            foreach ($data->ausbildung as $key => $val) {
		// $i bestimmt die Anzahl der Reihen (maximal 10) 
			if ($i > 3) break;
                $table3 .= '
                    <tr>
                    <td><font size="4">'.$i++.'</font></td>
                    <td><font size="4">'.$berufswege[$key]['bwname'].'</font></td>
                    <td><font size="4">'.$berufsfelder[$berufswege[$key]['bfid']]['bfname'].'</font></td>
                    <td><font size="4">'.min(100, round($val / BFT_Config::max_punkte * 100)).'</font></td>
                    </tr>';
            }

            $table3 .= '</table>';

			reset($data->result_phase3);
			$bwid = key($data->result_phase3);
            $this->tablerows = array();
                $sql = 'SELECT
                           bwzukunft1, bwzukunft2_absatz
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();
 
 
          $sql = 'SELECT
                           bwzukunft2_absatz
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row3 = $result->fetch_assoc();
                $result->close();
 
           
           
                $this->tablerows[] = array($row1['bwzukunft1'], $row3['bwzukunft2_absatz']);
			
 		$table4 = '<table cellspacing="0" border="0">
                <colgroup>
                    
                    <col width="0%" />
                    <col width="100%" />
                </colgroup>';
		
            foreach($this->tablerows as $soetzin_row) {
  $table4 .= '<table><tr><td><h2>'.$soetzin_row[0].'</h2></td></tr><tr><td><p style="font-size:19px;">'.$soetzin_row[1].'</p></td></tr></table>';
            }
            $table4 .= '</table>';

			reset($data->result_phase3);
			next($data->result_phase3);

			$bwid = key($data->result_phase3);
            $this->tablerows = array();
                $sql = 'SELECT
                           bwzukunft1, bwzukunft2_absatz
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();
 
 
          $sql = 'SELECT
                           bwzukunft2_absatz
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row3 = $result->fetch_assoc();
                $result->close();
 
           
           
                $this->tablerows[] = array($row1['bwzukunft1'], $row3['bwzukunft2_absatz']);
			
 		$table5 = '<table cellspacing="0" border="0">
                <colgroup>
                    
                    <col width="0%" />
                    <col width="100%" />
                </colgroup>';
		
            foreach($this->tablerows as $soetzin_row) {
  $table5 .= '<table><tr><td><h2>'.$soetzin_row[0].'</h2></td></tr><tr><td><p style="font-size:19px;">'.$soetzin_row[1].'</p></td></tr></table>';
            }
            $table5 .= '</table>';


			reset($data->result_phase3);			
			next($data->result_phase3);
			next($data->result_phase3);

			$bwid = key($data->result_phase3);
            $this->tablerows = array();
                $sql = 'SELECT
                           bwzukunft1, bwzukunft2_absatz
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row1 = $result->fetch_assoc();
                $result->close();
 
 
          $sql = 'SELECT
                           bwzukunft2_absatz
                       FROM
                           '.BFT_Config::mysql_prefix.'berufswege
                       WHERE
                           bwid = '.$bwid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                $row3 = $result->fetch_assoc();
                $result->close();
 
           
           
                $this->tablerows[] = array($row1['bwzukunft1'], $row3['bwzukunft2_absatz']);
			
 		$table6 = '<table cellspacing="0" border="0">
                <colgroup>
                    
                    <col width="0%" />
                    <col width="100%" />
                </colgroup>';
		
            foreach($this->tablerows as $soetzin_row) {
  $table6 .= '<table><tr><td><h2>'.$soetzin_row[0].'</h2></td></tr><tr><td><p style="font-size:19px;">'.$soetzin_row[1].'</p></td></tr></table>';
            }
            $table6 .= '</table>';


            
            // Load Userdata
            $sql = 'SELECT
                        username, vorname, nachname, email
                    FROM
                        bft_users
                    WHERE
                        userid = '.$data->userid;
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            $row = $result->fetch_assoc();
            $result->close();

            $username = '<p class="username">Benutzer: '.$row['email'].' ('.$row['username'].')</p>';
            
            $this->email = $user->data['email2'];
            
            if ($user->data['druck2'] == 2) {
                $this->printer =
                    '<h3>Hamburger Paartherapietest</h3>'.
                    '<h3>Gesamtergebnis Selbsttest "Wünsche klären" und Tool "Lösungen finden"</h3>'.
                    $username.
                    '<hr />'.
                    '<h4>1) Rangliste der Themenfelder</h4>'.
                    $table0.
                                   
                  
                    '<h4>2) Rangliste Top 3 der handlungsorientierten Wünsche</h4>'.
                    $table2.
                    '<h4>3) Rangliste Top 3 der Wünsche, welche stärker Einstellungen betreffen</h4>'.
                    $table3.
                    '<h3>4) Rangliste Top 3 aller Wünsche als Endergebnis</h3>'.
                    $table1.
                     '<h3 class="page-break-before">Hamburger Paartherapietest</h3>'.
		      '<h4></h4>'.
                    $table4.
                     '<h3 class="page-break-before">Hamburger Paartherapietest</h3>'.

		      '<h4></h4>'.
                    $table5.
                     '<h3 class="page-break-before">Hamburger Paartherapietest</h3>'.

		      '<h4></h4>'.
                    $table6;
            }
            else {
                $this->printer =
                    '<h2>Hamburger Paartherapie-Test</h2>'.
                    '<h2>Ergebnis Tool „Lösungen finden“</h2>'.
                    $username.
                    '<hr />'.
                   
                    '<h4>1) Rangliste Top 3 der handlungsorientierten Wünsche</h4>'.
                    $table2.
                    '<h4>2) Rangliste Top 3 der Wünsche, welche stärker Einstellungen betreffen</h4>'.
                    $table3.
                     '<h3>3) Rangliste Top 3 aller Wünsche als Endergebnis</h3>'.
                    $table1.
		      '<h4 class="page-break-before"></h4>'.
                    $table4.
		      '<h4 class="page-break-before"></h4>'.
                    $table5.
		      '<h4 class="page-break-before"></h4>'.
                    $table6;
            }
        }
        elseif ($this->step == 14) {
            // Show page "Testende" with some info text and a next button.
            $this->nav = 'Testende';
            $this->template = 'text';
            $this->headline = 'Testende';
            if ($user->data['buchen'] == 1) {
                $this->text[] = 'Sie haben jetzt die Hamburger Paartherapietest komplett durchlaufen. Sie werden jetzt auf unsere Homepage weitergeleitet.';
            }
            else {
                $this->text[] = BFT_Lang::phase3_endseite1;
            }
        }
        elseif ($this->step == 15) {
            // Show a page where the user can enter feedback. The feedback will be saved in
            // dataphase3.php in case 5 -> step 16.
            $this->nav = 'Feedback';
            $this->template = 'feedback';
            $this->headline = 'Feedback';
        }
		
        break;
        
    case 6:
        // Endseite, wenn Überweisung noch aussteht
        $this->nav = 'Test 2 -> Ergebnisse';
        $this->template = 'text';
        $this->headline = 'Testende';
        $this->text[] = BFT_Lang::phase3_endseite2;
        $this->text[] = BFT_Lang::phase3_endseite3;
        $this->text[] = 'Sie werden jetzt auf unsere Homepage www.paarentwicklung.de weitergeleitet.';
        break;        
}
?>
