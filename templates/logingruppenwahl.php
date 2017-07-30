<?php
/**
 * Berufsfindungstest :: Template Login Choose group
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<h3 class="bottom2">Bitte wählen Sie eine der drei Möglichkeiten aus:</h3>
<div class="bottom2">
    <input type="radio" name="<?php echo BFT_GRUPPE; ?>" value="schule" id="schule" />
    <label class="auswahl" for="schule">Ich nehme am Test im Rahmen einer <strong>schulischen Veranstaltung</strong> zur Berufsberatung teil. Hierfür habe ich eine Zugangsnummer erhalten.</label>
</div>
<div class="bottom2">
    <input type="radio" name="<?php echo BFT_GRUPPE; ?>" value="beratung" id="beratung" />
    <label class="auswahl" for="beratung">Ich habe mit der Psychodiagnostischen Beratungspraxis eine <strong>Berufsberatung in Hamburg</strong> vereinbart und eine Zugangsnummer erhalten. Das Testergebnis soll mit den Berufsberatern besprochen werden.</label>
</div>
<div class="bottom2">
    <input type="radio" name="<?php echo BFT_GRUPPE; ?>" value="keine" id="keine" />
    <label class="auswahl" for="keine">Ich will <strong>einfach nur den Test machen</strong>. <em>Modul 1 - Berufsinteressen</em> werde ich kostenlos nutzen können. Ich werde dann entscheiden, ob ich <em>Modul 2 - Berufswahl</em> gegen Honorar von 15,00 Euro buchen will.</label>
</div>
<?php if ($this->error): ?>
    <div class="error bottom2">Bitte treffen Sie eine Auswahl!</div>
<?php endif; ?>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
