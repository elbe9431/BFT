<?php
/**
 * Berufsfindungstest :: Ergebnis als Pdf erzeugen
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

define('FPDF_FONTPATH', BFT_PATH_BASE.DS.'fpdf'.DS.'font'.DS);
require_once BFT_PATH_BASE.DS.'fpdf'.DS.'fpdf.php';

class BFT_PDF extends FPDF
{
    private $email = '';
	
	// Konstruktor
	function __construct($email)
    {
		parent::__construct("P", "mm", "A4");
		$this->email = $email;
	   	$this->SetDisplayMode(100);
        $this->SetFillColor(220, 220, 220);
	}	

    // Kopfzeile
    function Header()
    {
        $this->SetFont('Arial', 'B' ,15);
        $this->Cell(0, 10, utf8_decode('Hamburger Paartherapietest, Wünsche klären und Lösungen suchen'), 'LTR', 1, 'C');
        $this->SetFont('Arial', '' ,11);
        $this->Cell(0, 10, utf8_decode('Ergebnisse für ' . $this->email), 'LBR', 0, 'C');
        $this->Ln(20);
    }

    // Fusszeile
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Seite ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Tabelle 0
    function Table0($data, $berufsfelder, $berufswege)
    {
        $this->SetFont('Arial', 'B' ,12);
        $this->Cell(0, 10, '1) Rangliste der Themenfelder');
        $this->Ln();
        $this->SetFont('Arial', '' ,11);
        $this->Cell(15, 6, 'Platz', 1, 0, 'C', 1);
        $this->Cell(156, 6, 'Themenfelder', 1, 0, 'C', 1);
        $this->Cell(0, 6, 'Prozent', 1, 0, 'C', 1);
        $this->Ln();
        $i = 1;
        foreach ($data as $key => $val) {
            $x = $this->GetX();
            $y = $this->GetY();
            $bfname = utf8_decode($berufsfelder[$key]['bfname']);
            $this->Cell(15, 6, $i++, 1, 0, 'C');
            $this->Cell(156, 6, $bfname, 1);
            $this->SetXY($x + 171, $y);
            $this->Cell(0, 6, round($val), 1, 0, 'C');
            $this->Ln();
        }
    }
    
    // Tabelle 1
    function Table1($data, $berufsfelder, $berufswege)
    {
        $this->SetFont('Arial', 'B' ,12);
        $this->Cell(0, 10, utf8_decode('2) Rangliste Top 10 Ihrer Wünsche'));
        $this->Ln();
        $this->SetFont('Arial', '' ,11);
        $this->Cell(15, 6, 'Platz', 1, 0, 'C', 1);
        $this->Cell(63, 6, 'Wunsch', 1, 0, 'C', 1);
        $this->Cell(30, 6, 'Art', 1, 0, 'C', 1);
        $this->Cell(63, 6, 'Themenfeld', 1, 0, 'C', 1);
        $this->Cell(0, 6, 'Prozent', 1, 0, 'C', 1);
        $this->Ln();
        $i = 1;
        foreach ($data as $key => $val) {
            $x = $this->GetX();
            $y = $this->GetY();
            $bwname = utf8_decode($berufswege[$key]['bwname']);
            $bfname = utf8_decode($berufsfelder[$berufswege[$key]['bfid']]['bfname']);
            $bwname_width = $this->GetStringWidth($bwname);
            $bfname_width = $this->GetStringWidth($bfname);
            $h = ($bwname_width > 63 or $bfname_width > 63) ? 12 : 6;
            $this->Cell(15, $h, $i++, 1, 0, 'C');
            if ($bwname_width > 63) $this->MultiCell(63, 6, $bwname, 1, 'L');
            else $this->Cell(63, $h, $bwname, 1);
            $this->SetXY($x + 78, $y);
            $this->Cell(30, $h, ($berufswege[$key]['bwtyp'] == 's') ? 'Handeln' : utf8_decode('Einstellung'), 1);
            if ($bfname_width > 63) $this->MultiCell(63, 6, $bfname, 1, 'L');
            else $this->Cell(63, $h, $bfname, 1);
            $this->SetXY($x + 171, $y);
            $this->Cell(0, $h, min(100, round($val / BFT_Config::max_punkte * 100)), 1, 0, 'C');
            $this->Ln();
        }
    }

    // Tabelle 2
    function Table2($data, $berufsfelder, $berufswege)
    {
        $this->SetFont('Arial', 'B' ,12);
        $this->Cell(0, 10, utf8_decode('3) Rangliste Top 10 Handlungsorientierte Wünsche'));
        $this->Ln();
        $this->SetFont('Arial', '' ,11);
        $this->Cell(15, 6, 'Platz', 1, 0, 'C', 1);
        $this->Cell(78, 6, 'Handlungsorientierter Wunsch', 1, 0, 'C', 1);
        $this->Cell(78, 6, 'Themenfeld', 1, 0, 'C', 1);
        $this->Cell(0, 6, 'Prozent', 1, 0, 'C', 1);
        $this->Ln();
        $i = 1;
        foreach ($data as $key => $val) {
            $x = $this->GetX();
            $y = $this->GetY();
            $bwname = utf8_decode($berufswege[$key]['bwname']);
            $bfname = utf8_decode($berufsfelder[$berufswege[$key]['bfid']]['bfname']);
            $bwname_width = $this->GetStringWidth($bwname);
            $bfname_width = $this->GetStringWidth($bfname);
            $h = ($bwname_width > 78 or $bfname_width > 78) ? 12 : 6;
            $this->Cell(15, $h, $i++, 1, 0, 'C');
            if ($bwname_width > 78) $this->MultiCell(78, 6, $bwname, 1, 'L');
            else $this->Cell(78, $h, $bwname, 1);
            $this->SetXY($x + 93, $y);
            if ($bfname_width > 78) $this->MultiCell(78, 6, $bfname, 1, 'L');
            else $this->Cell(78, $h, $bfname, 1);
            $this->SetXY($x + 171, $y);
            $this->Cell(0, $h, min(100, round($val / BFT_Config::max_punkte * 100)), 1, 0, 'C');
            $this->Ln();
        }
    }

    // Tabelle 3
    function Table3($data, $berufsfelder, $berufswege)
    {
        $this->SetFont('Arial', 'B' ,12);
        $this->Cell(0, 10, utf8_decode('4) Rangliste Top 10 Wünsche, welche eher Einstellungen betreffen'));
        $this->Ln();
        $this->SetFont('Arial', '' ,11);
        $this->Cell(15, 6, 'Platz', 1, 0, 'C', 1);
        $this->Cell(78, 6, utf8_decode('Wunsch Bereich Einstellungen'), 1, 0, 'C', 1);
        $this->Cell(78, 6, 'Themenfeld', 1, 0, 'C', 1);
        $this->Cell(0, 6, 'Prozent', 1, 0, 'C', 1);
        $this->Ln();
        $i = 1;
        foreach ($data as $key => $val) {
            $x = $this->GetX();
            $y = $this->GetY();
            $bwname = utf8_decode($berufswege[$key]['bwname']);
            $bfname = utf8_decode($berufsfelder[$berufswege[$key]['bfid']]['bfname']);
            $bwname_width = $this->GetStringWidth($bwname);
            $bfname_width = $this->GetStringWidth($bfname);
            $h = ($bwname_width > 78 or $bfname_width > 78) ? 12 : 6;
            $this->Cell(15, $h, $i++, 1, 0, 'C');
            if ($bwname_width > 78) $this->MultiCell(78, 6, $bwname, 1, 'L');
            else $this->Cell(78, $h, $bwname, 1);
            $this->SetXY($x + 93, $y);
            if ($bfname_width > 78) $this->MultiCell(78, 6, $bfname, 1, 'L');
            else $this->Cell(78, $h, $bfname, 1);
            $this->SetXY($x + 171, $y);
            $this->Cell(0, $h, min(100, round($val / BFT_Config::max_punkte * 100)), 1, 0, 'C');
            $this->Ln();
        }
    }
    
    // Was jetzt?
    function Hinweise()
    {
        $this->SetFont('Arial', 'B' ,14);
        $this->Cell(0, 10, utf8_decode('Was jetzt?'), 0, 0, 'C');
        $this->Ln(15);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Sie haben nun die beiden Hamburger Berufsfindungstests beendet und eine Liste von möglichen Ausbildungs- und Studiengängen erhalten, die Sie selbst im Rahmen des Tests als interessant und erwägenswert bewertet haben.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Wir hoffen sehr, dass Ihnen der Test bereits einen guten Schritt weitergeholfen hat - durch neue Ideen, eine erste Orientierung oder die Neubewertung von alten Ideen.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Wie kann es jetzt weitergehen? Da gibt es viele Möglichkeiten. Auch hier unser Rat: Entscheiden Sie selbst, was für Sie der beste nächste Schritt sein kann.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Wir geben Ihnen dazu ein paar Anregungen und ein paar hilfreiche Links.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Folgende Schritte könnten Sie überlegen:'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, '1.');
        $this->MultiCell(0, 6, utf8_decode('Berufsberatung nutzen'));
        $this->Cell(4);
        $this->Cell(6, 6, '2.');
        $this->MultiCell(0, 6, utf8_decode('Zusätzliche Online-Infos zu den Berufen einholen'));
        $this->Cell(4);
        $this->Cell(6, 6, '3.');
        $this->MultiCell(0, 6, utf8_decode('Mit den Eltern und/oder dem Partner sprechen'));
        $this->Cell(4);
        $this->Cell(6, 6, '4.');
        $this->MultiCell(0, 6, utf8_decode('Beziehungen nutzen'));
        $this->Cell(4);
        $this->Cell(6, 6, '5.');
        $this->MultiCell(0, 6, utf8_decode('Erfahrungen machen'));
        $this->Cell(4);
        $this->Cell(6, 6, '6.');
        $this->MultiCell(0, 6, utf8_decode('Die Zugangsmöglichkeiten und Fristen klären.'));
        $this->Cell(4);
        $this->Cell(6, 6, '7.');
        $this->MultiCell(0, 6, utf8_decode('Welche Uni? Welcher Ausbildungsplatz?'));
        $this->Cell(4);
        $this->Cell(6, 6, '8.');
        $this->MultiCell(0, 6, utf8_decode('Lebensplan durchdenken '));
        $this->Ln(10);
        $this->SetFont('Arial', 'B' ,13);
        $this->MultiCell(0, 6, utf8_decode('1. Berufsberatung nutzen'), 0, '', 1);
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Kein Testverfahren der Welt kann eine fundierte Berufsberatung ersetzen. Entscheidend ist dabei die richtige Kombination: Ein erfahrender Berufsberater, der auf der Grundlage wissenschaftlicher Testverfahren genügend Zeit mit Ihnen verbringt um gemeinsam mit Ihnen gute Berufswege zu erarbeiten. Der große Vorteil eines solchen Vorgehens:'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Der Berater kann ganzheitlich die verschiedenen Aspekte mit berücksichtigen, Ihre Persönlichkeit, Ihre Wünsche, Ihr familiäres Umfeld, Ihre Lebenssituation, Ihre Stärken, Schwächen und Erfahrungen.Das Ergebnis sollte möglichst in Form eines persönlichen Gutachtens (nicht in Form eines automatisch erstellten Schriftsatzes) festgehalten werden.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Die PDB bietet seit über 20 Jahren ganztägige Beratungsformen an. Wir glauben, dass die Berufswahl eine so wichtige Entscheidung ist, dass es lohnt, dafür einen ganzen Beratungstag in Anspruch zu nehmen. Informieren Sie sich gern.'));
        $this->Ln(3);
		$this->SetFont('Arial', 'B' ,14);
        $this->MultiCell(0, 6, utf8_decode('Link: www.paarentwicklung.de - oder rufen Sie uns einfach an: 040 65993820!'));
        $this->Ln(10);
        $this->SetFont('Arial', 'B' ,13);
        $this->MultiCell(0, 6, utf8_decode('2. Zusätzliche Online-Infos zu den Berufen einholen'), 0, '', 1);
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Sie sitzen ja gerade am Computer. Schauen Sie doch mal bei den Portalen vorbei, die zu den verschiedenen Studiengängen und Ausbildungsgängen zusätzliche Infos bieten. Beschreibungen der Ausbildungsinhalte, der Zugangsvoraussetzungen oder der beruflichen Tätigkeit im Alltag - es macht Sinn, sich zu informieren.'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Das folgende Portal der Agentur für Arbeit bietet für beides, für Ausbildungen und für Studiengänge, umfangreiche Informationen:'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Link: www.berufenet.arbeitsagentur.de/berufe'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Oder auf eigene Faust: '));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Link: www.google.de und dann z.B.: Physik Studium Berlin oder Industriekaufmann Ausbildung Bremen eingeben.'));
        $this->Ln(3);
        $this->SetFont('Arial', 'BI' ,12);
        $this->MultiCell(0, 6, utf8_decode('2.1 zusätzliche Infos im Internet speziell zu Berufsausbildungen'));
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Speziell zu Ausbildungsberufen weisen wir auf zwei weitere Portale  hin.'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Liste der Ausbildungsberufe vom Bundesministerium für Wirtschaft und Technologie.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Link: http://www.bmwi.de/BMWi/Navigation/Ausbildung-und-Beruf/ausbildungsberufe.de'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Und ein interessantes Portal der Bundesagentur für Arbeit für Cineasten - Kurzfilme zu vielen Ausbildungsberufen, kleine Clips aus dem Arbeitsalltag:'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Link: http://www.berufe.tv/BA/'));
        $this->Ln(3);
        $this->SetFont('Arial', 'BI' ,12);
        $this->MultiCell(0, 6, utf8_decode('2.2 zusätzliche Infos im Internet zu den Studiengängen'));
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Wer zusätzliche Informationen zu bestimmten Studiengänge sucht, kann das nachfolgende Portal nutzen.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Link: www.studienwahl.de (Bundesagentur für Arbeit)'));
        $this->Ln(10);
        $this->SetFont('Arial', 'B' ,13);
        $this->MultiCell(0, 6, utf8_decode('3. Mit den Eltern und/oder dem Partner sprechen'), 0, '', 1);
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Wir glauben, dass die Entscheidung für einen Berufsweg im Wesentlichen eine eigenständige sein sollte. Sie selbst sind verantwortlich dafür, sich ausreichend zu informieren. Und Sie sind ebenso dafür verantwortlich, in der Ausbildung oder dem Studium den Lerneifer an den Tag zu legen, der notwendig ist.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Andererseits: Die Eltern oder auch der Lebenspartner sind wichtige Gesprächspartner, wenn es um die Realisierbarkeit von Berufswegen geht.'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Staatliche Universität oder vielleicht doch eine Privatuni? Inland oder Ausland? Wie kann ich meinen Berufsweg finanzieren? Wie wichtig ist es, in absehbarer Zeit stabiles Geld zu verdienen?'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Unser Rat: Im Zweifel sprechen Sie offen. Und fragen Sie, was unterstützt wird - und was nicht. Manchmal sagen junge Leute zu uns: "Ich will meine Eltern lieber nicht fragen, ob Sie mir eine Privatuni finanzieren würden. Sie haben schon so viel für uns Kinder bezahlt!"'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Wir raten: Erzählen Sie im Zweifel erst mal von den verschiedenen Möglichkeiten, die Sie im Kopf haben. Ihre Eltern sind erwachsen. Sie werden Ihnen schon sagen, was Sie wie unterstützen wollen - und was nicht.'));
        $this->Ln(10);
        $this->SetFont('Arial', 'B' ,13);
        $this->MultiCell(0, 6, utf8_decode('4. Beziehungen nutzen'), 0, '', 1);
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Wer seine Beziehungen nicht nutzt, handelt nicht edel sondern töricht. Menschen helfen anderen Menschen in der Regel gern. Und gerade denen, die wir schon persönlich kennen gelernt haben helfen wir besonders gern.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Sie haben gar keine Beziehungen zu Menschen, die Ihnen bei der Berufswahl helfen können? '));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Wetten, dass doch!?'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Das wäre eine weniger kluge Frage z.B. an einen Onkel, eine Tante oder einen Bekannten: "Sag mal, was machst Du eigentlich beruflich? Kannst Du mir vielleicht einen Praktikumsplatz in der Medienbranche vermitteln?"'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('So wäre es schlauer: "Ich hab ja schon mal erzählt, dass ich vielleicht in die Medienbranche will. Jetzt ist es soweit, dass ich unbedingt ein Praktikum brauche, sonst habe ich da keine Chance. Sag mal, kennst Du jemanden, der vielleicht jemanden kennt, der irgendwo in der Medienbranche arbeitet? Jeder Hinweis könnte mir nützen!"'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Gehen Sie auf alle los, die sie kennen. Emails, SMS, Anrufe. Sportverein, Schulfreunde, Familie, Bekannte, Facebook - geben Sie Vollgas! Jeder den Sie kennen kann erfahren, dass sie gerade einen Praktikumsplatz suchen, oder einen Ausbildungsplatz, oder einen Gesprächspartner über den Arbeitsalltag als Buchhändlerin oder was auch immer. Netzwerken Sie! '));
        $this->Ln(10);
        $this->SetFont('Arial', 'B' ,13);
        $this->MultiCell(0, 6, utf8_decode('5. Erfahrungen machen'), 0, '', 1);
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Nur zu Hause am Computer sitzen bringt es nicht. Physik oder Chemie? Reiseverkehrskauffrau oder Immobilienkauffrau? O.k., gehen Sie raus ins Leben, machen Sie eine Erfahrung! Das kann ihnen besser zeigen, ob es das richtige für Sie ist als wochenlanges Grübeln daheim. 3 Möglichkeiten:'));
        $this->Ln(3);
        $this->SetFont('Arial', 'BI' ,12);
        $this->MultiCell(0, 6, utf8_decode('5.1 Probevorlesung'));
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Schauen Sie online ins Vorlesungsverzeichnis der Universität Ihrer Wahl. Und suchen Sie sich eine Vorlesung für Erstsemester aus. Und dann: '));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Keine Scheu, gucken Sie sich die Uni ruhig mal an! In der Regel ist es durchaus möglich, an einer Vorlesung teilzunehmen. Und sich umzugucken. '));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Was sind das da für Studenten? Fühl ich mich hier richtig? Und wie gefällt mir die Vorlesung?'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Auch wenn Sie eine Uni in einer anderen Stadt erwägen ist es eine gute Idee: Hinfahren, ausprobieren, mal in die Studentenberatung oder eine Vorlesung gehen, Uniluft schnuppern! Und dann schauen: Bin ich hier richtig?	 '));
        $this->Ln(3);
        $this->SetFont('Arial', 'BI' ,12);
        $this->MultiCell(0, 6, utf8_decode('5.2 Praktikum'));
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Fast jeder, der sich mit Berufsberatung beschäftigt kommt zu dem Schluss: Praktika sind für die Berufsfindung Gold wert. Die Begründung ist einfach: Grau ist alle Theorie. Im Praktikum sehen Sie, wie es wirklich zu gehen kann im Berufsfeld Ihrer Wahl.  Es dürfen gern mehrere Praktika sein. Nur - jedes einzelne davon sollte nicht irgendein Praktikum sein. '));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Die Praktika sollten genau in den Bereichen angesiedelt sein, die für die spätere Berufswahl in der engsten Wahl stehen. '));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Und sie sollten so gestaltet sein, dass Sie Einblick bekommen in den Arbeitsalltag. Erwarten Sie nicht zu viel. Vielleicht wird das Praktikum unbezahlt sein - oft werden Sie dem Betrieb ökonomisch ja nicht viel nutzen können. Es wird auch selten sein, dass Sie richtig verantwortlich handeln können - dazu fehlen Ihnen Ausbildung und Erfahrung. Was Sie erwarten können:'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Dass man Ihnen Dinge erklärt und sich Zeit für Sie nimmt.'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Dass Sie erfahren, wie der Arbeitsalltag der Beschäftigten gestaltet ist.'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Dass sie einige einfache  Arbeiten selbst unter Anleitung ausprobieren können.'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Dass sie nicht jeden Tag nur das Gleiche tun müssen.'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Dass Sie nicht nur als Boten und Kaffekocher arbeiten müssen, wenn eigentlich andere Inhalte versprochen wurden.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Überlegen Sie: Welche Berufsideen reizen Sie - sind aber noch unklar. Für einige Bereiche (z.B. Erzieher, Hotel, Krankenpflege, Medienbereich) sind Vorpraktika besonders wichtig. Sie können sogar Voraussetzung dafür sein, dass sie überhaupt einen Ausbildungsplatz erhalten können.'));
        $this->Ln(3);
        $this->SetFont('Arial', 'BI' ,12);
        $this->MultiCell(0, 6, utf8_decode('5.3 Hospitieren'));
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Hospitieren - das meint: Mal für einen Tag oder ein paar Stunden zu Gast sein um zu sehen, wie die Arbeit ist. Dabei Fragen stellen dürfen. Und am Ende schlauer wieder rausgehen als reingehen. Es muss nicht immer gleich ein Praktikum sein. Wenn Sie einen Bekannten einmal "auf der Arbeit besuchen" dürfen um zu erfahren, was er/sie da so tut - das kann auch schon viel Wert sein. '));    // Anführungszeichen geändert
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Bisweilen gilt: Frechheit siegt! Wenn Sie z.B. an einem Tag ohne viel Kundschaft in ein Reisebüro hinein marschieren und erzählen, dass Sie gerade überlegen Reiseverkehrskauffrau zu werden - dann erhalten Sie vielleicht den einen oder anderen Tip. Und können selbst ein paar Fragen loswerden.'));
        $this->Ln(10);
        $this->SetFont('Arial', 'B' ,13);
        $this->MultiCell(0, 6, utf8_decode('6. Die Zugangsmöglichkeiten und Fristen klären'), 0, '', 1);
        $this->Ln(3);
        $this->SetFont('Arial', 'BI' ,12);
        $this->MultiCell(0, 6, utf8_decode('6.1 Fristen klären'));
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Bevor Sie zu lange grübeln - klären Sie erst mal, bis wann Ihre Bewerbung vorliegen müsste - für einen Ausbildungsplatz wie für einen Studienplatz. '));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Wenden Sie sich dabei am besten direkt an den Ausbilder oder an die Fachhochschule oder Hochschule. In der Regel gibt es bestimmte Termine - jährlich oder halbjährlich - zu denen die Bewerbung vorliegen muss.'));
        $this->Ln(3);
        $this->SetFont('Arial', 'BI' ,12);
        $this->MultiCell(0, 6, utf8_decode('6.2 Zugangsmöglichkeiten klären'));
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Prüfen Sie, welchen Schulabschluss, eventuell auch welchen Notenschnitt Sie brauchen, um den Berufsweg einschlagen zu können. Das ist nicht immer exakt zu klären. So schwanken die notwendigen Notenschnitte für Studienfächer von Semester zu Semester.  '));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Neben den Noten selbst können Wartezeiten, Bewerbungsgespräche, Testverfahren oder eine Bewerbungsmappe für die Studienplatzvergabe bedeutsam sein. '));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('In vielen Fällen sind zudem unterschiedliche Zugangsvoraussetzungen von Universität zu Universität zu beachten. Ebenso von Ausbildungsplatz zu Ausbildungsplatz. '));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Eventuell kann es erforderlich oder dringend ratsam sein, ein Vorpraktikum  zu absolvieren bevor eine bestimmte Ausbildung gewählt wird - um genau damit die Bewerbungschancen zu erhöhen.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Link: http://www.hochschulstart.de (Stiftung für Hochschulzulassung, hilfreiches Portal, um Zugangsbedingungen von Studiengängen zu erkunden) '));
        $this->Ln(10);
        $this->SetFont('Arial', 'B' ,13);
        $this->MultiCell(0, 6, utf8_decode('7. Welche Uni? Welcher Ausbildungsplatz?'), 0, '', 1);
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Mit dem Berufsfindungstest haben Sie sich mit verschiedenen Ausbildungen und Studiengängen beschäftigt - und Sie können über das Internet recherchieren, wo Sie diese Ideen verwirklichen könnten. Der andere Weg ist aber auch gut: '));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Fragen Sie sich erst mal, wo Sie Ihre Ausbildung oder Ihr Studium gern durchlaufen wollen. Und informieren Sie sich dann über die Möglichkeiten vor Ort. So geben die einzelnen Universitäten in der Regel Beschreibungen Ihrer Studienfächer ins Internet.'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Aber auch das geht: Verschiedene Universitäten miteinander vergleichen. Wer bietet die besten Studienbedingungen? Das folgende Portal der Zeitschrift "Die Zeit" kann helfen:'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Link: http://ranking.zeit.de/che2010/de/?sem_mc=bmm_stud.che.zeitranking'));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Um einen konkreten Ausbildungsplatz in einer bestimmten Region zu finden, könnte das nachfolgende Portal hilfreich sein:'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Link: http://jobboerse.arbeitsagentur.de'));
        $this->Ln(10);
        $this->SetFont('Arial', 'B' ,13);
        $this->MultiCell(0, 6, utf8_decode('8. Lebensplan durchdenken '), 0, '', 1);
        $this->Ln(3);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Will ich schnell einen Ausbildungs- oder Studienplatz finden? Oder will ich vorher noch ins Ausland? Oder vielleicht ein Auslandssemester während des Studiums? '));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Vielleicht will ich erst mal noch ein paar Praktika machen? Oder ein Soziales Jahr?'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Bevor Sie sich konkret irgendwo anmelden - denken Sie einmal in Ruhe über diese Fragen nach. Und zwar nicht nur allein im stillen Kämmerlein sondern auch im Austausch mit Freunden, den Eltern, Verwandten, einem Berufsberater oder Ihrem Partner. Es gilt wie meist: Alles hat seine Vor- und Nachteile. '));
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Ein Schneller Einstieg kann Ihnen Karrierevorteile bieten. Sie verdienen dann schneller "Ihr eigenes Geld" und können sich auch eher einen späteren Wechsel erlauben, wenn es doch nicht passt.')); // Anführungszeichen geändert
        $this->Ln(3);
        $this->Cell(4);
        $this->Cell(6, 6, chr(149));
        $this->MultiCell(0, 6, utf8_decode('Andererseits: Jugend allein ist auch nicht immer das entscheidende Einstellungskriterium. Erfahrungen, im Ausland, oder bei Praktika, oder auch im sozialen Bereich - das kann Sie später interessant machen im Bewerbungsgespräch. '));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Unser Rat: Überhasten Sie nichts. Aber verlieren Sie Ihre Ziele auch nicht aus den Augen!'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Und: Viel Glück!'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Enno Heyken, Diplom-Psychologe'));
		$this->Ln(5);
		$this->MultiCell(0, 6, utf8_decode('Psychodiagnostische Beratungspraxis'));
		$this->MultiCell(0, 6, utf8_decode('Wandsbeker Königstr. 11'));
		$this->MultiCell(0, 6, utf8_decode('22041 Hamburg'));
		$this->MultiCell(0, 6, utf8_decode('www.paarentwicklung.de * berufsziele@aol.com'));
		$this->MultiCell(0, 6, utf8_decode('Tel.:040 65993820'));
    }
}
?>