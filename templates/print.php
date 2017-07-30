<?php
/**
 * Berufsfindungstest :: Print test results
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
    <?php if (isset($this->email) and $this->email): ?>
        <h3>Wollen Sie Ihre Ergebnisse jetzt zusätzlich ausdrucken?</h3>
        <p>Die Testergebnisse haben Sie am <strong>Bildschirm</strong> gesehen.



<?php echo BFT_Lang::mail_spam; ?></p>
    <?php else: ?>
        <h3>Wollen Sie Ihre Ergebnisse ausdrucken?</h3>
    <?php endif; ?>
    <p>Sie können sich jetzt Ihre Ergebnisse zusätzlich <strong>ausdrucken</strong>.</p>
    <p>Anschließend oder wenn Sie Ihre Ergebnisse nicht ausdrucken wollen klicken Sie bitte auf "Weiter".</p>
</div>
<input class="submit" type="button" value="Drucken" onclick="javascript:window.print()" />
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
