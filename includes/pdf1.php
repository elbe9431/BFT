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

class BFT_PDF1 extends FPDF
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
        $this->Cell(0, 10, 'Hamburger Paartherapiestest, Test 1 - Wünsche klären', 'LTR', 1, 'C');
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

    // Tabelle 1
    function Table1($data, $berufsfelder, $berufswege)
    {
        $this->SetFont('Arial', 'B' ,12);
        $this->Cell(0, 10, '1) Rangliste der Berufsfelder');
        $this->Ln();
        $this->SetFont('Arial', '' ,11);
        $this->Cell(15, 6, 'Platz', 1, 0, 'C', 1);
        $this->Cell(156, 6, 'Themenfeld', 1, 0, 'C', 1);
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
        $this->Ln(6);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Sie konnten beim Test Wünsche klären aus 13 Themenfeldern diejenigen auswählen, für die Sie sich besonders interessieren. Anschließend haben Sie Wünsche aus den einzelnen Themenfeldern miteinander verglichen.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('In der obenstehenden Tabelle sehen Sie, aus welchen Themenfeldern Sie die betreffenden Wünsche häufig und bevorzugt ausgewählt haben.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Damit Sie schon jetzt erste Anregungen für Ihre Selbstklärung bekommen, erhalten Sie nachfolgend zwei Tabellen als Zwischenergebnis der Hamburger Paartherapietests. Es sind diejenigen handlungsbezogenen und eher auf Einstellungen bezogenen Wünsche, die Sie beim Test 1, Wünsche klären, bevorzugt haben. Aussagefähige Ergebnisse bietet das Tool Lösungen finden.'));
        $this->Ln(3);
    }

    // Tabelle 2
    function Table2($data, $berufsfelder, $berufswege)
    {
        $this->SetFont('Arial', 'B' ,12);
        $this->Cell(0, 10, utf8_decode('2) Einige eher handlungsorientierte Wünsche'));
        $this->Ln();
        $this->SetFont('Arial', '' ,11);
        $this->Cell(93, 6, 'Studiengang', 1, 0, 'C', 1);
        $this->Cell(0, 6, utf8_decode('Gehört zu Berufsfeld'), 1, 0, 'C', 1);
        $this->Ln();
        $i = 1;
        foreach ($data['s'] as $key => $val) {
            $x = $this->GetX();
            $y = $this->GetY();
            $bwname = utf8_decode($berufswege[$val]['bwname']);
            $bfname = utf8_decode($berufsfelder[$berufswege[$val]['bfid']]['bfname']);
            $bwname_width = $this->GetStringWidth($bwname);
            $bfname_width = $this->GetStringWidth($bfname);
            $h = ($bwname_width > 93 or $bfname_width > 93) ? 12 : 6;
            if ($bwname_width > 93) $this->MultiCell(93, 6, $bwname, 1, 'L');
            else $this->Cell(93, $h, $bwname, 1);
            $this->SetXY($x + 93, $y);
            if ($bfname_width > 93) $this->MultiCell(0, 6, $bfname, 1, 'L');
            else $this->Cell(0, $h, $bfname, 1);
            $this->Ln();
        }
    }

    // Tabelle 3
    function Table3($data, $berufsfelder, $berufswege)
    {
        $this->SetFont('Arial', 'B' ,12);
        $this->Cell(0, 10, utf8_decode('3) Einige Wünsche, die auf Einstellungen bezogen sind'));
        $this->Ln();
        $this->SetFont('Arial', '' ,11);
        $this->Cell(93, 6, 'Ausbildungsgang', 1, 0, 'C', 1);
        $this->Cell(0, 6, utf8_decode('Gehört zu Berufsfeld'), 1, 0, 'C', 1);
        $this->Ln();
        $i = 1;
        foreach ($data['a'] as $key => $val) {
            $x = $this->GetX();
            $y = $this->GetY();
            $bwname = utf8_decode($berufswege[$val]['bwname']);
            $bfname = utf8_decode($berufsfelder[$berufswege[$val]['bfid']]['bfname']);
            $bwname_width = $this->GetStringWidth($bwname);
            $bfname_width = $this->GetStringWidth($bfname);
            $h = ($bwname_width > 93 or $bfname_width > 93) ? 12 : 6;
            if ($bwname_width > 93) $this->MultiCell(93, 6, $bwname, 1, 'L');
            else $this->Cell(93, $h, $bwname, 1);
            $this->SetXY($x + 93, $y);
            if ($bfname_width > 93) $this->MultiCell(0, 6, $bfname, 1, 'L');
            else $this->Cell(0, $h, $bfname, 1);
            $this->Ln();
			
			
        }
		$this->MultiCell(0, 6, utf8_decode('')); 
  $this->MultiCell(0, 6, utf8_decode('Wenn Sie sich jetzt mit Ihren Wünschen und dazugehörigen Lösungsideen genauer auseinander setzen möchten, dann starten Sie bitte Test 2, Lösungen finden. Zugang siehe folgende Seite dieser PDF.')); 
 }
  
    
    // Was jetzt?
    function Hinweise($userid, $username)
    {
        $this->SetFont('Arial', 'B' ,14);
        $this->Cell(0, 10, utf8_decode('Was jetzt?'), 0, 0, 'C');
        $this->Ln(15);
        $this->SetFont('Arial', '' ,11);
        $this->MultiCell(0, 6, utf8_decode('Diese Listen sind nicht das Endergebnis der Hamburger Berufsfindungstests.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Die genannten Ausbildungen und Studiengänge sind nur als erste Anregungen zu verstehen.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Erst wenn Sie auch Test 2, Berufswahl - durchlaufen haben, erhalten Sie ein wirklich aussagekräftiges Ergebnis: Eine Liste mit den Top 10 Ihrer beruflichen Interessen - in der von Ihnen erarbeiteten Reihenfolge.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode(sprintf('Im Test 2 beschäftigen Sie sich mit den 30 Berufen, die beim Test Berufsinteressen am besten von Ihnen bewertet wurden. Sie bringen diese Berufe in eine konkrete Reihenfolge - und erhalten viele zusätzliche Informationen und Einschätzungen, während Sie den Test durchlaufen. Die Teilnahmegebühr beträgt %s.', BFT_Lang::Preis($userid))));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Und so starten Sie den Test Berufswahl:'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('- Auf www.paartherapietest.eu gehen.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('- Start Berufswahl klicken.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode(sprintf('Ihren persönlichen Zugangscode eingeben: %s', $username)));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('... und noch ein Tipp: Wenn Sie sich wirklich umfassend mit Ihrer Berufswahl auseinander setzen wollen, dann kommen Sie doch für einen ganzen Tag in unsere Praxis - einen Tag, bei dem es nur um Sie und Ihre berufliche Zukunft geht. Nähere Infos erhalten Sie unter www.berufsziele.de'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Oder rufen Sie uns doch einfach an, um genaueres zu besprechen: 040 65993820.'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Egal, wie Ihre nächsten Schritte nun aussehen: Wir wünschen Ihnen viel Glück bei Ihrer Berufswahl!'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Mit besten Grüßen'));
        $this->Ln(3);
        $this->MultiCell(0, 6, utf8_decode('Enno Heyken, Diplom-Psychologe'));
		$this->Ln(5);
		$this->MultiCell(0, 6, utf8_decode('Psychodiagnostische Beratungspraxis'));
		$this->MultiCell(0, 6, utf8_decode('Wandsbeker Königstr. 11'));
		$this->MultiCell(0, 6, utf8_decode('22041 Hamburg'));
		$this->MultiCell(0, 6, utf8_decode('www.berufsziele.de * berufsziele@aol.com'));
		$this->MultiCell(0, 6, utf8_decode('Tel.:040 65993820'));
    }
}
?>