<?php
/**
 * paartherapietest :: German mail file
 *
 * @version 1.0
 * @package paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_Mail
{
    // From
    const from2             = "Hamburger paartherapietest <mail@paartherapietest.eu>";
    const organization      = "Hamburger paartherapietest";
    
    // Alt
    const from              = "From: Hamburger paartherapietest <mail@paartherapietest.eu>\n";
    const standard_headers  = "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\n";
    
    // Mail Footer
    const footer            = "\n\nMit besten Grüßen,\nEnno Heyken, Diplom Psychologe\n\nPsychodiagnostische Beratungspraxis\nWandsbeker Königstr. 11\n22041 Hamburg\nTel. 040 65993820\nEmail: berufsziele@aol.com\nHomepage: http://www.berufsziele.de";
    
    // Mail Copyright 1
    const copyright1        = "\n\nHamburger paartherapietest - Teilnahmebedinungen Modul 1\n\n1. Anmeldung zum Hamburger paartherapietests\n\nDurch die Anmeldung zum paartherapietest erhält der Testteilnehmer die Möglichkeit, kostenfrei und ohne weitere Verpflichtung das Modul 1 – Berufsinteressen zu durchlaufen. Das Testergebnis des Modul 1 kann er am Ende des Tests ausdrucken und frei verwenden. Weitere Verpflichtungen ergeben sich aus dieser Teilnahme nicht.\n\n2. Teilnahme am Modul 2 – Berufswahl gegen Honorar\n\nNach Beendigung des Modul 1 - Berufsinteressen erhält der Testteilnehmer die Möglichkeit, Modul 2 – Berufswahl zu buchen. Dies geschieht, indem er die Option Buchen wählt und eine der Bezahlungsvarianten (Paypal, Bankeinzug oder Onlineüberweisung ) korrekt durchführt.\n\nDurch den Abschluss einer der genannten Bezahlvorgänge wird zwischen dem Testteilnehmer und der Psychodiagnostischen Beratungspraxis (im Folgenden PDB) folgendes vereinbart: Der Testteilnehmer schuldet den für Modul 2 vereinbarten Betrag, die PDB schuldet es, dem Testteilnehmer die Möglichkeit zu geben, Modul 2 - Berufswahl innerhalb von 3 Monaten online durchführen zu können. Der Testteilnehmer erhält unverzüglich eine Bestätigungsmail zugesandt.\n\n3. Sonderbedingungen für ausgewählte Schulen und vereinbarte Berufsberatungen\n\nAn ausgewählten Schulen und im Rahmen unserer Berufsberatungen in Hamburg gilt eine von Ziffer 2 abweichende Regelung. Wir ermöglichen diesen Personen, sich für eine persönliche Berufsberatung anzumelden, oder den Test unter Sonderkonditionen durchzuführen. So angemeldete Teilnehmer können das Modul 2 des Hamburger paartherapietests mit Hilfe einer zuvor mitgeteilten Zugangsnummer durchführen. In diesem Fall wird je nach konkreter Vereinbarung für die Durchführung des Modul 2 entweder ein Rabatt gewährt, oder eine Zahlung entfällt.\n\n4. Testverlauf\n\nDer Testteilnehmer meldet sich über seine Emailadresse und ein Passwort - an Schulen eventuell auch mit einem Usernamen und einem Passwort - an. Damit startet er zunächst Modul 1 – Berufsinteressen. Nach Beendigung des Modul 1 – Berufsinteressen wird das Ergebnis für einen Zeitraum von 3 Monaten gespeichert. Auf dieser Basis kann Modul 2 entsprechend den Ziffern 2 oder 3 gebucht und durchgeführt werden.\n\n Das Ergebnis des paartherapietests erhält der Testteilnehmer dann am Ende des Testes per E-Mail zugesandt.\n\n5. Datenspeicherung\n\nDie PDB speichert die persönlichen Daten der Testteilnehmer lediglich kurzfristig – drei Monate - für die Auswertung des Tests. Nach Ablauf dieser Frist werden die Daten anonymisiert, so dass eine Zuordnung von Namen und Anschrift zu den Angaben im Test nicht möglich ist. Die Antworten werden jedoch in anonymisierter Form, zur Weiterentwicklung des Testes, gespeichert.\n\nIst ein Testteilnehmer mit der Speicherung seiner Daten, auch in anonymisierter Form, nicht einverstanden, so besteht die Möglichkeit, durch eine entsprechende Mitteilung an Psychodiagnostische Beratungspraxis, Enno Heyken, Wandsbeker Königstr. 11, 22041 Hamburg oder per Mail an berufsziele@aol.com die Löschung der Daten zu verlangen.\n\n6. Haftung\n\nDie PDB übernimmt keinerlei Gewähr für die Aktualität des Tests. Die PDB wird sich stets bemühen, den Test nach bestem Wissen und Gewissen und unter Verwendung aktueller Kenntnisse aktuell zu halten. Sie kann jedoch keine Gewähr dafür übernehmen, dass das Ergebnis des Testes tatsächlich dem individuellen Wünschen und Neigungen entspricht oder eine Gewähr dafür übernehmen, dass der Testteilnehmer für diesen Beruf besonders geeignet ist. Insofern bestehen auch keine Haftungsansprüche gegen die PDB, deren Inhaber oder deren Mitarbeiter, die sich auf Schäden materieller oder ideeller Art beziehen, welche durch die Nutzung der durch den Test erhaltenen Informationen entstanden sein könnten.\n\n";
                                
    // Mail Copyright 2
    const copyright2        = "\n\nHamburger paartherapietest - Teilnahmebedinungen Modul 2\n\n1. Anmeldung zum Hamburger paartherapietests\n\nDurch die Anmeldung zum paartherapietest erhält der Testteilnehmer die Möglichkeit, kostenfrei und ohne weitere Verpflichtung das Modul 1 – Berufsinteressen zu durchlaufen. Das Testergebnis des Modul 1 kann er am Ende des Tests ausdrucken und frei verwenden. Weitere Verpflichtungen ergeben sich aus dieser Teilnahme nicht.\n\n2. Teilnahme am Modul 2 – Berufswahl gegen Honorar\n\nNach Beendigung des Modul 1 - Berufsinteressen erhält der Testteilnehmer die Möglichkeit, Modul 2 – Berufswahl gegen eine Zahlung von %s zu buchen. Dies geschieht, indem er die Option Bezahlen wählt und eine der Bezahlungsvarianten (Paypal, Bankeinzug, oder Onlineüberweisung) korrekt durchführt.\n\nDurch den Abschluss einer der genannten Bezahlvorgänge wird zwischen dem Testteilnehmer und der Psychodiagnostischen Beratungspraxis (im Folgenden PDB) folgendes vereinbart: Der Testteilnehmer schuldet den für Modul 2 vereinbarten Betrag, die PDB schuldet es, dem Testteilnehmer die Möglichkeit zu geben, Modul 2 - Berufswahl innerhalb von 3 Monaten online durchführen zu können. Der Testteilnehmer erhält unverzüglich eine Bestätigungsmail zugesandt.\n\n3. Sonderbedingungen für ausgewählte Schulen und vereinbarte Berufsberatungen\n\nAn ausgewählten Schulen und im Rahmen unserer Berufsberatungen in Hamburg gilt eine von Ziffer 2 abweichende Regelung. Wir ermöglichen diesen Personen, sich für eine persönliche Berufsberatung anzumelden, oder den Test unter Sonderkonditionen durchzuführen. So angemeldete Teilnehmer können das Modul 2 des Hamburger paartherapietests mit Hilfe einer zuvor mitgeteilten Zugangsnummer durchführen. In diesem Fall wird je nach konkreter Vereinbarung für die Durchführung des Modul 2 entweder ein Rabatt gewährt, oder eine Zahlung entfällt.\n\n4. Testverlauf\n\nDer Testteilnehmer wählt für sich einen Usernamen und ein Passwort. Damit startet er zunächst Modul 1 – Berufsinteressen. Nach Beendigung des Modul 1 – Berufsinteressen wird das Ergebnis für einen Zeitraum von 3 Monaten gespeichert. Auf dieser Basis kann Modul 2 entsprechend den Ziffern 2 oder 3 gebucht und durchgeführt werden.\n\nDas Ergebnis des paartherapietests erhält der Testteilnehmer dann am Ende des Testes per E-Mail zugesandt.\n\n5. Gesetzliches Widerrufsrecht\n\na. Der Testteilnehmer hat das Recht, diesen Vertrag innerhalb eines Monats zu widerrufen. Die erwähnte Monatsfrist beginnt mit der Zusendung der Bestätigungsmail, welche beim in Ziffer 2 genannten Zahlvorgang an den Testteilnehmer versandt wird.\n\nb. Der Widerruf ist schriftlich, wobei eine Übersendung per E-Mail an die Adresse berufsziele@aol.com ausreichend ist, zu richten an Psychodiagnostische Beratungspraxis, Enno Heyken, Wandsbeker Königstr. 11, 22041 Hamburg.\n\nc. Zur Wahrung der Frist genügt es, den Widerspruch rechtzeitig abzusenden. Ausreichend ist, wie bereits erwähnt, auch die rechtzeitige Absendung der E-Mail an die Adresse berufsziele@aol.com.\n\nd. Das Widerrufsrecht erlischt mit Durchführung des Modul 2 - Berufswahl durch den Testteilnehmer.\n\n6. Datenspeicherung\n\nDie PDB speichert die persönlichen Daten der Testteilnehmer lediglich kurzfristig – drei Monate - für die Auswertung des Tests. Nach Ablauf dieser Frist werden die Daten anonymisiert, so dass eine Zuordnung von Namen und Anschrift zu den Angaben im Test nicht möglich ist. Die Antworten werden jedoch in anonymisierter Form, zur Weiterentwicklung des Testes, gespeichert.\n\nIst ein Testteilnehmer mit der Speicherung seiner Daten, auch in anonymisierter Form, nicht einverstanden, so besteht die Möglichkeit, durch eine entsprechende Mitteilung an Psychodiagnostische Beratungspraxis, Enno Heyken, Wandsbeker Königstr. 11, 22041 Hamburg oder per Mail an berufsziele@aol.com die Löschung der Daten zu verlangen.\n\n7. Haftung\n\nDie PDB übernimmt keinerlei Gewähr für die Aktualität des Tests. Die PDB wird sich stets bemühen, den Test nach bestem Wissen und Gewissen und unter Verwendung aktueller Kenntnisse aktuell zu halten. Sie kann jedoch keine Gewähr dafür übernehmen, dass das Ergebnis des Testes tatsächlich dem individuellen Wünschen und Neigungen entspricht oder eine Gewähr dafür übernehmen, dass der Testteilnehmer für diesen Beruf besonders geeignet ist. Insofern bestehen auch keine Haftungsansprüche gegen die PDB, deren Inhaber oder deren Mitarbeiter, die sich auf Schäden materieller oder ideeller Art beziehen, welche durch die Nutzung der durch den Test erhaltenen Informationen entstanden sein könnten.\n\n";
    
    // Mail Copyright Test 2 Selbstzahler
    const copyright3        = "\n\nHamburger paartherapietest - Teilnahmebedinungen für den Test Lösungen finden gegen Honorar von %s\n\n1. Zweck des Tests\n\nDer Hamburger paartherapietest Berufswahl verfolgt das Ziel, dass der Testteilnehmer aus einer Vielzahl vorgegebener Berufe diejenigen Ausbildungsgänge und Studiengänge herausfiltert und in eine Reihenfolge sortiert, für die er sich aktuell entscheiden könnte.\n\n2. Testgebühr für die Testteilnahme\n\nDer Test Berufswahl kann vom Teilnehmer gegen Zahlung einer einmaligen Testgebühr von %s genutzt werden. Dies geschieht, indem der Teilnehmer eine der Bezahlungsvarianten (Paypal, Bankeinzug oder Onlineüberweisung) korrekt durchführt. Es entstehen dem Teilnehmer keine weiteren Kosten oder Pflichten.\n\n3. Testvoraussetzungen\n\nUm den Hamburger paartherapietest Berufswahl nutzen zu können ist es erforderlich, zunächst den kostenfreien Test Berufsinteressen zu durchlaufen. Berufswahl baut auf die Testergebnisse von Berufsinteressen auf.\n\n4. Sonderbedingungen für ausgewählte Gruppen und Schulen\n\nAn ausgewählten Schulen und im Rahmen unserer Berufsberatungen in Hamburg gilt eine abweichende Regelung für die Testgebühr. Wir ermöglichen diesen Personen, sich für eine persönliche Berufsberatung anzumelden, oder den Test unter Sonderkonditionen durchzuführen. So angemeldete Teilnehmer können den Test Berufswahl mit Hilfe einer zuvor mitgeteilten Zugangsnummer durchführen. In diesem Fall wird je nach konkreter Vereinbarung für die Durchführung des Tests Berufswahl entweder ein Rabatt gewährt, oder eine Zahlung entfällt.\n\n5. Testverlauf\n\nAm Ende des Tests „Berufsinteressen“ kann der Teilnehmer seine Emailadresse angeben. Die Emailadresse wird zum Zusenden der Testergebnisse von Berufsinteressen genutzt sowie zum Zusenden eines Zugangscodes für den Test Berufswahl.\n\nMit diesem Zugangscode kann sich der Teilnehmer unmittelbar oder innerhalb von 3 Monaten für den Test Berufswahl anmelden. Hierzu muss er die Testgebühr von %s bezahlen.\n\nDie Testergebnisse werden im Folgenden unter der zugewiesenen Zugangsnummer in Verbindung mit der angegebenen Emailadresse gespeichert. Der Teilnehmer durchläuft nun den Test und erhält am Ende des Tests die Ergebnisse per Email zugesandt. Zusätzlich hat er die Möglichkeit, das Testergebnis am Bildschirm direkt zu sehen.\n\nDie Emailadresse des Teilnehmers wird nicht an Dritte weitergegeben. Sie wird lediglich für die Durchführung des Hamburger paartherapietests genutzt.\n\n6. Gesetzliches Widerrufsrecht\n\na. Der Testteilnehmer hat das Recht, diesen Vertrag innerhalb eines Monats zu widerrufen. Die erwähnte Monatsfrist beginnt mit der Zusendung der Bestätigungsmail, welche beim in Ziffer 3 genannten Zahlvorgang an den Testteilnehmer versandt wird.\n\nb. Der Widerruf ist schriftlich, wobei eine Übersendung per E-Mail an die Adresse berufsziele@aol.com ausreichend ist, zu richten an Psychodiagnostische Beratungspraxis, Enno Heyken, Wandsbeker Königstr. 11, 22041 Hamburg.\n\nc. Zur Wahrung der Frist genügt es, den Widerspruch rechtzeitig abzusenden. Ausreichend ist, wie bereits erwähnt, auch die rechtzeitige Absendung der E-Mail an die Adresse berufsziele@aol.com\n\nd. Das Widerrufsrecht erlischt mit Durchführung des Modul 2 - Berufswahl durch den Testteilnehmer.\n\n7. Datenspeicherung\n\nDie PDB speichert die persönlichen Daten des Testteilnehmers lediglich kurzfristig – drei Monate - für die Auswertung des Tests. Nach Ablauf dieser Frist werden die Daten anonymisiert, so dass eine Zuordnung von Namen und Anschrift zu den Angaben im Test nicht möglich ist. Die Antworten werden jedoch in anonymisierter Form, zur Weiterentwicklung des Testes, gespeichert.\n\nIst ein Testteilnehmer mit der Speicherung seiner Daten, auch in anonymisierter Form, nicht einverstanden, so besteht die Möglichkeit, durch eine entsprechende Mitteilung an Psychodiagnostische Beratungspraxis, Enno Heyken, Wandsbeker Königstr. 11, 22041 Hamburg oder per Mail an berufsziele@aol.com die Löschung der Daten zu verlangen.\n\n8. Haftung\n\nDie PDB übernimmt keinerlei Gewähr für die Aktualität des Tests. Die PDB wird sich stets bemühen, den Test nach bestem Wissen und Gewissen und unter Verwendung aktueller Kenntnisse aktuell zu halten. Sie kann jedoch keine Gewähr dafür übernehmen, dass das Ergebnis des Testes tatsächlich dem individuellen Wünschen und Neigungen entspricht oder eine Gewähr dafür übernehmen, dass der Testteilnehmer für diesen Beruf besonders geeignet ist. Insofern bestehen auch keine Haftungsansprüche gegen die PDB, deren Inhaber oder deren Mitarbeiter, die sich auf Schäden materieller oder ideeller Art beziehen, welche durch die Nutzung der durch den Test erhaltenen Informationen entstanden sein könnten.\n\n";
    
    // Passwort vergessen
    const pwd_subject       = "Neues Passwort";
    const pwd_msg           = "Sie haben ein neues Passwort für Ihren Zugang zum Hamburger paartherapietest angefordert.\n\nIhr neues Passwort lautet: %s\n\nSie können sich jetzt mit Ihrer E-Mail-Adresse und dem neuen Passwort unter http://www.paartherapietest.eu einloggen.";

    // Aktivierung
    const aktiv_subject     = "Aktivierung Ihres Accounts";
    const aktiv_msg         = "Herzlich Willkommen!\n\nSie haben sich für den Hamburger paartherapietest angemeldet. Um die Richtigkeit Ihrer E-Mail-Adresse zu bestätigen bitten wir Sie, den nachfolgenden Link zu nutzen:\n\nhttp://www.paartherapietest.eu/reg/%s\n\nFalls sich die Seite nicht automatisch öffnet, kopieren Sie bitte den Link in Ihr Browserfenster und drücken Sie dann die Eingabetaste. Sie gelangen dann direkt zum Test und können ihn anschließend starten.\n\nFalls Sie sich nicht für den Hamburger paartherapietest angemeldet und diese E-Mail zu Unrecht erhalten haben, brauchen Sie nichts weiter zu unternehmen. Es entstehen hierdurch keinerlei Verpflichtungen für Sie.\n\nNachfolgend senden wir Ihnen noch die aktuellen Teilnahmebedingungen des Tests.";
    
    // Banküberweisung
    const bank_subject      = "Informationen zur Banküberweisung";
    const bank_msg          = "Um Tool Lösungen finden der Hamburger paartherapietests nutzen zu können haben Sie die Bezahloption Banküberweisung gewählt.\n\nBitte überweisen Sie einmalig den Betrag von %s Euro unter Angabe Ihrer E-Mail-Adresse und Ihres Nachnamens auf folgendes Konto:\n\nKontoinhaber: Enno Heyken\nKreditinstitut: Netbank\nBankleitzahl: 20090500\nKontonummer: 7380194\n\nWir senden Ihnen dann eine Mail, sobald wir den Zahlungseingang verbucht haben.\n\nNachfolgend senden wir Ihnen noch die aktuellen Teilnahmebedingungen des Tests.";
    
    // Ergebnis
    const ergebnis_subject  = "Ergebnis Tool Lösungen finden";
    const ergebnis_msg      = "Sie haben das Tool Lösungen finden abgeschlossen und damit den Hamburger Paartherapietests unter http://www.paartherapietest.eu komplett durchlaufen. Im Anhang erhalten Sie das Ergebnis mit weiterführenden Informationen.";
    
    // Ergebnis
    const ergebnis1_subject = "Ergebnis Test Wünsche klären und Kennwort Tool Lösungen finden";
    const ergebnis1_msg     = "Sie haben gerade den Hamburger paartherapietest 1, “Berufsinteressen” erfolgreich beendet.\n\nIm Anhang erhalten Sie das Testergebnis – mit Erläuterungen – als PDF. Wie kann es nun mit Ihrer Berufswahl weitergehen?\n\nZum einen raten wir, nun auch den Hamburger paartherapietest 2, „Berufswahl“ zu nutzen. Er ermöglicht Ihnen, sich intensiv mit den Berufen auseinander zu setzen, die Sie wirklich interessieren - und Ihre Ideen in eine persönliche Reihenfolge zu bringen. Der Test kostet %s.\n\nUnd so starten Sie den Test „Berufswahl“:\n\n- Auf http://www.paartherapietest.eu gehen.\n- „Start Berufswahl“ klicken.\n- Ihren persönlichen Zugangscode eingeben: %s\n- Die Testgebühr von 15,00 € zahlen - per Einzugsermächtigung oder über Paypal.\n\nViel Spaß bei diesem Test – er baut auf „Berufsinteressen“ auf und bietet Ihnen ein konkretes, gut strukturiertes Ergebnis.\n\nSie wollen mehr Unterstützung als ein Berufstest Ihnen bieten kann?\n\nDann ist eine Berufsberatung die beste Idee. Kommen Sie für einen ganzen Tag in unsere Praxis – einen Tag, bei dem es nur um Sie und Ihre berufliche Zukunft geht. Nähere Infos erhalten Sie unter http://www.berufsziele.de\n\nOder rufen Sie uns doch einfach an, um genaueres zu besprechen: 040 65993820.\n\nEgal, wie Ihre nächsten Schritte nun aussehen: Wir wünschen Ihnen viel Glück bei Ihrer Berufswahl!";
    
    // Freischaltung nach Bezahlung
    const bezahlung_subject = "Freischaltung von Test 2 Berufswahl";
    const bezahlung_msg     = "Herzlichen Dank, Sie haben erfolgreich den Test 2 - Berufswahl der Hamburger paartherapietests freigeschaltet.\n\nDen Betrag in Höhe von %s %s.\n\nUnd so starten Sie den Test „Berufswahl“:\n\n- Auf http://www.paartherapietest.eu gehen.\n- „Start Berufswahl“ klicken.\n- Ihren persönlichen Zugangscode eingeben: %s\n\nNachfolgend senden wir Ihnen noch die aktuellen Teilnahmebedingungen des Tests.";
    const bankueberw_msg    = "Herzlichen Dank, wir haben Ihre Überweisung in Höhe von %s erhalten. Den Test 2 - Berufswahl der Hamburger paartherapietests haben wir bereits für Sie freigeschaltet.\n\nUnd so starten Sie den Test „Berufswahl“:\n\n- Auf http://www.paartherapietest.eu gehen.\n- „Start Berufswahl“ klicken.\n- Ihren persönlichen Zugangscode eingeben: %s\n\nNachfolgend senden wir Ihnen noch die aktuellen Teilnahmebedingungen des Tests.";
    const buchen_msg        = "Herzlichen Dank, Sie haben sich zu einer Veranstaltung zur Berufsberatung auf http://www.berufsziele.de angemeldet.\n\nSie können jetzt auch den Test 2 - Berufswahl der Hamburger paartherapietests nutzen. Wir haben diesen bereits für Sie freigeschaltet.\n\nUnd so starten Sie den Test „Berufswahl“:\n\n- Auf http://www.paartherapietest.eu gehen.\n- „Start Berufswahl“ klicken.\n- Ihren persönlichen Zugangscode eingeben: %s";
    
    // General Constructor setting headers
    function __construct($attachments = 0, $file_name = "", $file_content = "")
    {
        $this->attachments = $attachments;
        if ($attachments) {
            $boundary = strtoupper(md5(uniqid(time())));
            $this->headers = "Return-Path: " . self::from2 . "\n";
            $this->headers .= "Reply-to: " . self::from2 . "\n";
            $this->headers .= "From: " . self::from2 . "\n";
            $this->headers .= "Organization: " . self::organization . "\n";
            $this->headers .= "MIME-Version: 1.0\n";
            $this->headers .= "X-Priority: 3\n";
            $this->headers .= "X-Mailer: PHP ". phpversion() ."\n";
            $this->headers .= "Content-Type: multipart/mixed; boundary=$boundary\n\n";
            $this->headers .= "This is a multi-part message in MIME format -- Dies ist eine mehrteilige Nachricht im MIME-Format\n";
            $this->headers .= "--$boundary\n";
            $this->headers .= "Content-Type: text/plain; charset=utf-8\n";
            $this->headers .= "Content-Transfer-Encoding: quoted-printable\n\n";
            $this->headers .= "%s\n";
            $this->headers .= "--$boundary\n";
            $this->headers .= "Content-Type: application/octetstream; name=\"$file_name\"\n";
            $this->headers .= "Content-Transfer-Encoding: base64\n";
            $this->headers .= "Content-Disposition: attachment; filename=\"$file_name\"\n\n";
            $this->headers .= "$file_content\n";
            $this->headers .= "--$boundary--";
        }
        else {
            $this->headers = "Return-Path: " . self::from2 . "\n";
            $this->headers .= "Reply-to: " . self::from2 . "\n";
            $this->headers .= "From: " . self::from2 . "\n";
            $this->headers .= "Organization: " . self::organization . "\n";
            $this->headers .= "MIME-Version: 1.0\n";
            $this->headers .= "Content-Type: text/plain; charset=utf-8\n";
            $this->headers .= "Content-Transfer-Encoding: quoted-printable\n";
            $this->headers .= "X-Priority: 3\n";
            $this->headers .= "X-Mailer: PHP ". phpversion() ."\n";
        }
    }

    // Send method
    private function Send($userid)
    {
        global $db;
        $sql = 'SELECT
                    email
                FROM
                    bft_users
                WHERE
                    userid = '.$userid;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        $row = $result->fetch_assoc();
 
$result->close();
     
$mail_isSent = mail($row['email'], $this->subject,$this->headers, "From: Hamburger paartherapietest <mail@paartherapietest.eu>\n" );
error_log("[DEBUG]TO: " .$row['email'] . "\n  SUBJECT: ". $this->subject . "\n  MSG: ". wordwrap($this->msg). "\n  HEADERS: " .$this->headers . "\n SENT SUCCESSFUL: ". $mail_isSent);   
    }

    // Senden von Bestätigung bei Paypal
    public function SendPaypalBestaetigung($userid)
    {
        $this->subject = BFT_Mail::bezahlung_subject;
        $this->msg = sprintf(BFT_Mail::bezahlung_msg, BFT_Lang::Preis($userid), "haben Sie per Paypal bezahlt", $this->GetUsername($userid));
        $this->msg .= self::footer;
        $this->msg .= sprintf(self::copyright3, BFT_Lang::Preis($userid), BFT_Lang::Preis($userid), BFT_Lang::Preis($userid));
        $this->Send($userid);
    }

    // Senden von Bestätigung bei Micropayment
    public function SendMicropaymentBestaetigung($userid, $bezart)
    {
        $this->subject = self::bezahlung_subject;
        $this->msg = sprintf(BFT_Mail::bezahlung_msg, BFT_Lang::Preis($userid), ($bezart == 2 ? "werden wir von Ihrem Konto abbuchen" : "haben Sie per Onlineüberweisung bezahlt"), $this->GetUsername($userid));
        $this->msg .= self::footer;
        $this->msg .= sprintf(self::copyright3, BFT_Lang::Preis($userid), BFT_Lang::Preis($userid), BFT_Lang::Preis($userid));
        $this->Send($userid);
    }

    // Senden von Bestätigung bei Banküberweisung
    public function SendBankueberweisungBestaetigung($userid)
    {
        $this->subject = self::bezahlung_subject;
        $this->msg = sprintf(self::bankueberw_msg, BFT_Lang::Preis($userid), $this->GetUsername($userid));
        $this->msg .= self::footer;
        $this->msg .= sprintf(self::copyright3, BFT_Lang::Preis($userid), BFT_Lang::Preis($userid), BFT_Lang::Preis($userid));
        $this->Send($userid);
    }

    // Senden von Bestätigung bei Buchung von Gruppenberatung
    public function SendBuchungBestaetigung($userid)
    {
        $this->subject = self::bezahlung_subject;
        $this->msg = sprintf(self::buchen_msg, $this->GetUsername($userid));
        $this->msg .= self::footer;
        $this->Send($userid);
    }
	
	 // Senden von Bestätigung bei Buchung von Gruppenberatung
    public function SendBuchungBestaetigungCheck($userid)
    {
        $this->subject = self::bezahlung_subject;
        $this->msg = sprintf(self::buchen_msg, $this->GetUsername($userid));
        $this->msg .= self::footer;
        //$this->Send($userid);
		echo $this->msg. $this->headers;
    }
	
    // Senden der Daten zur Banküberweisung
    public function SendBankueberweisungDaten($userid)
    {
        $this->subject = self::bank_subject;
        $this->msg = sprintf(self::bank_msg, BFT_Lang::Preis($userid));
        $this->msg .= self::footer;
        $this->msg .= sprintf(self::copyright3, BFT_Lang::Preis($userid), BFT_Lang::Preis($userid), BFT_Lang::Preis($userid));
        $this->Send($userid);
    }

    // Senden einer Nachricht wegen Banküberweisung an berufsziele@aol.com
    public function SendBankueberweisungNachricht($userid)
    {
        global $db;
        $sql = 'SELECT
                    username, email, vorname, nachname
                FROM
                    bft_users
                WHERE
                    userid = '.$userid;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        $row = $result->fetch_assoc();
        $result->close();
        $this->to = "berufsziele@aol.com";
        $this->subject = "Hamburger paartherapietest - Benutzer hat Banküberweisung gewählt";
        $this->msg = "Username: " . $row['username'] . "\n";
        $this->msg .= "Email: " . $row['email'] . "\n";
        $this->msg .= "Vorname: " . $row['vorname'] . "\n";
        $this->msg .= "Nachname: " . $row['nachname'] . "\n";
        $this->msg .= "Preis: " . BFT_Lang::Preis($userid);
        mail($this->to, $this->subject, wordwrap($this->msg), $this->headers);
    }

    // Ergebnisse zumailen
    public function SendErgebnisTest1($userid)
    {
        $this->subject = self::ergebnis1_subject;
        $this->msg = sprintf(self::ergebnis1_msg, BFT_Lang::Preis($userid), $this->GetUsername($userid));
        $this->msg .= self::footer;
       /*Alte Version 091015:*/
        $this->headers = sprintf($this->headers, wordwrap($this->msg));
        $this->msg = "";
		
		//neue Version
		//$this->headers = $this->headers;
        //$this->msg = wordwrap($this->msg);
		//Ende neue Version
        $this->Send($userid);
    }
    
    // Ergebnisse zumailen
    public function SendErgebnis($userid)
    {
        $this->subject = self::ergebnis_subject;
        $this->msg = self::ergebnis_msg;
        $this->msg .= self::footer;
		/*Alte Version 091015:*/
        $this->headers = sprintf($this->headers, wordwrap($this->msg));
        $this->msg = "";
		
		//neue Version
		//$this->headers = $this->headers;
        //$this->msg = wordwrap($this->msg);
		//Ende neue Version
        $this->Send($userid);
    }
    
    // Aktivierungslink zusenden
    public function SendAktivierung($userid, $action)
    {
        $this->subject = self::aktiv_subject;
        $this->msg = sprintf(self::aktiv_msg, $action);
        $this->msg .= self::footer;
        $this->msg .= self::copyright1;
        $this->Send($userid);
    }
    
    // Neues Passwort zusenden
    public function SendPassword($userid, $password)
    {
        $this->subject = self::pwd_subject;
        $this->msg = sprintf(self::pwd_msg, $password);
        $this->msg .= self::footer;
        $this->Send($userid);
    }
    
    function GetUsername($userid)
    {
        global $db;
        $sql = 'SELECT
                    username
                FROM
                    bft_users
                WHERE
                    userid = '.$userid;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        $row = $result->fetch_assoc();
        $result->close();
        return $row['username'];
    }
}
?>