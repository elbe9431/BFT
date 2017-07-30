<?php
/**
 * Berufsfindungstest :: Data storing and processing
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_Data
{
    public function processdata()
    {
        global $db;
        global $user;
        $this->error = 0;
        $this->save = 0;
        if (!isset($this->section)) {
            // No section set
            $this->section = 'start';
        }
        elseif (!file_exists(BFT_PATH_BASE.DS.'includes'.DS.'data'.$this->section.'.php')) {
            // File not found
            die(sprintf(BFT_Lang::error, 2, 'Eine interne Datei konnte nicht gefunden werden'));
        }
        else {
            // Check login data
            if (isset($this->userid)) {
                // Check database
                $sql = 'SELECT
                            login, lastaction, activated
                        FROM
                            bft_users
                        WHERE
                            userid = '. $this->userid;
                if (!$result = $db->query($sql)) {
                    die(sprintf(BFT_Lang::error, $db->errno, $db->error));
                }
                if (!$row = $result->fetch_assoc()) {
                    // UserId not found
                    $this->section = 'login';
                    $this->substep = 1;
                    $this->error = 'Ihre UserId ist ungültig! Bitte loggen Sie sich erneut ein.';
                    unset($this->userid);
                }/*
                elseif (!$row['activated']) {
                    // Account nicht aktiviert
                    $this->section = 'login';
                    $this->substep = 1;
                    $this->error = 'Ihr Account ist (noch) nicht aktiviert! Bitte folgen Sie den Anweisungen in der E-Mail oder setzen Sie sich direkt mit uns in Verbindung.';
                    unset($this->userid);
                }
                elseif (!$row['login']) {
                    // User not logged in
                    $this->section = 'login';
                    $this->substep = 1;
                    $this->error = 'Sie sind nicht mehr angemeldet! Bitte loggen Sie sich erneut ein.';
                    unset($this->userid);
                }
                else {
                    // Last login abgelaufen
                    $now = time();
                    $lastaction = strtotime($row['lastaction']);
                    if ($now > $lastaction + 1800) {    // + 30 minutes
                        $this->section = 'login';
                        $this->substep = 1;
                        $this->error = 'Ihr Login ist abgelaufen, da Sie zu lange inaktiv waren. Bitte loggen Sie sich erneut ein.';
                        unset($this->userid);
                    }
                }*/
                $result->close();
            }

            // Load process file
            require_once BFT_PATH_BASE.DS.'includes'.DS.'data'.$this->section.'.php';
        }
    }

    public function save_actions($encrypted, $hash)
    {
        global $db;
        if (isset($this->userid) and $this->userid != 0) {
            // Always update last action time
            $sql = 'UPDATE
                        bft_users
                    SET
                        lastaction = NOW()
                    WHERE
                        userid = '.$this->userid;
            $db->query($sql);

            // Save test
            if ($this->save) {
                $sql = 'UPDATE
                            bft_tests
                        SET
                            date = NOW(),
                            data = "'.$encrypted.'",
                            hash = "'.$hash.'"
                        WHERE
                            testid = '.$this->testid;
                $db->query($sql);
            }
        }
    }
    
    private function result_phase2()
    {
        // Berufsfelder und -wege bewerten
        $this->berufsfelder = array_fill(1, BFT_Config::max_berufsfelder, 0);
        $this->berufswege = array();
        for ($i = 0; $i < BFT_Config::max_berufswege; $i++) {
            $count = count($this->sorted[$i]);
            foreach ($this->sorted[$i] as $key => $val) {
                $bfid = floor(($val + 9) / 10);
                $this->berufsfelder[$bfid] += 10 - (10 / $count) * $key;
            }
            $this->berufswege[$this->sorted[$i][0]] = 1.5;
            $this->berufswege[$this->sorted[$i][1]] = 1;
            $this->berufswege[$this->sorted[$i][2]] = .5;
        }
        if (!isset($this->gerettete2)) {
            $this->gerettete2 = $this->sorted[BFT_Config::max_berufswege];
        }
        $count = count($this->gerettete2);
        foreach ($this->gerettete2 as $key => $val) {
            $bfid = floor(($val + 9) / 10);
            $this->berufsfelder[$bfid] += 10 - (10 / $count) * $key;
        }
        arsort($this->berufsfelder);
        ksort($this->berufswege);
        
        // Get all bwtypes
        global $db;
        $sql = 'SELECT
                    bwid, bwtyp
                FROM
                    '.BFT_Config::mysql_prefix.'berufswege';
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        while ($row = $result->fetch_assoc()) {
            $bwtyp[$row['bwid']] = $row['bwtyp'];
        }
        $result->close();

        // Calculate temporary result tables
        $winnerbf = true;
        $result = array();
        $result['s'] = array_fill(0, 5, array());
        $result['a'] = array_fill(0, 5, array());
        foreach ($this->berufsfelder as $bfid => $prozente) {
            foreach ($this->berufswege as $bwid => $wert) {
                if ($wert > 0.5 and $bfid == floor(($bwid + 9) / 10)) {
                    $group = $wert == 1.5 ? 0 : 1;
                    $group += $winnerbf ? 0 : 2;
                    $result[$bwtyp[$bwid]][$group][] = $bwid;
                }
            }
            $winnerbf = false;
        }
        
        foreach ($this->gerettete2 as $bwid) {
            $result[$bwtyp[$bwid]][4][] = $bwid;
        }
        
        // Calculate final result tables
        $this->result_phase2 = array();
        foreach ($result as $key => $arr) {
            // Erstplatzierte Siegerberufsfeld + Erstplatzierte andere Felder + 2 Gerettete
            $this->result_phase2[$key] = array_merge($arr[0], $arr[2], array_slice($arr[4], 0, 2));
            if (count($arr[0]) == 0) {
                // Falls keine Erstplatzierten im Siegerberufsfeld, dann
                // mit Zweitplatzierten des Siegerberufsfeldes auffüllen bis 8, mind. jedoch 2
                $num = max(2, 8 - count($this->result_phase2[$key]));
                $this->result_phase2[$key] = array_merge(array_slice($arr[1], 0, $num), $this->result_phase2[$key]);
            }
            if (count($this->result_phase2[$key]) == 0) {
                // Falls Ergebnistabelle immer noch leer, dann
                // mit beliebigen Zweitplatzierten auffüllen bis 8, mind. jedoch 2
                $num = max(2, 8 - count($this->result_phase2[$key]));
                $this->result_phase2[$key] = array_slice($arr[3], 0, $num);
            }
        }
        
        // Gerettete zur Liste für Phase 3 hinzufügen
        foreach ($this->gerettete2 as $key => $bwid) {
            $this->berufswege[$bwid] = 1.5 - 0.5 * $key;
        }
        
        // Falls ungerade, dann einen Viertplatzierten hinzufügen
        if (count($this->berufswege) % 2 == 1) {
            if (count($this->sorted[0]) > 3) {
                // Viertplatzierter aus erster Sortiertabelle
                $this->berufswege[$this->sorted[0][3]] = 0;
            }
            else {
                // 3 Relevante, 1 oder 3 Gerettete:
                // ersten Beruf aus Gruppe des ersten Geretteten
                $bw1 = $this->gerettete2[0];
                $bw2 = $bw1 - (($bw1 - 1) % 10);
                $bw3 = ($bw1 == $bw2) ? $bw2 + 1 : $bw2;
                $this->berufswege[$bw3] = 0;
            }
        }
        
        ksort($this->berufswege);
        
        // Set status in db for phase 1 to done
        if (isset($this->userid) and ($this->userid > 0)) {
            $sql = 'UPDATE
                        bft_users
                    SET
                        p1 = 8
                    WHERE
                        userid = '.$this->userid;
            $db->query($sql);
        }
    }
    
    private function calculate_table_phase2($selector)
    {

        $winnerbf = true;
        foreach ($this->berufsfelder as $bfid => $prozente) {
            // Erstplatzierte
            foreach ($this->berufswege as $bwid => $wert) {
                if ($wert == 1.5 and $bwtyp[$bwid] == $selector and $bfid == floor(($bwid + 9) / 10)) {
                    $this->result_phase2[$selector][] = $bwid;
                }
            }
            if ($winnerbf) {
                if (count($this->result_phase2[$selector]) == 0) {
                    // Zweitplatzierte des Siegerberufsfeldes
                    foreach ($this->berufswege as $bwid => $wert) {
                        if ($wert == 1 and $bwtyp[$bwid] == $selector and $bfid == floor(($bwid + 9) / 10)) {
                            $this->result_phase2[$selector][] = $bwid;
                        }
                        while (count($this->result_phase2[$selector]) > 5) {
                            array_pop($this->result_phase2[$selector]);
                        }
                    }
                }
                if (count($this->result_phase2[$selector]) == 0) {
                    // Drittplatzierte des Siegerberufsfeldes
                    foreach ($this->berufswege as $bwid => $wert) {
                        if ($wert == 0.5 and $bwtyp[$bwid] == $selector and $bfid == floor(($bwid + 9) / 10)) {
                            $this->result_phase2[$selector][] = $bwid;
                        }
                        while (count($this->result_phase2[$selector]) > 5) {
                            array_pop($this->result_phase2[$selector]);
                        }
                    }
                }
                $winnerbf = false;
            }
        }
        
        foreach ($this->gerettete2 as $bwid) {
            // Gerettete
            if ($bwtyp[$bwid] == $selector) {
                $this->result_phase2[$selector][] = $bwid;
            }
        }
        
        if (count($this->result_phase2[$selector]) == 0) {
            // Beliebige Zweitplatzierte
            foreach ($data->berufsfelder as $bfid => $prozente) {
                foreach ($data->berufswege as $bwid => $wert) {
                    if ($wert == 1 and $bwtyp[$bwid] == $selector and $bfid == floor(($bwid + 9) / 10)) {
                        $this->result_phase2[$selector][] = $bwid;
                    }
                }
            }
        }
    }
    
    private function match($array)
    {
        arsort($array);
        reset($array);
        $a = key($array);
        while (next($array)) {
            if (!in_array($a, $this->berufswege2[key($array)]['matches'])) {
                $b = key($array);
                $new_array = array_diff_key($array, array($a => 0, $b => 0));
                if (count($new_array) <= 0) {
                    // Rekursionsabbruch
                    return array($a.'_'.$b);
                }
                else {
                    // Rekursion
                    $result = $this->match($new_array);
                    if (is_array($result)) {
                        $result[] = $a.'_'.$b;
                        return $result;
                    }
                }
            }
        }
        // Keine Paarungen gefunden, Schritt zurück
        return 0;
    }
}
?>
