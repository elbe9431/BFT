<?php
/**
 * Berufsfindungstest :: Prepare phase 1 for output
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
$this->berufsfeld = $data->berufsfeld;
$this->nav = 'Phase 1 > Schritt '.$this->step.' von '.$this->maxsteps;

switch ($data->substep) {
    case 0:
        // Einleitung
        $this->template = 'text';
        $this->nav = 'Einleitung';
        if ($this->step == 1) {
            if (!isset($data->userid) or ($data->userid == 0)) {
                $this->text[] = BFT_Lang::einleitung11;
                $this->text[] = BFT_Lang::einleitung12;
                $this->text[] = BFT_Lang::einleitung13;
                $this->text[] = BFT_Lang::einleitung14;
            }
            $this->text[] = BFT_Lang::einleitung41;
            $this->text[] = BFT_Lang::einleitung42;
            $this->text[] = BFT_Lang::einleitung43;

        }
        /*elseif ($this->step == 2) {
            $this->text[] = BFT_Lang::einleitung21;
            $this->text[] = BFT_Lang::einleitung22;
            $this->text[] = BFT_Lang::einleitung23;
        }
        elseif ($this->step == 3) {
            $this->text[] = BFT_Lang::einleitung31;
            $this->text[] = BFT_Lang::einleitung32;
            $this->text[] = BFT_Lang::einleitung33;
            $this->text[] = BFT_Lang::einleitung34;
        }
        elseif ($this->step == 2) {
            $this->text[] = BFT_Lang::einleitung41;
            $this->text[] = BFT_Lang::einleitung42;
            $this->text[] = BFT_Lang::einleitung43;
        }*/
        elseif ($this->step == 2) {
            $this->template = 'headline';
            $this->nav = 'Phase 1 > Start';
            $this->headline = BFT_Lang::phase1_headline;
            $this->text = BFT_Lang::phase1_headline_text;
        }
        elseif ($this->step == 3) {
            $this->nav = 'Phase 1 > Schritt 1 von '.$this->maxsteps;
            $this->text[] = BFT_Lang::einleitung51;
            $this->text[] = BFT_Lang::einleitung52;
            $this->text[] = BFT_Lang::einleitung53;
            $this->text[] = BFT_Lang::einleitung54;
        }
        break;
        
    case 1:
        // Einstimmungsfrage
        $this->template = 'phase1einstimmung';
        $sql = 'SELECT
                    bffrage1, bffrage2
                FROM
                    '.BFT_Config::mysql_prefix.'berufsfelder
                WHERE
                    bfid = '.$data->berufsfeld;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        $row = $result->fetch_assoc();
        $this->frage1 = $row['bffrage1'];
        $this->frage2 = $row['bffrage2'];
        $result->close();
        break;

    case 2:
        // Eigentliche Frage
        $this->template = 'phase1frage';
        $sql = 'SELECT
                    bfzeile1, fragenP1
                FROM
                    '.BFT_Config::mysql_prefix.'berufsfelder
                WHERE
                    bfid = '.$data->berufsfeld;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        $row = $result->fetch_assoc();
        $this->frage1 = sprintf(BFT_Lang::phase1_frage1, BFT_Config::max_berufswege, $row['bfzeile1']);
        $this->frage2 = sprintf(BFT_Lang::phase1_frage2, $row['fragenP1']);
        $result->close();
        $sql = 'SELECT
                    bwnameshort, bwbeschreibung
                FROM
                    '.BFT_Config::mysql_prefix.'berufswege
                WHERE
                    bfid = '.$data->berufsfeld;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        while ($row = $result->fetch_assoc()) {
            $this->berufswege[] = $row;
        }
        $result->close();
        $this->button1 = BFT_Lang::phase1_button1;
        $this->button2 = BFT_Lang::phase1_button2;
        $this->button3 = BFT_Lang::phase1_button3;
        break;

    case 3:
        // Nachfrage
        $this->template = 'phase1frage';
        $sql = 'SELECT
                    bfzeile2
                FROM
                    '.BFT_Config::mysql_prefix.'berufsfelder
                WHERE
                    bfid = '.$data->berufsfeld;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        $row = $result->fetch_assoc();
        $this->frage1 = sprintf(BFT_Lang::phase1_nachfrage1, BFT_Config::max_berufswege, $row['bfzeile2']);
        $this->frage2 = sprintf(BFT_Lang::phase1_nachfrage2, BFT_Config::max_berufswege);
        $result->close();
        $sql = 'SELECT
                    bwnameshort, bwbeschreibung
                FROM
                    '.BFT_Config::mysql_prefix.'berufswege
                WHERE
                    bfid = '.$data->berufsfeld;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        while ($row = $result->fetch_assoc()) {
            $this->berufswege[] = $row;
        }
        $result->close();
        $this->button1 = BFT_Lang::phase1_button4;
        $this->button2 = BFT_Lang::phase1_button5;
        $this->button3 = BFT_Lang::phase1_button6;
        if (isset($data->relevante[$data->berufsfeld])) {
            $this->bisher = BFT_Lang::phase1_bisher1;
        }
        elseif (isset($data->streicher[$data->berufsfeld])) {
            $this->bisher = BFT_Lang::phase1_bisher2;
        }
        elseif (isset($data->gerettete[$data->berufsfeld])) {
            $sql = 'SELECT
                        bwnameshort
                    FROM
                        '.BFT_Config::mysql_prefix.'berufswege
                    WHERE
                        bwid = '.$data->gerettete[$data->berufsfeld];
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            $row = $result->fetch_assoc();
            $this->bisher = sprintf(BFT_Lang::phase1_bisher3, $row['bwnameshort']);
            $result->close();
        }
        break;

    case 4:
        // Einen retten
        $this->template = 'phase1retten';
        $sql = 'SELECT
                    bwnameshort, bwbeschreibung
                FROM
                    '.BFT_Config::mysql_prefix.'berufswege
                WHERE
                    bfid = '.$data->berufsfeld;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        while ($row = $result->fetch_assoc()) {
            $this->berufswege[] = $row;
        }
        $result->close();
        if (isset($data->gerettete[$data->berufsfeld])) {
            $sql = 'SELECT
                        bwnameshort
                    FROM
                        '.BFT_Config::mysql_prefix.'berufswege
                    WHERE
                        bwid = '.$data->gerettete[$data->berufsfeld];
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            $row = $result->fetch_assoc();
            $this->bisher = sprintf(BFT_Lang::phase1_bisher4, $row['bwnameshort']);
            $result->close();
        }
        break;

    case 11:
        // Von vorne mit Relevanten

    case 12:
        // Von vorne mit Streichern
        $this->template = 'phase1result';
        $this->nav = 'Phase 1 > Ergebnis';
        if (count($data->todo)) {
            $sql = 'SELECT
                        bfname
                    FROM
                        '.BFT_Config::mysql_prefix.'berufsfelder
                    WHERE
                        bfid IN ('.implode(',', $data->todo).')';
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            while ($row = $result->fetch_assoc()) {
                $this->berufsfelder[] = $row;
            }
            $result->close();
        }
        break;
        
    case 21:
        // Show table
        $this->template = "phase1table";
        $this->nav = 'Phase 1 > Ergebnis';
        $this->showerror = ($this->modus > 3);
        $this->auswahl = $data->auswahl;
        $this->min = $data->min;
        $this->max = $data->max;
        if (count($data->todo)) {
            $sql = 'SELECT
                        bfname, bfid, bfbeschreibung
                    FROM
                        '.BFT_Config::mysql_prefix.'berufsfelder
                    WHERE
                        bfid IN ('.implode(',', $data->todo).')';
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            while ($row = $result->fetch_assoc()) {
                $this->berufsfelder[] = $row;
            }
            $result->close();
            foreach ($this->berufsfelder as $val) {
                $sql = 'SELECT
                            bwnameshort
                        FROM
                            '.BFT_Config::mysql_prefix.'berufswege
                        WHERE
                            bfid = '.$val['bfid'];
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                while ($row = $result->fetch_assoc()) {
                    $this->berufswege[$val['bfid']][] = $row;
                }
                $result->close();
            }
        }
        break;

    case 22:
        // Show Nachfrage einen Retten
        $this->template = 'phase1retten';
        $this->nav = 'Phase 1 > Ergebnis';
        $sql = 'SELECT
                    bwnameshort, bwbeschreibung
                FROM
                    '.BFT_Config::mysql_prefix.'berufswege
                WHERE
                    bfid = '.$data->berufsfeld;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        while ($row = $result->fetch_assoc()) {
            $this->berufswege[] = $row;
        }
        $result->close();
        $sql = 'SELECT
                    bfzeile3
                FROM
                    '.BFT_Config::mysql_prefix.'berufsfelder
                WHERE
                    bfid = '.$data->berufsfeld;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        while ($row = $result->fetch_assoc()) {
            $this->berufsfelder[] = $row;
        }
        $result->close();
        break;
    
    case 30:
        // Endseite Phase 1
        $this->template = 'text';
        $this->text[] = BFT_Lang::phase1_endseite1;
        $this->text[] = BFT_Lang::phase1_endseite2;
        $this->nav = 'Phase 1 > Ende';
        break;
}

?>
