<?php
/**
 * Berufsfindungstest :: Template homepage
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
 <?php require("includes/videoHead.inc.php");?>	
<?php require("includes/video.inc.php");?>
<div id="wrapper">
    <div id="header">
        <div class="berufsziele-logo">
            <img src="images/pdb-logo.png" title="Psychodiagnostische Beratungspraxis"/>
        </div>
        <div class="berufsziele-text">
            <p>Psychodiagnostische<br />Beratungspraxis</p>
            <p>Hamburg - bundesweit - weltweit<br />Diplom-Psychologen</p>
        </div>
        <div class="bft-logo">
            <img src="images/bft-logo.png" title="Berufswahl Logo"/>
        </div>
        <div class="bft-text">
            <h1>Hamburger Paartherapie-Test</h1>
            <h2>Paartherapie und Paarentwicklung - online - kostenlos</h2>
        </div>
    </div>
    <div id="nav">
        <ul>
            <li><a href="http://www.paartherapietest.eu/"<?php if ($this->subpage == "index"): ?> class="active"<?php endif; ?>>Home</a></li>
            <li><a href="about"<?php if ($this->subpage == "about"): ?> class="active"<?php endif; ?>>Über uns</a></li>
            <li><a href="preview"<?php if ($this->subpage == "preview"): ?> class="active"<?php endif; ?>>Test-Vorschau</a></li>
            <li><a href="fragen"<?php if ($this->subpage == "fragen"): ?> class="active"<?php endif; ?>>Fragen?</a></li>
            <li><a href="kontakt"<?php if ($this->subpage == "kontakt"): ?> class="active"<?php endif; ?>>Kontakt</a></li>
            <li><a href="videos"<?php if ($this->subpage == "videos"): ?> class="active"<?php endif; ?>>Videos</a></li>
            <li><a href="service"<?php if ($this->subpage == "service"): ?> class="active"<?php endif; ?>>Paartherapie</a></li>
                </ul>
    </div>
    <div id="main">
        <div id="content">
            <div id="sidebar">
                <h3>Direkt Starten!</h3>
                               
                <p> Mit dem Hamburger Paartherapie-Test anonym, 
				<strong>auch ohne den Partner</strong>:<br><br>

…in 15 Minuten <strong>„Wünsche klären“</strong> und <strong>kostenlos</strong> erste Tipps dazu erhalten.<br><br>

<a class="button green" href="test?id=newTestOrContinueTest" title="Start Selbsttest 'Wünsche klären'">Start Selbsttest Wünsche klären</a>
</p>
<p>... dann in 30 Minuten vertieft und passgenau <strong>"Lösungen finden"</strong></p>

<a class="button green" href="test?id=newTestOrContinueTest" title="Start Tool 'Lösungen finden'">Start Tool <br> Lösungen finden</a>

<p class="group">Gesamttest nur für Klienten mit Freischaltcode...</p>

                <a class="button orange" href="test?id=newTestOrContinueTest" title="Teststart für Gruppen">Teststart nur für Gruppen</a>

                
                <p class="group"></p>
                 <img src="images/Testentwickler EnnoHeyken, SarahHaupt.jpg" title="Das Team" alt="Das Team" />
                 <p style="text-align:center">Das Entwickler-Team für den Hamburger Paartherapie-Test: Diplom-Psychologe Enno Heyken und Master-Psychologin Sarah Haupt.</p>                        
            </div>
            <?php require_once "templates/".$this->subpage.".php"; ?>
            <div id="clear"></div>
        </div>
    </div>
</div>
