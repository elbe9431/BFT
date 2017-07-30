<?php
/**
 * paartherapietest :: German language file
 *
 * @version 1.0
 * @package paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_Lang
{
    // Website description and title
    const title                 = 'Hamburger Paartherapie-Test | Wünsche an den Partner klären';   // inkl. Keywords
    const shorttitle            = 'Hamburger Paartherapie-Test - Online-Test und Hilfe für Personen, die Ihre Partnerschaft weiterentwickeln wollen';
    const description           = 'Der Hamburger Paartherapie-Test online hilft Ihnen, Ihre Wünsche an den Partner kostenlos zu klären. Er bietet Hilfen, wie Sie diese Wünsche in die Partnerschaft einbringen können.'; // 150-170 Zeichen
    const keywords              = 'Paartherapietest, Paartherapie-Test, Paarberatung, Paarentwicklung, online, kostenlos';   // max. 5 Wörter
    const author                = 'Enno Heyken';        // nur der Name
    const contact               = 'mail@praxis-psychologen.de'; // Email
    
    // Error text
    const error                 = 'Fehler (%d) %s<br /><br />Bitte wählen Sie eine der folgenden Optionen:<br /><br />1) <a href="javascript:history.back()">Zurück</a><br />2) <a href="javascript:location.reload()">Neu Laden</a><br />3) <a href="http://www.paartherapietest.eu">Startseite</a>';
    
    // General
    const button_next           = 'Weiter';
    const button_back           = 'Zurück';
    const button_reset          = 'Reset';
    const button_accept         = 'Akzeptieren';
    const button_cancel         = 'Abbrechen';
    const button_login          = 'Login';
    const button_register       = 'Anmelden';
    const button_pwd            = 'Passwort vergessen?';
    const button_send           = 'Absenden';
    const button_clear          = 'Zurücksetzen';
    
    const header_title          = 'Hamburger Paartherapietest';
    const table_empty           = 'Tabelle ist leer';
    
    // Hauptmenü
    const menu_p1_neu           = 'Sie können jetzt direkt das kostenlose Modul 1 - Berufsinteressen starten (Dauer ca. 15-30 Minuten).';
    const menu_p1_fortsetzen    = 'Sie haben das Modul 1 - Berufsinteressen bereits gestartet. Sie können jetzt an der Stelle fortsetzen, an der Sie aufgehört haben.';
    const menu_p1_ergebnis      = 'Ich möchte mir die Ergebnisse von Modul 1 - Berufsinteressen erneut ansehen.';
    const menu_p1_vonvorne      = 'Ich möchte das Modul 1 - Berufsinteressen erneut von vorne durchlaufen.';
    const menu_p2_bez           = 'Der Test "Wünsche kären" ist beendet.<br/><br/>Wir raten Ihnen, nun das Aufbautool <strong>„Lösungen finden“</strong> anzuschließen! Das Tool ist ebenfalls völlig anonym, ohne Eingabe persönlicher Daten und ohne Anmeldung.<br/><br/> „Lösungen finden“ kostet 9,50 Euro, dauert 30 Minuten und baut auf Ihren Ergebnissen in „Wünsche klären“ auf. <br>Sie werden zu <strong>3 passgenauen Lösungsideen</strong> geführt. <br/><br/>Nachfolgend die Teilnahmebedingungen und die Bezahloptionen mit Paypal, Lastschrift und Überweisung. <strong>Sie können "Lösungen finden" unmittelbar nach der Bezahlung starten.</strong>';
    const menu_p2_bezueberw     = 'Sie haben Banküberweisung als Bezahlart gewählt. Bitte warten Sie, bis wir Ihre Bezahlung erhalten haben und Ihren Account freischalten. Sollten Sie noch nicht überwiesen haben, so können Sie auch noch eine andere Bezahlart wählen.';
    const menu_p2_buchen        = 'Wir werden an Ihrer Schule demnächst eine Veranstaltung zur Berufsberatung durchführen. Wenn Sie an dieser Veranstaltung teilnehmen, dann können Sie auch das Modul 2 – Berufswahl kostenfrei nutzen, sobald wir Ihre Anmeldung erhalten haben.';
    const menu_p2_bez_alt       = 'Ich bin mir sicher, dass ich nicht an der Veranstaltung zur Berufsberatung an meiner Schule teilnehme. Ich möchte das Modul 2 - Berufswahl direkt für %s buchen.';
    const menu_p2_neu           = 'Sie können jetzt das Modul 2 - Berufswahl starten (Dauer ca. 30-60 Minuten).';
    const menu_p2_fortsetzen    = 'Sie haben das Tool "Lösungen finden" bereits gestartet. Sie können jetzt an der Stelle fortsetzen, an der Sie aufgehört haben.';
    const menu_p2_ergebnis      = 'Ich möchte mir die Ergebnisse von "Lösungen finden" erneut ansehen.';
    const menu_p2_vonvorne      = 'Ich möchte das Tool "Lösungen finden" erneut von vorne durchlaufen.';
    const menu_testendeohneerg  = 'Herzlichen Glückwunsch! Sie haben den Hamburger Paartherapietest komplett durchlaufen. Ihre Ergebnisse erhalten Sie in der Berufsberatung. Sie werden jetzt auf die Seite von www.berufsziele.de weitergeleitet.';
    const menu_testendemiterg   = 'Herzlichen Glückwunsch! Sie haben den Hamburger Paartherapietests komplett durchlaufen. Sie werden jetzt auf die Seite von www.berufsziele.de weitergeleitet.';
    const menu_info             = 'Ich möchte gern in einer Preview sehen, was mich beim Tool "Lösungen finden" erwartet:';
    const menu_beenden          = '<br>Ich möchte gern den Test beenden. Zu einem meiner bisherigen Favoriten-Wünsche kann ich dann noch einen Beispiel-Videoclip mit Lösungsideen schauen. <br>Wenn Sie "viel mehr wollen", dann wählen Sie bitte links den Button „Lösungen finden“. <br>Sie erhalten dann umfangreiche Hilfestellungen zur Verbesserung Ihrer Partnerschaft.';
    
    // Bezahlung
    const bez_erfolg1           = 'Vielen Dank für Ihre Bezahlung. Sie können jetzt sofort das Tool Lösungen finden  starten.';
    const bez_fehler1           = 'Ihre Bezahlung wurde abgebrochen. Bitte versuchen Sie es noch einmal oder wählen Sie eine andere Option.';
    const bez_ueberw2           = 'Bitte überweisen Sie den Betrag von %s auf folgendes Konto:';
    const bez_ueberw3           = 'Kontoinhaber: Enno Heyken<br />Kreditinstitut: Netbank<br />Bankleitzahl: 20090500<br />Kontonummer: 7380194';
    const bez_ueberw4           = 'Wichtig ist, dass Sie bei der Überweisung als <strong>Verwendungszweck Ihre E-Mail-Adresse und das Kennwort paartherapietest </strong> vermerken, damit wir sie richtig zuordnen können.';
    const bez_ueberw5           = 'Wenn Sie uns zusätzlich <strong>die Überweisungsdaten an berufsziele@aol.com mailen</strong>, schalten wir Sie schneller, meist innerhalb von 24 Stunden, frei. Wir senden Ihnen eine Mail, sobald Sie den Test starten können.';
    const bez_ueberw6           = 'Diese Informationen senden wir Ihnen zusätzlich auch als Mail.';
    
    // Mail Tipp wegen Spamfilter
    const mail_spam             = '';
    
    // Copyright auf Startseite
    const copyright             = 'Copyright &copy; 2016 Psychodiagnostische Beratungspraxis, Inhaber Enno Heyken<br />Die Verwendung des Tests, auch in Teilen, ist nur mit schriftlicher Genehmigung der Psychodiagnostischen Beratungspraxis, Inhaber Enno Heyken, Wandsbeker Königstr. 11, 22041 Hamburg gestattet.';
    
    // Einleitung
    const einleitung11          = 'Der Hamburger Paartherapie-Test soll Ihnen helfen, Ihre Wünsche an den Partner zu klären. Er soll Ihnen am Ende Hinweise bieten, wie Sie diese Wünsche in die Partnerschaft einbringen können und was Sie gemeinsam mit dem Partner verändern könnten.';
    const einleitung12          = 'Es gibt zwei Teile, den Selbsttest "Wünsche klären" und das Tool "Lösungen finden". Sie durchlaufen nun den kostenlosen Selbsttest "Wünsche klären".';
    const einleitung13          = 'Persönliche Daten müssen Sie bei diesem Test nicht eingeben. Die Testdaten werden von uns lediglich anonym gespeichert und ausschließlich zur Weiterentwicklung des Tests verwendet.';   
    const einleitung14          = 'Falls eine <strong>Toolbar</strong> im Browser während des Tests störende Popups erzeugt, dann können Sie diese durch Klick auf das x neben der Toolbar deaktivieren.';
    const einleitung15          = 'Wenn Sie mit diesen Teilnahmebedingungen einverstanden sind, dann klicken Sie bitte auf "Weiter".';
    
    const einleitung21          = 'Diese Folie ist aktuell leer.';
    const einleitung22          = '';
    const einleitung23          = '';

    const einleitung31          = 'Diese Folie ist aktuell leer.';
    const einleitung32          = '';
    const einleitung33          = '';
    const einleitung34          = '';

    const einleitung41          = 'Aus Gründen der Übersichtlichkeit schreiben wir an vielen Stellen <strong>„der Partner“</strong>. Damit ist dann in aller Regel auch <strong>„die Partnerin“</strong> gemeint.';
    const einleitung42          = 'Klicken Sie auf <strong>Weiter</strong>, um mit dem Test zu beginnen.';
    const einleitung43          = '';
    
    const einleitung51          = 'Auf den folgenden Seiten werden Ihnen nacheinander <strong>13 Themenfelder der Paarbeziehung</strong> kurz vorgestellt.';
    const einleitung52          = 'Ihre Aufgabe ist es, für jedes Themenfeld zu entscheiden, ob Sie kurzfristig etwas ändern wollen oder nicht. ';
    const einleitung53          = 'Wenn Sie unsicher mit Ihrer Entscheidung sind, dann können Sie „Unklar“ anklicken. Sie werden dann zu einer Entscheidung geführt. ';
    const einleitung54          = '<strong>Wollen Sie beginnen?</strong>';
    
    // Phase 1
    const phase1_headline       = 'Phase 1';
    const phase1_headline_text  = '<strong>Bei welchen Themenfeldern würden Sie gern kurzfristig etwas ändern - und bei welchen nicht?</strong>';
    
    const phase1_einstimmung1   = 'Einstimmung';
    const phase1_einstimmung2   = 'Zwei Fragen, nur kurz zum Nachdenken';
    const phase1_einstimmung3   = 'Jetzt weiter zur eigentlichen Aufgabe';
    const phase1_mouseover      = 'Bewegen Sie die Maus über eines der 10 Felder, um Erläuterungen der Begriffe zu lesen';
    const phase1_ihrefrage      = 'Nun Ihre Frage:';
    const phase1_klicken        = 'Klicken Sie bitte auf einen der folgenden Antwort-Buttons:';
    const phase1_frage1         = '<p style="  position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">%d<p><h2>Themenfeld „%s“ </h2>Um Themen wie diese könnte es gehen:';
    const phase1_frage2         = '%s<br />';
    const phase1_nachfrage1     = 'Hier nochmals die %d Beispiele,<br>Aus dem Themenfeld: %s';
    const phase1_nachfrage2     = 'Wie viele der %d obenstehenden Themen wollen Sie in den kommenden Monaten klären, um etwas zu verändern?';
    const phase1_button1        = 'Nein';
    const phase1_button2        = 'Unklar';
    const phase1_button3        = 'Ja';
    const phase1_button4        = 'Mehrere';
    const phase1_button5        = 'Eins';
    const phase1_button6        = 'Keines';
    const phase1_retten1        = 'Klicken Sie auf das Thema, bei dem Ihnen eine Änderung innerhalb der nächsten Monate am wichtigsten wäre.';
    const phase1_retten2        = 'Gibt es bei den 10 folgenden ein Thema, bei dem Ihnen eine Änderung innerhalb der nächsten Monate wichtig wäre?';
    const phase1_retten5        = 'Falls nicht, dann klicken Sie bitte auf „Kein Thema“';
    const phase1_retten6        = 'Andernfalls <strong>klicken Sie bitte auf das Thema</strong>, bei dem Ihnen eine Änderung am wichtigsten ist.';
    const phase1_allestreichen  = 'Kein Thema';

    const phase1_bisher1        = 'Bisherige Antwort:<br />Mehrere';
    const phase1_bisher2        = 'Bisherige Antwort:<br />Keines';
    const phase1_bisher3        = 'Bisherige Antwort:<br />Eins / %s';
    const phase1_bisher4        = 'Bisherige Antwort:<br />%s';

    const phase1_tablezeile1    = 'Wir präsentieren Ihnen nun rechts noch einmal alle Themenfelder, bei denen Sie einen Veränderungsbedarf gesehen haben.';
    const phase1_tablezeile21   = 'Um die nächste Stufe des Tests zu erreichen, müssen Sie eins davon zusätzlich streichen. Streichen Sie bitte die Themenfelder, bei denen Sie im Vergleich zu den anderen  aktuell weniger Veränderungsbedarf sehen.';
    const phase1_tablezeile22   = 'Um die nächste Stufe des Tests zu erreichen, müssen Sie %d davon zusätzlich streichen. Streichen Sie bitte die Themenfelder, bei denen Sie im Vergleich zu den anderen  aktuell weniger Veränderungsbedarf sehen.';
    const phase1_tablezeile31   = '<strong>Bitte wählen Sie genau ein Themenfeld aus, das Sie zunächst nicht weiter verfolgen wollen.</strong>';
    const phase1_tablezeile32   = '<strong>Bitte wählen Sie genau %d Themenfelder aus, die Sie zunächst nicht weiter verfolgen wollen.</strong>';
    const phase1_tablezeile4    = '<em>Erneutes Klicken hebt die Auswahl wieder auf.</em>';
    const phase1_tablezeile51   = 'Sie erhalten anschließend die Möglichkeit, bei jedem gestrichenen Themenfeld ein einzelnes Unterthema auszuwählen, welches Sie weiter im Test behalten wollen.';
    const phase1_tablezeile52   = 'Sie erhalten anschließend die Möglichkeit, bei jedem gestrichenen Themenfeld ein einzelnes Unterthema auszuwählen, welches Sie weiter im Test behalten wollen.';
    const phase1_tablezeile6    = '<em>Gehen Sie mit der Maus über Themenfelder, um nähere Informationen dazu zu erhalten.</em>';
    const phase1_tableerror1    = 'Sie müssen genau 1 Themenfeld auswählen!';
    const phase1_tableerror2    = 'Sie müssen genau %d Themenfelder auswählen!';

    const phase1_relevante11    = 'Sie haben nun alle %d Themenfelder für sich bewertet.';
    const phase1_relevante12    = 'Sie haben nun alle %d Themenfelder für sich bewertet.'; // erneut
    const phase1_relevante2     = 'Bei %d davon haben Sie eingeschätzt, dass es Veränderungsbedarf in Ihrer Beziehung gibt. Diese sehen Sie rechts eingeblendet.';
    const phase1_relevante31    = 'Der Test beruht darauf, sich mit denjenigen Veränderungswünschen gezielt auseinander zu setzen, welche Ihnen am wichtigsten erscheinen.';
    const phase1_relevante32    = 'Der Test beruht darauf, sich mit denjenigen Veränderungswünschen gezielt auseinander zu setzen, welche Ihnen am wichtigsten erscheinen.';
    const phase1_relevante4     = 'Wir möchten Sie bitten, diejenigen Themenfelder noch einmal anzuschauen, bei denen Sie erheblichen Veränderungsbedarf sehen. ';
    const phase1_relevante5     = '';
    const phase1_relevante6     = 'Sind die vorgegebenen Themenfelder für mich wirklich alle unmittelbar bedeutsam?';
    const phase1_relevante71    = '<strong>Klicken Sie beim nächsten Durchgang bei mindestens einem Thema auf einen der Button "Eins" oder "Keines".</strong>';
    const phase1_relevante72    = '<strong>Klicken Sie beim nächsten Durchgang bei mindestens %d Themen auf einen der Button "Keines" oder "Eins".</strong>';
    const phase1_relevante8     = 'Themenfelder mit kurzfristigem  Veränderungsbedarf?';

    const phase1_streicher11    = 'Sie haben nun alle 13 Themen für sich bewertet,';
    const phase1_streicher12    = 'Sie haben nun alle %d Themen für sich bewertet.'; // erneut
    const phase1_streicher2     = 'Bei %d  davon haben Sie eingeschätzt, dass es aktuell im Großen und Ganzen okay in Ihrer Beziehung ist. Diese sehen Sie rechts eingeblendet.';
    const phase1_streicher31    = 'Der Test beruht darauf, sich in unterschiedlichen Themenbereichen mit möglichen Wünschen an den Partner auseinander zu setzen.';
    const phase1_streicher32    = 'Der Test beruht darauf, sich in unterschiedlichen Themenbereichen mit möglichen Wünschen an den Partner auseinander zu setzen.';
    const phase1_streicher4     = '';
    const phase1_streicher5     = 'Wir möchten Sie bitten, diejenigen Themenfelder noch einmal anzuschauen, bei denen Sie keinen besonderen Veränderungsbedarf sehen. ';
    const phase1_streicher6     = 'Schauen Sie diesmal, ob es Themenfelder gibt, bei denen zwar keine besonderen Probleme bestehen, bei denen aber eine Weiterentwicklung Ihrer Beziehung schön wäre.';
    const phase1_streicher71    = '<strong>Klicken Sie beim nächsten Durchgang bei mindestens einem Thema auf den Button "Mehrere".</strong>';
    const phase1_streicher72    = '<strong>Klicken Sie beim nächsten Durchgang bei mindestens %d Themen auf den untenstehenden Button "Mehrere".</strong>';
    const phase1_streicher8     = 'Themenfelder ohne Veränderungsbedarf?';

    const phase1_endseite1      = 'Sie haben Phase 1 des Tests "Wünsche klären" erfolgreich abgeschlossen.<br><br> Sie haben dabei einige Themenfelder und Themen als „im Großen und Ganzen okay“ in Ihrer Partnerschaft bewertet. Für andere haben Sie Interesse gezeigt, eventuell in nächster Zeit etwas zu verändern.';
    const phase1_endseite2      = 'In der nun folgenden Phase 2 werden Sie sich mit möglichen Wünschen zu diesen von Ihnen ausgewählten Themen befassen. <br><br><strong>Manche Wünsche werden eventuell gar nicht passen, andere besser.</strong> Sie sollen entscheiden, welche der Wünsche für Sie interessant sein könnten.';
    
    // Phase 2
    const phase2_headline       = 'Phase 2';
    const phase2_headline_text  = '<strong>Welche Wünsche sind Ihnen in der kommenden Zeit wichtig?</strong>';
    
    const phase2_einleitung111  = 'In <strong>Phase 2</strong> werden Sie immer eine Auswahl von Wünschen anschauen. Sie müssen abwechselnd einige davon "in den Papierkorb werfen" und anschließend die übrigen Wünsche nach Ihrer aktuellen Wichtigkeit "sortieren".';
    const phase2_einleitung112  = 'Zunächst zeigen wir Ihnen %d Wünsche.';
    const phase2_einleitung113a = '<strong>Welche von diesen Wünschen sind aktuell für Sie am wenigsten zutreffend oder wichtig?</strong>';
    const phase2_einleitung113b = '<strong>Welche %d von diesen Wünschen sind aktuell für Sie am wenigsten zutreffend oder wichtig?</strong>';
    const phase2_einleitung114  = 'Die dazugehörigen Kästen ziehen Sie bitte mit der Maus in einen bereitstehenden <strong>„Papierkorb“</strong>.';
    
    const phase2_einleitung211  = 'In <strong>Phase 2</strong> werden Sie jeweils <strong>%d Wünsche</strong> in eine Reihenfolge bringen - die für Sie wichtigen nach oben, die unwichtigen oder unpassenden nach unten.';
    const phase2_einleitung212  = 'Sie werden Wünsche mit der Maus in eine Tabelle <strong>„sortieren“</strong> – nach ganz oben den Wunsch, der Ihnen aktuell als am wichtigsten erscheint. Dann der „zweitwichtigste“ Wunsch und so fort.<br><br><strong>Es kann auch passieren, dass alle Wünsche völlig unpassend sind</strong> - dann sortieren Sie sie bitte trotzdem, das "Erträglichste" nach oben, das "am allerwenigsten passende" nach unten.';
    const phase2_einleitung213  = '%d solche „Sortierkästen“ sollen Sie in dieser Phase nacheinander „in Ordnung bringen“ – so dass jeweils eine Rangliste der Wünsche entsteht.';
    
    const phase2_einleitung311  = 'Jetzt möchten wir Sie bitten, %d mögliche Wünsche an den Partner danach zu sortieren, wie passend sie Ihnen erscheinen.';
    const phase2_einleitung312  = 'Dies geschieht dadurch, dass Sie die Wünsche mit der Maus <strong>in eine Tabelle „sortieren“</strong> – nach ganz oben der Wunsch,der am besten passt oder am wichtigsten ist. Dann der „zweitpassendste“ Wunsch und so fort.';
    const phase2_einleitung313  = 'Es werden nachfolgend %d weitere „Papierkörbe“ und „Sortierkästen“ folgen, die Sie genau wie die ersten mit der Maus „in Ordnung“ bringen sollen.';

    const phase2_einleitung411  = '<strong>Wir möchten Sie bitten, auf der nächsten Seite einige zusätzliche Wünsche anzuschauen.</strong>';
    const phase2_einleitung412a = 'Ihre Aufgabe ist es, einen von diesen Wünschen in den bereitstehenden Papierkorb zu ziehen.';
    const phase2_einleitung412b = 'Ihre Aufgabe ist es, %d von diesen Wünschen in den bereitstehenden Papierkorb zu ziehen.';
    const phase2_einleitung413  = 'Klicken Sie dazu mit der linken Maustaste auf einen der Wünsche.';
    const phase2_einleitung414  = 'Halten Sie die Maustaste gedrückt und ziehen Sie den Wunsch direkt in den Papierkorb.';
    
    const phase2_einleitung421  = 'Nun möchten wir Sie ein letztes Mal bitten, <strong>Wünsche in eine Tabelle zu „sortieren“</strong> – genau so wie bei den 10 vorherigen Sortiertabellen.';

    const phase2_papierkorb11   = '<strong>Welcher Wunsch ist für Sie am wenigsten zutreffend oder wichtig?</strong>';
    const phase2_papierkorb12   = '<strong>Welche %d Wünsche sind für Sie am wenigsten zutreffend oder wichtig?</strong>';
    const phase2_papierkorb13   = 'Bitte den Wunsch, der für Sie aktuell am wenigsten zutreffend oder wichtig ist, in den Papierkorb werfen!';
    const phase2_papierkorb14   = 'Bitte die %d Wünsche, die für Sie aktuell am wenigsten zutreffend oder wichtig sind, in den Papierkorb werfen!';
    const phase2_papierkorb15   = 'Dazu bitte den Wunsch mit der Maus in den Papierkorb ziehen.';
    const phase2_papierkorb16   = 'Wenn Sie die einen Wunsch weggeworfen haben bitte auf „Weiter“ klicken.';
    const phase2_papierkorb17   = 'Wenn Sie die %d Wünsche weggeworfen haben bitte auf „Weiter“ klicken.';
    
    const phase2_papierkorb21   = '<strong>Welcher Wunsch passt gar nicht?</strong>';
    const phase2_papierkorb22   = '<strong>Welche %d Wünsche passen gar nicht?</strong>';
    const phase2_papierkorb23   = 'Zunächst bitte die Wünsche, die am wenigsten passen,  wegwerfen!';
    const phase2_papierkorb24   = 'Zunächst bitte die  %d Wünsche, die am wenigsten passen,  wegwerfen!';
    const phase2_papierkorb25   = 'Dazu bitte den Wunsch mit der Maus in den Papierkorb ziehen.';
    const phase2_papierkorb26   = 'Wenn Sie den Wunsch weggeworfen haben bitte auf „Weiter“ klicken.';
    const phase2_papierkorb27   = 'Wenn Sie %d Wünsche weggeworfen haben bitte auf „Weiter“ klicken.';
    
    const phase2_frage          = '<strong>Welcher Wunsch passt am besten?</strong>';
    const phase2_anleitung1     = 'Bitte ziehen Sie mit der Maus die Wünsche in die Tabelle. <strong>An 1 das Passendste, an %d das Unpassendste</strong>.';
    const phase2_anleitung2     = 'Auch innerhalb der Tabelle können Sie mit der Maus jederzeit Wünsche weiter nach oben oder unten verschieben.';
    const phase2_anleitung3     = 'Wenn Sie Ihre Sortierung abgeschlossen haben, klicken Sie bitte auf Weiter.';

    const phase2_ergebnis1      = '<strong>Sie haben den Selbsttest "Wünsche klären", erfolgreich beendet!</strong>';
    const phase2_ergebnis2      = 'Bevor Sie das darauf aufbauende Tool <strong>"Lösungen finden"</strong>, starten können, werden Ihnen nun die drei Themenfelder angezeigt, zu denen Sie besonders viele Wünsche als bedeutsam bewertet haben.';
    const phase2_ergebnis3      = '';

    const phase2_table1         = 'Erstes kleines Zwischenergebnis, Test „Wünsche klären“.<br />Felder, deren Themen häufig ausgewählt wurden:<br> <p style="font-style: normal;font-size:16px"><small>(„Prozent“ meint: Ihre Auswahl im Vergleich zur maximal möglichen Auswahl)</small></p>';
    const phase2_table1col1     = 'Platz';
    const phase2_table1col2     = 'Themenfeld';
    const phase2_table1col3     = 'Beschreibung';
    const phase2_table1col4     = 'Prozent';
    
    const phase2_ergebnis8      = 'Nachfolgend die <strong>Gesamttabelle der Themenfelder</strong>, ohne zusätzliche Beschreibungen. </br></br>Sie soll Ihnen einen kompakten Überblick verschaffen, welche Felder als unproblematisch bewertet wurden und für welche es aus Ihrer Sicht Veränderungsbedarf gibt.';

    const phase2_table2         = 'Testergebnis  „Wünsche klären“<br />Gesamtrangliste der Themenfelder, deren Wünsche häufig gewählt wurden';
    const phase2_table2col1     = 'Platz';
    const phase2_table2col2     = 'Themenfeld';
    const phase2_table2col3     = 'Prozent';
    
    const phase2_ergebnis4      = 'Wollen Sie erfahren, welches Ihre <strong>drei wichtigsten Wünsche</strong> an den Partner sind - und was sie beide dafür tun können, etwas zu verbessern?';
    const phase2_ergebnis5      = 'Dann sollten Sie direkt im Anschluss <strong>"Lösungen finden"</strong> nutzen! ';
    const phase2_ergebnis6      = 'Das Tool <strong>"Lösungen finden"</strong>  ist das <strong>Herzstück und das eigentliche Ziel</strong> des Hamburger Paartherapietests. Es ermöglicht Ihnen, sich intensiv mit Ihren Wünschen auseinander zu setzen. Und Antworten zu erhalten auf die Frage: <br>Was können Sie beide tun, um die Partnerschaft zu verbessern?. <br/><br/>Damit Sie schon jetzt ein erstes konkretes Ergebnis in die Hand bekommen, erhalten Sie auf den nächsten beiden Seiten eine <strong>vorläufige Zusammenstellung von Wünschen</strong>, von denen einige größere Bedeutung für Sie haben könnten.';

    const phase2_table3         = 'Handlungsorientierte Wünsche, von denen einige Bedeutung haben könnten <br/><h4>(wesentlich aussagefähigere Ergebnisse bietet das Tool "Lösungen finden")</h3>';
    const phase2_table3col1     = 'Nummer';
    const phase2_table3col2     = 'Wunsch';
    const phase2_table3col3     = 'Gehört zu Themenfeld';

    const phase2_table4         = 'Auf Einstellungen bezogene Wünsche, von denen einige Bedeutung haben könnten<br/><h4>(wesentlich aussagefähigere Ergebnisse bietet das Tool "Lösungen finden")</h3>';
    const phase2_table4col1     = 'Nummer';
    const phase2_table4col2     = 'Wunsch';
    const phase2_table4col3     = 'Gehört zu Themenfeld';

    const phase2_endseite1      = 'Sie haben Test 1 - Berufsinteressen erfolgreich beendet.';
    const phase2_endseite2      = 'Sie werden jetzt zum Hauptmenu weitergeleitet, wo Sie das Tool Lösungen finden starten können, wenn Sie wollen.';
    const phase2_endseite3      = '<strong>Was erwartet Sie beim Tool Lösungen finden?</strong> Nun, bislang haben Sie mit dem Selbsttest Wünsche klären erarbeitet, aus welchen Themenfeldern Ihre wichtigsten Wünsche stammen. Beim Tool Lösungen finden wird es viel konkreter: <br><strong>Jetzt erarbeiten Sie, welches die bedeutsamsten Ihrer Wünsche sind und erhalten genau zu diesen Wünschen gezielte Hinweise, wie Sie diese in die Partnerschaft einbringen können. Dabei baut "Lösungen finden" auf die Ergebnisse von "Wünsche klären" auf, nur die von Ihnen am höchten bewerteten 30 Wünsche sind jetzt noch in der Auswahl. Und: Während des Tools erhalten Sie <strong>Infos und Einschätzungen</strong> zu den Wünschen, die sie gerade besonders interessieren. Das Tool "Lösungen finden" ist gegen eine Zahlung von <strong>9,50 Euro</strong> nutzbar. Hierbei können Sie Paypal, Bankeinzug, oder Banküberweisung als Zahlungsmethoden wählen.';
    const phase2_endseite4      = 'Wir werden an Ihrer Schule demnächst eine Veranstaltung zur Berufsberatung durchführen. Wenn Sie an dieser Veranstaltung teilnehmen, dann können Sie auch das Tool "Lösungen finden" kostenfrei nutzen, sobald wir Ihre Anmeldung erhalten haben.';
    const phase2_endseite5      = 'Die Anmeldung erfolgt durch Ihre Eltern, Sie können sich aber auch selbst zunächst über den Ablauf und den Termin informieren unter <a href="http://www.berufsziele.de/anmeldeformularSchule.php" target="_blank">http://www.berufsziele.de/anmeldeformularSchule.php</a>';
    
    // Phase 3
    const phase3_headline       = 'Tool Lösungen finden';
    const phase3_headline_text  = '<strong>Welche Wünsche sind für die kommende Zeit wirklich wichtig?</strong><br><br> Und wie lassen sich diese Wünsche in die Partnerschaft einbringen?';
    
    const phase3_einleitung11   = 'Das Tool <strong>"Lösungen finden"</strong>  des Hamburger Paartherapietests beinhaltet paarweise Vergleiche derjenigen Wünsche aus dem Selbsttest "Wünsche klären", die bislang noch nicht aussortiert wurden.';
    const phase3_einleitung12   = 'Das Feld der Wünsche wird im Verlauf des Tests weiter reduziert und in eine Rangfolge gebracht. <br><br>Sie werden immer aus <strong>zwei Möglichkeiten</strong> den Wunsch auswählen, der Ihren eigenen Wünschen an den Partner am ehesten oder am genauesten entspricht.';
    const phase3_einleitung13   = '';
    const phase3_einleitung14   = '';
    
    const phase3_einleitung21   = 'Bitte stellen Sie sich darauf ein, dass Sie manchmal <strong>„das kleinere Übel“</strong> auswählen müssen. Das gehört zum Testkonzept.<br><br>Sie haben jedoch in der Anfangsphase auch die Möglichkeit, beide Wünsche als <strong>völlig unpassend</strong> zu bewerten.';
    const phase3_einleitung22   = 'Andererseits müssen Sie bisweilen zwischen zwei Wünschen, welche Ihnen <strong>beide gefallen</strong>, eine Wahl treffen. Auch das gehört zum Testkonzept';
    const phase3_einleitung23   = 'Also: Wenn Ihnen zwei Wünsche <strong>gleich gut</strong> gefallen, dann prüfen Sie, welcher Wunsch doch <strong>ein klein wenig besser für Sie passend </strong>sein könnte.';
    const phase3_einleitung24   = 'Wählen Sie dann diesen Wunsch als <strong>"Etwas wichtiger"</strong> aus - und verlassen Sie sich bei der Wahl ruhig auf Ihr "Bauchgefühl".';
    
    const phase3_einleitung25   = 'Noch ein Tipp: Wenn Sie mit der <strong>Maus</strong> über die Zeile <strong>„Paartherapie-Tipps“</strong> gehen, erhalten Sie zusätzliche Einschätzungen der Paartherapeuten zu diesem Thema.';
    
    const phase3_einleitung31   = 'Jetzt startet der <strong>%s von fünf Durchgängen</strong> mit Vergleichen von Wünschen – es sind noch %d Wünsche übrig.';
    const phase3_einleitung32   = 'Am Ende dieser Runde wird die Zahl der Wünsche weiter reduziert.';
    const phase3_einleitung33   = '<strong>Wollen Sie beginnen?</strong>';
    
    const phase3_einleitung41   = 'Sie haben den <strong>%s Durchgang</strong> der Wunschvergleiche geschafft!';
    const phase3_einleitung42   = 'Jetzt möchten wir Sie bitten auf der folgenden Seite einige Wünsche aus dem Test zu streichen. Dazu müssen Sie die einzelnen Wünsche mit der Maus in den Papierkorb ziehen.';
    
    const phase3_papierkorb1    = 'Welche %d Wünsche wollen Sie jetzt streichen?';
    const phase3_papierkorb2    = 'Jetzt bitte die %d Wünsche, die am wenigsten gefallen wegwerfen.';
    const phase3_papierkorb3    = 'Dazu den Wunsch mit der Maus in den Papierkorb ziehen.';
    const phase3_papierkorb4    = 'Wenn Sie mit der Maus über einzelne Wünsche gehen, erhalten Sie zusätzliche Hinweise eingeblendet.';
    
    const phase3_ergebnis11     = 'Sie haben nun das Tool "Lösungen finden" des Hamburger Paartherapie-Tests erfolgreich beendet.';
    const phase3_ergebnis12     = 'Wir haben alle Wünsche in den einzelnen Themenfeldern in eher <strong>„Einstellungen“</strong> betreffend und eher <strong>„Handlungsorientiert“</strong> unterschieden.';
    const phase3_ergebnis13     = 'Es folgen nun die 3 eher <strong>handlungssorientierten Wünsche</strong>, die Sie als aktuell am wichtigsten bewertet haben.';
    
    const phase3_table1         = 'Die beiden letzten Tabellen haben wir in ein Endergebnis zusammengeführt. <br>Hier nun die 3 Wünsche, die Sie insgesamt als aktuell am wichtigsten bewertet haben:';
    const phase3_table1col1     = 'Platz';
    const phase3_table1col2     = 'Wunsch';
    const phase3_table1col3     = 'Form des Wunsches';
    const phase3_table1col4     = 'Themenfeld';
    const phase3_table1col5     = 'Prozent';
    
    const phase3_ergebnis21     = 'Sie erhalten nun zu den 3 von Ihnen als am wichtigsten bewerteten Wünschen Ideen, wie Sie diese mit dem Partner klären könnten.<br><br><ul><li>Als Videovortrag;</li><li>Als Text auf dem Bildschirm;</li><li>Ganz am Ende können Sie zusätzlich alle Ergebnisse und Ideen ausdrucken. </li></ul>';
    const phase3_ergebnis22	    = '<strong>Wir starten mit dem Wunsch, den Sie im Test als für Sie aktuell am wichtigsten bewertet haben.</strong>';

    const phase3_table2         = 'Die 3 von Ihnen als am wichtigsten bewerteten eher handlungsorientierten Wünsche<br> <p style="font-style: normal;font-size:16px"><small><strong>Hinweis:</strong> „Prozent“ meint: Ihre Auswahl im Vergleich zur maximal möglichen Auswahl. Bei Werten unter 50, könnte der zugehörige Wunsch wenig Bedeutung haben. Sie haben dann beim Test stärker „Einstellungs-Wünsche" ausgewählt. </small></p>';
    const phase3_table2col1     = 'Platz';
    const phase3_table2col2     = 'Wunsch';
    const phase3_table2col3     = 'Themenfeld';
    const phase3_table2col4     = 'Prozent';
    
    const phase3_ergebnis31     = 'Es folgen nun die 3 Wünsche in Richtung <strong>"Einstellungen"</strong>, die Sie als aktuell am wichtigsten bewerteten.';

    const phase3_table3         = 'Die 3 aktuell als am wichtigsten bewerteten Wünsche in Richtung „Einstellungen“<br> <p style="font-style: normal;font-size:16px"><small><strong>Hinweis:</strong> „Prozent“ meint: Ihre Auswahl im Vergleich zur maximal möglichen Auswahl. Bei Werten unter 50, könnte der zugehörige Wunsch  wenig Bedeutung haben. Sie haben dann beim Test stärker handlungsorientierte Wünsche ausgewählt. </small></p>';
    const phase3_table3col1     = 'Platz';
    const phase3_table3col2     = 'Wunsch';
    const phase3_table3col3     = 'Themenfeld';
    const phase3_table3col4     = 'Prozent';
    
    const phase3_endseite1      = 'Sie haben nun 3 mögliche Wünsche an den Partner erarbeitet.<strong><br>Wie könnte es damit weitergehen?</strong><br><br><strong>Halten Sie erstmal inne.</strong> Nicht jeder Wunsch muss gleich verwirklicht werden. Der Test diente zunächst einmal der Unterstützung Ihrer Selbstklärung.<br><br>Wenn Sie das Testergebnis nutzen wollen, um tatsächlich etwas zu ändern, dann raten wir: Bringen Sie - bei passender Gelegenheit - zunächst <strong>nur einen statt alle drei Wünsche</strong> zur Sprache. Dann fühlt sich der Partner weniger "überrannt". Wenn sich an einem Punkt Ihrer Partnerschaft etwas ändert, dann ändern sich oft andere Dinge mit. Oder erscheinen in anderem Licht. <br><br>Von unserer Seite jedenfalls: <strong>Viel Glück für Sie... und für Sie beide!</strong> Und: Paartherapie ist immer noch eine zusätzliche Möglichkeit!';
    
    const phase3_endseite2      = 'Sie haben jetzt die Hamburger paartherapietests komplett durchlaufen. Das Ergebnis erhalten Sie bei der Veranstaltung zur Berufsberatung, zu der Sie angemeldet sind.';
    const phase3_endseite3      = 'Wir freuen uns darauf, Sie persönlich kennen zu lernen!';
    const phase3_pre1           = 'Der Wunsch, den Sie im Test als am wichtigsten bewertet haben ist:';
    const phase3_pre2           = 'Der Wunsch, den Sie im Test als am Zweitwichtigsten bewertet haben ist:';
    const phase3_pre3           = 'Der Wunsch, den Sie im Test als am Dritttwichtigsten bewertet haben ist:';

	const phase3_pre1img           = '<img style="border: 0px solid #bbb;" src="/images/thumbnails 3 Videos 1 Test.png" height="200" width="355">';
	const phase3_pre2img           = '<img style="border: 0px solid #bbb;" src="/images/thumbnails 3 Videos 2 Test.png" height="200" width="355">';
	const phase3_pre3img           = '<img style="border: 0px solid #bbb;" src="/images/thumbnails 3 Videos 3 Test.png" height="200" width="355">';




    // Standard prize formatting function
    static public function Preis($userid = 0)
    {
        global $db;
        $sql = "SELECT preis FROM " . ($userid ? "bft_users WHERE userid=$userid" : "bft_groups WHERE groupid=1");
        if (!$result = $db->query($sql)) {
            die(sprintf(BFT_Lang::error, $db->errno, $db->error));
        }
        $row = $result->fetch_assoc();
        $result->close();
        return number_format($row['preis'] / 100, 2, ',', '.') . " Euro";
    }
}
?>