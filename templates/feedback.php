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
 	<?php if(isset($this->headline) and $this->headline): ?>
        <h3><?php echo $this->headline; ?></h3>
    <?php endif; ?>
    <p >Wie hat Ihnen der Test gefallen? Gibt's <br />
    etwas, was wir noch verbessern könnten?<br/>
    Wir freuen uns über Ihren <strong>kleinen Kommentar </strong> im weißen Textfenster!<br/>Wenn Sie den Test jetzt nicht kommentieren wollen, dann klicken Sie einfach direkt auf "Weiter"!</p>
    <textarea id="feedback" name="feedback"></textarea>
</div>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
<script language="javascript">
	var feedback=document.getElementById("feedback");
	feedback.focus();
</script>