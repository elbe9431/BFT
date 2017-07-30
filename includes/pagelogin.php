<?php
/**
 * Berufsfindungstest :: Prepare Login output
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
$this->modus = $data->modus;
$this->nav = 'Login';
$this->error = isset($data->error) ? $data->error : 0;

switch ($data->substep) {
    case 0:
        // Copyright
        $this->template = 'text3';
        $this->nav = 'Anmeldung';
        if ($this->modus == 2) {
            // Belehrung komplette Daten
            $this->text[] = 'Herzlich willkommen zum Hamburger Paartherapie-Test! Sie durchlaufen nun direkt nacheinander den Test <strong>Wünsche klären</strong> und das Tool <strong>Lösungen finden</strong>';
        } else {
            // Belehrung nur Email
			if(BFT_Config::test_mode_kostenlos==0){
            	$this->text[] = '<strong>Herzlich willkommen zum Hamburger Paartherapie-Test!</strong><br><br>
			Sie durchlaufen nun kostenlos den ca. 15-minütigen Selbsttest <br><strong>"Wünsche klären"</strong>.<br><br>Sie müssen im Rahmen des Hamburger Paartherapietests <strong>weder jetzt noch später persönliche Daten</strong> eingeben. 

			Die anonymen Testdaten werden ausschließlich zur Weiterentwicklung erfasst und genutzt.<br><br>

			Wenn Sie mit diesen Teilnahmebedingungen einverstanden sind, dann klicken Sie bitte auf <strong>"Weiter"</strong>.';
			}else{			
            $this->text[] = 'Wir bitten Sie im Folgenden Ihre <strong>Emailadresse</strong> einzutragen. Dies geschieht, damit wir Ihre Testdaten korrekt zuordnen, auswerten und auf Wunsch zumailen können. <br/><br/>Wir koppeln Ihre Testdaten nach 3 Monaten von Ihrer Emailadresse ab, um die anonymisierten Daten zur wissenschaftlichen Weiterentwicklung des Tests verwenden zu können. <br/><br/>Ihre Emailadresse werden wir nicht weitergeben und auch nicht für Werbemails verwenden.';
            $this->text[] = 'Wenn Sie mit diesen Teilnahmebedingungen einverstanden sind, dann klicken Sie bitte auf <strong>Weiter</strong>.';
			}
        }
        break;
       
    case 1:
        // Auswahl
        if ($this->modus == 1) {
            $this->template = 'logingruppenid';
            $this->nav = 'Anmeldung';
            $this->anmeldung = array();
            if (isset($data->anmeldung)) $this->anmeldung = $data->anmeldung;
        }
        else {
            $this->template = 'text';
            $this->nav = 'Einleitung';
            $this->text[] = 'Sie durchlaufen nun den Test <strong>Berufsinteressen</strong>, ohne dass Sie persönliche Daten eingeben müssen. Erst am Testende werden wir Sie darum bitten, Ihre Emailadresse einzugeben - wir speichern dann Ihr Testergebnis unter dieser Emailadresse und mailen es Ihnen zu. Auf diese Weise können Sie den Test <strong>Berufswahl</strong> zusätzlich nutzen - er baut auf die Ergebnisse von <strong>Berufsinteressen</strong> auf.';
        }

/*        $this->template = 'loginauswahl';
        $this->login = array();
        if (isset($data->login)) $this->login = $data->login;
*/        break;

    case 2:
        // Gruppenwahl
        $this->template = 'logingruppenwahl';
        $this->nav = 'Anmeldung';
        break;

    case 3:
        // Gruppen-Id oder Key
        $this->template = 'logingruppenid';
        $this->nav = 'Anmeldung';
        $this->anmeldung = array();
        if (isset($data->anmeldung)) $this->anmeldung = $data->anmeldung;
        break;
        
    case 4:
        // Anmelden
        $this->template = 'loginanmelden';
        $this->nav = 'Anmeldung';
        $this->anmeldung = array();
        if (isset($data->anmeldung)) $this->anmeldung = $data->anmeldung;
        break;

    case 5:
        // Bestätigung
        $sql = 'SELECT
                    username
                FROM
                    bft_users
                WHERE
                    userid = '.$this->userid;
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        $row = $result->fetch_assoc();

        $this->nav = 'Anmeldung';
        $this->text = array();
        $this->template = 'text';
        $this->text[] = '';
        if ($user->data['kennwort'] == 1) {
            $this->text[] = 'Mit dem nachfolgenden Kennwort könnten Sie den Test für eine <strong>Pause</strong> unterbrechen, den Computer ausstellen und den Test später fortsetzen.';
            $this->text[] = 'Ihr persönliches Kennwort lautet: <strong>'.$row['username'].'</strong>';
        }
        $this->text[] = 'Sie können den Test auch ohne Kennwort komplett durchführen. <br>Klicken Sie bitte auf <strong>Weiter</strong>.';
        break;
    
    case 6:
        // Email Aktivierung
        $this->template = 'text';
        $this->nav = 'Anmeldung';
        $this->text = array();
        $this->text[] = 'Herzlichen Glückwunsch! Sie haben Ihre E-Mail-Adresse erfolgreich aktiviert.';
        $this->text[] = 'Sie können jetzt sofort mit dem Test beginnen.';
        $this->text[] = 'Mit Ihrer E-Mail-Adresse und Ihrem gewählten Passwort können Sie sich auch zu einem späteren Zeitpunkt wieder einloggen, um z.B. den Test fortzusetzen oder sich Ihre Ergebnisse erneut anzusehen.';
        break;
  
    case 10:
        // Auswahlbildschirm
        $this->template = 'loginkennwort';
        $this->nav = 'Kennwort eingeben';
        $this->anmeldung = array();
        if (isset($data->anmeldung)) $this->anmeldung = $data->anmeldung;
        break;

    case 11:
        // Test erfolgreich geladen
        $this->nav = 'Test geladen';
        $this->template = 'text';
        $this->text[] = 'Der Test wurde erfolgreich geladen. Sie können diesen jetzt fortsetzen.';
        break;
        
    case 20:
        // Passwort vergessen
        $this->template = 'loginpwd';
        $this->nav = 'Passwort vergessen';
        if (isset($data->longerror)) {
            $this->longerror = $data->longerror;
        }
        break;
     
    case 21:
        // Bestätigung nach Passwort vergessen
        $this->template = 'text';
        $this->nav = 'Passwort vergessen';
        $this->text[] = 'Wir haben Ihnen Ihr neues Passwort an Ihre E-Mail-Adresse geschickt. Bitte folgen Sie den Anweisungen in dieser E-Mail, um sich einzuloggen.';
        $this->text[] = BFT_Lang::mail_spam;
        $this->text[] = 'Falls Sie sich weiterhin nicht einloggen können, können Sie sich auch direkt mit uns in Verbindung setzen.';
        $this->text[] = 'Email: Berufsziele@aol.de oder Tel: 040 65993820';
        break;
        
    case 30:
        // Login Bildschirm wieder
        $this->template = 'loginauswahl';
        $this->login = array();
        if (isset($data->login)) $this->login = $data->login;
        break;

    case 31:
        // This code is executed when the user clicks the button "Start Hamburger Paartherapie-Test"
        // on the start page. The template newTestOrContinueTest asks the user if he wants to
        // continue a test that was interrupted before or if he wants to start a new test.
        $this->template = 'newTestOrContinueTest';
        break;
}
?>

