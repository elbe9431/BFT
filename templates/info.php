<?php
/**
 * Berufsfindungstest :: Template preview test 2
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<div class="preview-box">
    <h3>Preview Tool "Lösungen finden"</h3>
    <a href="images/screen<?php echo $this->imagenumber; ?>.jpg" rel="lightbox-screens" title="<?php echo $this->imagetitle; ?>"><img src="images/thumb<?php echo $this->imagenumber; ?>.jpg" /></a>
    <?php foreach($this->text as $text): ?>
        <p><?php echo $text; ?></p>
    <?php endforeach; ?>
</div>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
