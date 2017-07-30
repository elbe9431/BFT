<?php
/**
 * Berufsfindungstest :: Template Login Anmeldung
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>

<?php if ($this->modus == 2): ?>
    <h3>Bitte geben Sie Ihre persönlichen Daten ein:</h3>
    
    <div class="bottom1">
        <label for="<?php echo BFT_ANREDE; ?>">Geschlecht</label>
        <div class="radiobox">
            <input type="radio" name="<?php echo BFT_ANREDE; ?>" value="herr" id="herr" <?php if (isset($this->anmeldung[BFT_ANREDE]) and $this->anmeldung[BFT_ANREDE] == 'herr') echo 'checked="checked" ' ?>/>
            <label class="radio" for="herr">männlich</label>
            <input type="radio" name="<?php echo BFT_ANREDE; ?>" value="frau" id="frau" <?php if (isset($this->anmeldung[BFT_ANREDE]) and $this->anmeldung[BFT_ANREDE] == 'frau') echo 'checked="checked" ' ?>/>
            <label class="radio" for="frau">weiblich</label>
        </div>
        <?php if (isset($this->error[BFT_ANREDE])): ?>
            <span class="error"><?php echo $this->error[BFT_ANREDE]; ?></span>
        <?php endif; ?>
    </div>

    <div class="bottom1">
        <label for="<?php echo BFT_VORNAME; ?>">Vorname</label>
        <input class="input" type="text" value="<?php if (isset($this->anmeldung[BFT_VORNAME])) echo $this->anmeldung[BFT_VORNAME]; ?>" id="<?php echo BFT_VORNAME; ?>" name="<?php echo BFT_VORNAME; ?>" />
        <?php if (isset($this->error[BFT_VORNAME])): ?>
            <span class="error"><?php echo $this->error[BFT_VORNAME]; ?></span>
        <?php endif; ?>
    </div>

    <div class="bottom1">
        <label for="<?php echo BFT_NACHNAME; ?>">Nachname</label>
        <input class="input" type="text" value="<?php if (isset($this->anmeldung[BFT_NACHNAME])) echo $this->anmeldung[BFT_NACHNAME]; ?>" id="<?php echo BFT_NACHNAME; ?>" name="<?php echo BFT_NACHNAME; ?>" />
        <?php if (isset($this->error[BFT_NACHNAME])): ?>
            <span class="error"><?php echo $this->error[BFT_NACHNAME]; ?></span>
        <?php endif; ?>
    </div>

    <div class="bottom1">
        <label for="<?php echo BFT_ALTER; ?>">Alter</label>
        <input class="input" type="text" value="<?php if (isset($this->anmeldung[BFT_ALTER])) echo $this->anmeldung[BFT_ALTER]; ?>" id="<?php echo BFT_ALTER; ?>" name="<?php echo BFT_ALTER; ?>" />
        <?php if (isset($this->error[BFT_ALTER])): ?>
            <span class="error"><?php echo $this->error[BFT_ALTER]; ?></span>
        <?php endif; ?>
    </div>

<?php else: ?>


<?php endif; ?>

<div class="text-box" style="text-align: center;">
    Haben Sie etwas Ruhe  &ndash; und 15 Minuten Zeit?<br><br> Es wäre gut, den Test "Wünsche klären"<br> in einer <strong>ungestörten Atmosphäre</strong> zu nutzen.
</div>

<div style="text-align: center;">
  <input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
</div>
