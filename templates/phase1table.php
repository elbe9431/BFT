<?php
/**
 * Berufsfindungstest :: Template table phase 1
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<div class="p1-table-left">
    <?php $modus = $this->modus > 3 ? $this->modus - 3 : $this->modus; ?>
    <p><?php echo BFT_Lang::phase1_tablezeile1; ?></p>
    <p>
        <?php if ($this->min == 1 and $this->max == 1): ?>
            <?php echo BFT_Lang::phase1_tablezeile21; ?></p><p>
            <?php echo BFT_Lang::phase1_tablezeile31; ?>
        <?php else: ?>
            <?php printf(BFT_Lang::phase1_tablezeile22, $this->min); ?></p><p>
            <?php printf(BFT_Lang::phase1_tablezeile32, $this->min); ?>
        <?php endif; ?>
    </p>
    <p><?php echo BFT_Lang::phase1_tablezeile4; ?></p>
        <?php if ($this->min == 1 and $this->max == 1): ?>
            <p><?php echo BFT_Lang::phase1_tablezeile51; ?></p>
        <?php else: ?>
            <p><?php echo BFT_Lang::phase1_tablezeile52; ?></p>
        <?php endif; ?>
    <p><?php echo BFT_Lang::phase1_tablezeile6; ?></p>
    <?php if ($this->showerror): ?>
        <p class="error">
            <?php if ($this->min == 1 and $this->max == 1): ?>
                <?php echo BFT_Lang::phase1_tableerror1; ?>
            <?php else: ?>
                <?php printf(BFT_Lang::phase1_tableerror2, $this->min); ?>
            <?php endif; ?>
        </p>
    <?php endif; ?>
</div>
<div class="checkboxes">
    <?php $length = count($this->berufsfelder); $i = 1; foreach($this->berufsfelder as $bf): ?>
        <div>
            <input type="checkbox" id="<?php echo $bf['bfid']; ?>" name="<?php echo BFT_BERUFSFELDER; ?>[]" value="<?php echo $bf['bfid']; ?>" <?php if (in_array($bf['bfid'], $this->auswahl)) echo 'checked="checked" '; ?>/>
            <label class="hastooltip<?php if ($i == 1) echo ' b1t ct'; if ($i != 1) echo ' b2t'; if ($i == $length) echo ' b1b cb'; ?>" for="<?php echo $bf['bfid']; ?>" title="<?php echo $bf['bfbeschreibung']; ?>"><?php echo $bf['bfname']; ?></label>
        </div>
    <?php $i++; endforeach; ?>
</div>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />


<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){	
		$(".hastooltip[title]").tooltip({
            delay: 0,
            layout: '<div class="tooltip"><div class="tooltip-arrow"></div></div>',
            position: 'bottom center',
            offset: [7,132],
		}).dynamic();
	});
</script>
