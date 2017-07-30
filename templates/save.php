<?php
/**
 * Berufsfindungstest :: Save test results
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<h3>Wollen Sie Ihre Ergebnisse speichern?</h3>
<p style="width: 400px; margin: 0 auto; ">Der Name ist frei wählbar und dient dazu, dass Ihr Berufsberater Ihre Ergebnisse identifizieren kann, falls Sie eine weiterführenende Berufsberatung wünschen.</p>
<div class="savecontainer">
    <label class="save">Username:</name>
    <input class="save input" name="name" value="" maxlength="200" />
    <?php if ($this->modus == 1): ?>
        <p class="saveerror">Bitte Namen eingeben!</p>
    <?php elseif ($this->modus == 2): ?>
        <p class="saveerror">Name bereits vergeben!</p>
    <?php endif; ?>
</div>
<input class="submit" type="submit" name="speichern" value="Speichern" />
<input class="submit" type="submit" name="abbrechen" value="Weiter" />
