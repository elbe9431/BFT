<?php
/**
 * Berufsfindungstest :: Prepare Hauptmenü
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
$this->nav = 'Login';
$this->userid = $data->userid;

switch ($this->substep) {
    case 1:
        // Bestätigung
        $this->template = 'text';
        $this->nav = 'Anmeldung';
        $this->text = array();
        $this->text[] = 'Vielen Dank für Ihre Anmeldung. Bitte notieren Sie sich Ihren Usernamen und Ihr Passwort.';
        $this->text[] = 'Sie können jetzt sofort mit dem Test beginnen.';
        break;
    
    case 2:
        // Auswahlbildschirm
        $this->template = 'loginmenu';
        $this->nav = 'Hauptmenü';
        $sql = 'SELECT
                    p1, p2, bez, ergebnis, bezart, preis, buchen
                FROM
                    bft_users
                WHERE
                    userid = '.$data->userid;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        if ($row = $result->fetch_assoc()) {
            $this->p1 = $row['p1'];
            $this->p2 = $row['p2'];
            $this->bez = $row['bez'];
            $this->ergebnis = $row['ergebnis'];
            $this->bezart = $row['bezart'];
            $this->preis = $row['preis'];
            $this->buchen = $row['buchen'];
        }
        break;
        
    case 3:
        // Bezahlen
        $this->template = 'loginbez';
        $this->nav = 'Bezahloptionen';
        $this->userid = $data->userid;
        $sql = 'SELECT
                    preis
                FROM
                    bft_users
                WHERE
                    userid = '.$data->userid;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        if ($row = $result->fetch_assoc()) {
            $this->preis = $row['preis'];
        }
        break;
        
    case 4:
        // Bezahlung Erfolg
        $this->template = 'text';
        $this->nav = 'Bezahlung erfolgreich';
        $this->text[] = BFT_Lang::bez_erfolg1;
        break;
        
    case 5:
        // Bezahlung Fehler
        $this->template = 'text';
        $this->nav = 'Bezahlung Abbruch';
        $this->text[] = BFT_Lang::bez_fehler1;
        break;
        
    case 6:
        // Banküberweisung
        $this->template = 'text';
        $this->nav = 'Banküberweisung';
        $this->text[] = sprintf(BFT_Lang::bez_ueberw2, BFT_Lang::Preis($data->userid));
        $this->text[] = BFT_Lang::bez_ueberw3;
        $this->text[] = BFT_Lang::bez_ueberw4;
        $this->text[] = BFT_Lang::bez_ueberw5;
        $this->text[] = BFT_Lang::bez_ueberw6;
        break;
        
    case 7:
        // Teilnahmebedingungen
        $this->template = 'copyright';
        $this->nav = 'Teilnahmebedingungen';
        break;
        
    case 8:
        // Infos zum Test
        $this->template = 'info';
        $this->nav = 'Infos zum Test';
        $this->slimbox = 1;
        if ($data->step == 1) {
            $this->imagenumber = '05';
            $this->imagetitle = 'Vergleich von Wünschen';
            $this->text[] = 'Ziel des Tools <strong>"Lösungen finden"</strong> ist es, Sie durch Aussortieren unpassender Wünsche zu einer Rangfolge Ihrer wichtigsten Wünsche zu führen. Mit klarem Ergebnis und Hinweisen für die Umsetzung zum Ausdrucken oder per Videoclip.';
            $this->text[] = 'Sie werden jeweils 2 mögliche Wünsche miteinander vergleichen. <br/><br/>Als Hilfe erhalten Sie <strong>Kommentare erfahrener Paartherapeuten</strong>, welche erläutern, welche Gedanken und Gefühle bei den Wünschen wichtig sein könnten.';
        }
        elseif ($data->step == 2) {
            $this->imagenumber = '06';
            $this->imagetitle = 'Streichen von Wünschen';
            $this->text[] = 'Sie werden also während "Lösungen finden" nicht nur gefragt, sondern erhalten auch Informationen. <br/><br/>Im Verlauf des Tools werden Sie wiederholt <strong>Wünsche aussortieren</strong>, die für Sie im Vergleich weniger Bedeutung haben als andere Wünsche. <br/><br/>So reduzieren Sie die Zahl der Wünsche immer weiter, bis nur noch Ihre <strong>wichtigsten Wünsche</strong> übrig bleiben.';
        }
        elseif ($data->step == 3) {
            $this->imagenumber = '09';
            $this->imagetitle = 'Wunschrangfolge 1 bis 3';
            $this->text[] = 'Ihre Wünsche bringen Sie im Verlauf in eine eindeutige Reihenfolge. Und lernen Besonderheiten des möglichen Paarthemas "ganz nebenbei" kennen. <br/><br/>Als Ergebnis erhalten Sie <strong>Ihre bedeutsamsten Wünsche an den Partner </strong> - in einer klaren Rangfolge mit zugehörigen Ideen von Paartherapeuten zur Umsetzung dieser Wünsche.';
        }
        elseif ($data->step == 4) {
            $this->imagenumber = '10';
            $this->imagetitle = 'Ideen zum Umsetzen der Wünsche als Videoclip';
            $this->text[] = 'Die Ideen, wie Sie die Wünsche in die Partnerschaft einbringen können, erhalten Sie zum einen in Form von 3-minütigen Videoclips.';
        }
        elseif ($data->step == 5) {
            $this->imagenumber = '11';
            $this->imagetitle = 'Ideen zum Umsetzen der Wünsche als Text';
            $this->text[] = 'Zum anderen können Sie die Ideen auch am Bildschirm als Text lesen - und den Text natürlich auch ausdrucken.';
            $this->text[] = '';
            $this->text[] = 'Sie erhalten also nicht nur eine Reihenfolge Ihrer Wünsche, sondern auch gezielte Ideen von erfahrenen Paartherapeuten zu genau diesen Wünschen.';
            $this->text[] = 'Wir hoffen, dass der Hamburger Paartherapietest mit den beiden Teilen "Wünsche klären" und "Lösungen finden" für Sie und Ihre Partnerschaft <strong>etwas positives möglich macht!</strong>';
        }
        break;
    case 10:
        foreach ($data->sorted as $sorted) {
            $sql = 'SELECT bwnameshort FROM bft_berufswege WHERE bwid = '.$sorted[0];
            $result = $db->query($sql);
            $this->text[] = $result->fetch_array()[0];
        }
        $this->nav = 'Ergebnis';
        $this->template = 'selectWishFromFavorites';
        break;
}
?>
