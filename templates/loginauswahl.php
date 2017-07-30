<?php
/**
 * Berufsfindungstest :: Template Login Auswahl
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<div class="login-left">
    <h2>Neu Anmelden</h2>
    <p class="bottom2">Für die Durchführung des Testes ist es erforderlich, dass Sie sich einmalig kurz anmelden.</p>
    <p><strong>Haben Sie sich noch nicht angemeldet?</strong></p>
</div>
<div class="login-right">
    <h2>Login</h2>
    <?php if ($this->error): ?>
        <p class="error"><?php echo $this->error; ?></p>
    <?php else: ?>
        <p>Haben Sie sich bereits angemeldet? Dann können Sie sich hier mit Ihrem Passwort direkt einloggen.</p>
    <?php endif; ?>
    <div class="bottom2">
        <label for="<?php echo BFT_USERNAME; ?>"><strong>Email oder Username</strong></label>
        <br />
        <input class="input" type="text" value="<?php if (isset($this->login[BFT_USERNAME])) echo $this->login[BFT_USERNAME]; ?>" id="<?php echo BFT_USERNAME; ?>" name="<?php echo BFT_USERNAME; ?>" />
    </div>
    <div class="bottom2">
        <label for="<?php echo BFT_PASSWORD; ?>"><strong>Passwort</strong></label>
        <br />
        <input class="input" type="password" value="" id="<?php echo BFT_PASSWORD; ?>" name="<?php echo BFT_PASSWORD; ?>" />
        <br />
        <input class="submit login" type="submit" name="<?php echo BFT_LOGIN; ?>" value="<?php echo BFT_Lang::button_login; ?>" />
        <input class="submit register" type="submit" name="<?php echo BFT_REGISTER; ?>" value="<?php echo BFT_Lang::button_register; ?>" />
        <input class="link" type="submit" name="<?php echo BFT_PWD; ?>" value="<?php echo BFT_Lang::button_pwd; ?>" />
    </div>
</div>
