<?php
/**
 * Paartherapietest :: Template general header
 *
 * @version 1.0
 * @package Paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<div id="spacer"></div>
<div id="box-wrapper">
<div id="box" class="<?php echo $this->template; ?>">
<form action="/index.php?content=test" method="post" accept-charset="utf-8">
<input type="hidden" name="<?php echo BFT_DATA; ?>" value="<?php echo $this->encrypted; ?>" />
<input type="hidden" name="<?php echo BFT_HASH; ?>" value="<?php echo $this->hash; ?>" />
<div class="content-box">
