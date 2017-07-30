<?php
/**
 * Berufsfindungstest :: Template Enter email at end of test 1
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
    <div class="bottom1">
        <label for="<?php echo BFT_EMAIL; ?>">Email</label>
        <input class="input" type="text" value="" id="<?php echo BFT_EMAIL; ?>" name="<?php echo BFT_EMAIL; ?>" />
        <?php if (isset($this->error) and $this->error): ?>
            <span class="error"><?php echo $this->error; ?></span>
        <?php endif; ?>
    </div>
</div>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
