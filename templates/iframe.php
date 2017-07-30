<?php
/**
 * Berufsfindungstest :: Template inline frame
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<iframe src="<?php echo $this->iframe; ?>.html" name="<?php echo $this->iframe; ?>"></iframe>
<input class="submit top2" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
