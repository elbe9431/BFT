<?php
/**
 * Berufsfindungstest :: Template Passwort vergessen
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<h3>Bitte geben Sie Ihre E-Mail-Adresse oder Ihren Usernamen ein</h3>

<div class="bottom1">
    <label for="<?php echo BFT_USERNAME; ?>">Email oder Username</label>
    <input class="input" type="text" value="" id="<?php echo BFT_USERNAME; ?>" name="<?php echo BFT_USERNAME; ?>" />
    <?php if (isset($this->error) and $this->error): ?>
        <span class="error"><?php echo $this->error; ?></span>
    <?php endif; ?>
    <?php if (isset($this->longerror) and $this->longerror): ?>
        <p class="longerror"><?php echo $this->longerror; ?></p>
    <?php endif; ?>
</div>

<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
