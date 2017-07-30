<?php
/**
 * Berufsfindungstest :: Template Login Hauptmenü
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

/*    <p><?php echo BFT_Lang::menu_info; ?></p>
    <input class="link" type="submit" name="<?php echo BFT_WEISSNICHT; ?>" value="Mehr Infos" />*/

?>
<h2>Was möchten Sie als nächstes tun?</h2>
<div class="box-modul1">
    <?php if ($this->p1 == 0): ?>
        <h3>Test 1 - Berufsinteressen</h3>
        <p><?php echo BFT_Lang::menu_p1_neu; ?></p>
        <input class="submit" type="submit" name="<?php echo BFT_P1_START; ?>" value="Test 1 Starten" />
    <?php elseif ($this->p1 < 8): ?>
        <h3>Test 1 - Berufsinteressen</h3>
        <p><?php echo BFT_Lang::menu_p1_fortsetzen; ?></p>
        <input class="submit" type="submit" name="<?php echo BFT_P1_FORTS; ?>" value="Test 1 Fortsetzen" />
    <?php elseif ($this->p2 == 0 and $this->bez == 0 and $this->buchen == 1): ?>
        <h3>Tool "Lösungen finden"</h3>
        <p><?php echo BFT_Lang::menu_p2_buchen; ?></p>
        <a class="buttonlink" href ="http://www.berufsziele.de/anmeldeformularSchule.php" target="_blank">Anmeldeinfos</a>
    <?php elseif ($this->p2 == 0 and $this->bez == 0 and $this->bezart == 4): ?>
        <h3>Tool "Lösungen finden"</h3>
        <p><?php echo BFT_Lang::menu_p2_bezueberw; ?></p>
        <input class="submit" type="submit" name="<?php echo BFT_P2_BEZ; ?>" value="Test 2 Buchen" />
    <?php elseif ($this->p2 == 0 and $this->bez == 0): ?>
        <h3>Auf zu Tool "Lösungen finden!"</h3>
        <p><?php echo sprintf(BFT_Lang::menu_p2_bez, BFT_Lang::Preis($this->userid)); ?></p>
    <?php //geändert 11.02.13 von Test 2 Starten -> Test 2 ?>    
        <input class="submit" type="submit" name="<?php echo BFT_P2_BEZ; ?>" value="Lösungen finden" />
    <?php elseif ($this->p2 == 0): ?>
        <h3>Tool "Lösungen finden"</h3>
        <p><?php echo BFT_Lang::menu_p2_neu; ?></p>        
        <input class="submit" type="submit" name="<?php echo BFT_P2_START; ?>" value="Tool Starten" />
    <?php elseif ($this->p2 == 4): ?>
        <h3>Tool "Lösungen finden"</h3>
        <p><?php echo BFT_Lang::menu_p2_fortsetzen; ?></p>
        <input class="submit" type="submit" name="<?php echo BFT_P2_FORTS; ?>" value="Lösungen finden" />
    <?php elseif ($this->ergebnis > 0): ?>
        <h3>Testende</h3>
        <p><?php echo BFT_Lang::menu_testendemiterg; ?></p>
        <input class="submit" type="submit" name="<?php echo BFT_CANCEL; ?>" value="Abmelden" />
    <?php else: ?>
        <h3>Testende</h3>
        <p><?php echo BFT_Lang::menu_testendeohneerg; ?></p>
        <input class="submit" type="submit" name="<?php echo BFT_CANCEL; ?>" value="Abmelden" />
    <?php endif; ?>
</div>

<div class="box-modul2">
    <h3>Weitere Optionen</h3>
    <p><?php echo BFT_Lang::menu_info; ?></p>
    <input class="link" type="submit" name="<?php echo BFT_PREVIEW; ?>" value="Preview" />
    <p></p><br><p><?php echo BFT_Lang::menu_beenden; ?></p>
    <br> 

<style>

.submit1 {
    margin-right: 1em;
    width: 11em;
    height: 2.6em;
    line-height: 2.6;
    color: #fff;
    font-weight: bold;
    text-shadow: 0 1px 2px #131;
    background: #4d7e03 url("../../paartherapietest/images/button.png") repeat-x 0 0;
    cursor: pointer;
    border: 1px solid #4d7e03;
    -webkit-border-radius: 2em;
    -moz-border-radius: 2em;
    border-radius: 2em;
text-align: center;
margin-top: 20px;
}
</style>
<center>
<input class="submit" type="submit" name="BFT_TEST_END" value="Testende" />
<!--<a href="http://www.berufsziele.de/"><input href="http://www.berufsziele.de/" class="submit1" type="text" value="Test beenden" /></a>-->


</div>
