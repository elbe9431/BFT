<?php
/**
 * Berufsfindungstest :: Template general text
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
        <input type="radio" name="favoriteWish" value=""><?php echo $text; ?><br>
    <?php endforeach; ?>
</div>
<!--
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
-->
