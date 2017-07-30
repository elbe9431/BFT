<?php
/**
 * Berufsfindungstest :: Template headline for module start page
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<div class="headline-box">
    <h2 class="bottom2"><?php echo $this->headline; ?></h2>
    <p><?php echo $this->text; ?></p>
    <p class="copyr"><?php echo BFT_Lang::copyright; ?></p>
</div>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
