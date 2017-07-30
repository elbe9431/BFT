<?php
/**
 * Berufsfindungstest :: Template Kennwort eingeben
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<div class="text-box">
    <p>Um Test 2, Berufswahl, durchführen zu können, müssen Sie zuerst Test 1, Berufsinteressen, durchlaufen haben. Am Ende vonTest 1 haben Sie per Mail – und angezeigt am Bildschirm - ein Kennwort erhalten.</p>
    <p>Bitte geben Sie nun Ihr Kennwort aus Test 1 ein.</p>
    <p>Falls Sie Test 2, Berufswahl, unterbrochen haben können Sie mit der Eingabe des Kennwortes den Test weiterführen.</p>
    <div class="bottom1">
        <label for="<?php echo BFT_USERNAME; ?>"><?php if ($this->modus == 1) echo 'Kennwort'; else echo 'Kennwort'; ?></label>
        <input class="input" type="text" value="<?php if (isset($this->anmeldung[BFT_USERNAME])) echo $this->anmeldung[BFT_USERNAME]; ?>" id="<?php echo BFT_USERNAME; ?>" name="<?php echo BFT_USERNAME; ?>" />
        <?php if (isset($this->error) and $this->error): ?>
            <p class="error"><?php echo $this->error; ?></p>
        <?php endif; ?>
    </div>
</div>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
<input class="submit orange" type="submit" name="<?php echo BFT_CANCEL; ?>" value="<?php echo BFT_Lang::button_cancel; ?>" />
