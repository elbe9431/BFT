<?php
/**
 * paartherapietest :: Data processing for phase 1
 *
 * @version 1.0
 * @package paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

// Sort ToDo list
asort($this->todo);

/**
 * substep is the page we are coming from:
 *
 *      0 - Einleitung
 *      1 - Einstimmungsfrage
 *      2 - Eigentliche Frage
 *      3 - Nachfrage
 *      4 - Einen retten
 *  11,12 - Von vorne
 *     21 - Tabelle
 *     22 - Einen retten nach Tabelle
 *     30 - Endseite
 */
switch ($this->substep) {
    case 0:
        // Einleitung
        if (isset($_POST[BFT_NEXT])) {
            $this->step++;
            if ($this->step > 3) {
                $this->substep = 1;
                $this->step = 1;
                $this->save = 1;
            }
        }
        break;
        
    case 1:
        // Einstimmungsfrage
        if (isset($_POST[BFT_NEXT])) {
            $this->substep = 2;
        }
        break;
        
    case 2:
        // Eigentliche Frage
        
    case 3:
        // Nachfrage
        if (isset($_POST[BFT_STIMMT])) {
            $this->streicher[$this->berufsfeld] = $this->berufsfeld;
            unset($this->relevante[$this->berufsfeld]);
            unset($this->gerettete[$this->berufsfeld]);
            unset($this->todo[$this->berufsfeld]);
            $this->berufsfeld = count($this->todo) ? reset($this->todo) : $this->berufsfeld;
            $this->step++;
            $this->substep = $this->modus;
            $this->save = 1;
        }
        elseif (isset($_POST[BFT_WEISSNICHT])) {
            $this->substep++;
        }
        elseif (isset($_POST[BFT_STIMMTNICHT])) {
            $this->relevante[$this->berufsfeld] = $this->berufsfeld;
            unset($this->streicher[$this->berufsfeld]);
            unset($this->gerettete[$this->berufsfeld]);
            unset($this->todo[$this->berufsfeld]);
            $this->berufsfeld = count($this->todo) ? reset($this->todo) : $this->berufsfeld;
            $this->step++;
            $this->substep = $this->modus;
            $this->save = 1;
        }
        break;
        
    case 4:
        // Einen retten
        for ($i = 0; $i < BFT_Config::max_berufswege; $i++) {
            if (isset($_POST[BFT_RETTEN.$i])) {
                $this->gerettete[$this->berufsfeld] = ($this->berufsfeld - 1) * 10 + $i + 1;
                unset($this->streicher[$this->berufsfeld]);
                unset($this->relevante[$this->berufsfeld]);
                unset($this->todo[$this->berufsfeld]);
                $this->berufsfeld = count($this->todo) ? reset($this->todo) : $this->berufsfeld;
                $this->step++;
                $this->substep = $this->modus;
                $this->save = 1;
                break;
            }
        }
        break;

    case 11:
    case 12:
        // Von vorne
        if (isset($_POST[BFT_NEXT])) {
            $this->substep = $this->modus;
        }
        break;

    case 21:
        // Table
        $this->auswahl = array();
        if (isset($_POST[BFT_NEXT])) {
            if (isset($_POST[BFT_BERUFSFELDER])) {
                $this->auswahl = $_POST[BFT_BERUFSFELDER];
            }
            $count = count($this->auswahl);
            if ($count < $this->min or $count > $this->max) {
                // Falsche Auswahl
                $this->modus += $this->modus < 4 ? 3 : 0;
            }
            elseif ($this->modus == 1 or $this->modus == 4) {
                // Vollstreicher
                $this->step = $this->maxsteps + 1;
                foreach ($this->todo as $val) {
                    if (!in_array($val, $this->auswahl)) {
                        $this->relevante[$val] = $val;
                        unset($this->gerettete[$val]);
                        unset($this->streicher[$val]);
                    }
                }
                $this->save = 1;
            }
            elseif ($this->modus == 2 or $this->modus == 5) {
                // Gerettete
                $this->step = $this->maxsteps + 1;
                foreach ($this->todo as $val) {
                    if (!in_array($val, $this->auswahl)) {
                        $this->relevante[$val] = $val;
                        unset($this->gerettete[$val]);
                        unset($this->streicher[$val]);
                    }
                }   
                $this->save = 1;
            }
            else {
                // Relevante
                $this->substep = 22;
                $this->todo = array();
                foreach ($this->auswahl as $val) {
                    $this->todo[$val] = $val;
                }
                asort($this->todo);
                $this->berufsfeld = reset($this->todo);
                $this->step = 1;
                $this->maxsteps = count($this->todo);
                $this->save = 1;
            }
        }
        break;
        
    case 22:
        // Nachfrage einen zu retten
        if (isset($_POST[BFT_STIMMT])) {
            $this->streicher[$this->berufsfeld] = $this->berufsfeld;
            unset($this->relevante[$this->berufsfeld]);
            unset($this->gerettete[$this->berufsfeld]);
            unset($this->todo[$this->berufsfeld]);
            $this->berufsfeld = count($this->todo) ? reset($this->todo) : $this->berufsfeld;
            $this->step++;
            $this->save = 1;
        }
        else {
            for ($i = 0; $i < BFT_Config::max_berufswege; $i++) {
                if (isset($_POST[BFT_RETTEN.$i])) {
                    $this->gerettete[$this->berufsfeld] = ($this->berufsfeld - 1) * 10 + $i + 1;
                    unset($this->streicher[$this->berufsfeld]);
                    unset($this->relevante[$this->berufsfeld]);
                    unset($this->todo[$this->berufsfeld]);
                    $this->berufsfeld = count($this->todo) ? reset($this->todo) : $this->berufsfeld;
                    $this->step++;
                    $this->save = 1;
                    break;
                }
            }
        }
        break;
    
    case 30:
        // Endseite Phase 1
        if (isset($_POST[BFT_NEXT])) {
            $this->section = 'phase2';
            $this->step = 0;
            $this->substep = 0;
            $this->save = 1;
        }
        break;
}

if ($this->step > $this->maxsteps) {
    // End of phase 1, calculate result
    $this->step = 1;
    $this->anz_relevante = isset($this->relevante) ? count($this->relevante) : 0;
    $this->anz_streicher = isset($this->streicher) ? count($this->streicher) : 0;
    $this->anz_gerettete = isset($this->gerettete) ? count($this->gerettete) : 0;
    if (!isset($this->anz_relevante1)) $this->anz_relevante1 = $this->anz_relevante;
    if (!isset($this->anz_streicher1)) $this->anz_streicher1 = $this->anz_streicher;
    if (!isset($this->anz_gerettete1)) $this->anz_gerettete1 = $this->anz_gerettete;
    if ($this->anz_relevante > BFT_Config::max_relevante + 2) {
        // Von vorne mit Relevanten
        $this->todo = $this->relevante;
        asort($this->todo);
        $this->berufsfeld = reset($this->todo);
        $this->maxsteps = count($this->todo);
        $this->modus = 3;
        $this->substep = 11;
    }
    elseif ($this->anz_relevante < BFT_Config::min_relevante) {
        // Von vorne mit allen Streichern
        $this->todo = $this->streicher;
        foreach (array_keys($this->gerettete) as $val) {
            $this->todo[$val] = $val;
        }
        asort($this->todo);
        $this->berufsfeld = reset($this->todo);
        $this->maxsteps = count($this->todo);
        $this->modus = 3;
        $this->substep = 12;
    }
    elseif ($this->anz_relevante >= BFT_Config::min_relevante and $this->anz_relevante <= BFT_Config::max_relevante) {
        // Endseite Phase 1 anzeigen
        $this->substep = 30;
        $this->step = 1;
    }
    elseif ($this->anz_relevante > BFT_Config::max_relevante and $this->anz_relevante <= BFT_Config::max_relevante + 2) {
        // Tabelle mit allen Relevanten
        $this->todo = $this->relevante;
        asort($this->todo);
        $this->min = $this->max = min(count($this->todo), $this->anz_relevante - BFT_Config::max_relevante);
        $this->auswahl = array();
        $this->modus = 3;
        $this->substep = 21;
    }
    else {
        die(sprintf(BFT_Lang::error, 20, 'Ein nicht abgedeckter Fall'));
    }
    $this->save = 1;
}

?>
