<?php
/**
 * Berufsfindungstest :: Template general text with additional cancel button
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
    <?php foreach($this->text as $text): ?>
        <p><?php echo $text; ?></p>
    <?php endforeach; ?>
</div>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
<input class="submit orange" type="submit" name="<?php echo BFT_CANCEL; ?>" value="<?php echo BFT_Lang::button_cancel; ?>" />
