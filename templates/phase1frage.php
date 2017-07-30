<?php
/**
 * Berufsfindungstest :: Template Standard Frage phase 1
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<div class="p1-main">
    <h3><?php echo $this->frage1; ?></h3>
    <p class="p1-left"><?php echo BFT_Lang::phase1_mouseover; ?></p>
    <div class="table-wrapper">
        <?php $length = count($this->berufswege) / 2; ?>
        <?php for ($i = 0; $i < $length; $i++): ?>
            <div class="cell-wrapper hastooltip b1l b2r <?php if ($i == 0) echo ' b1t ctl'; if ($i == $length - 1) echo ' b1b cbl'; if ($i != 0) echo ' b2t'; ?>" title="<?php echo $this->berufswege[$i]['bwbeschreibung']; ?>">
                <table cellspacing="0"><tr><td><?php echo $this->berufswege[$i]['bwnameshort']; ?></td></tr></table>
            </div>
            <div class="cell-wrapper hastooltip b1r <?php if ($i == 0) echo ' b1t ctr'; if ($i == $length - 1) echo ' b1b cbr'; if ($i != 0) echo ' b2t'; ?>" title="<?php echo $this->berufswege[$i + 5]['bwbeschreibung']; ?>">
                <table cellspacing="0"><tr><td><?php echo $this->berufswege[$i + 5]['bwnameshort']; ?></td></tr></table>
            </div>
        <?php endfor; ?>
        <div class="clear"></div>
    </div>
    <h2><?php echo $this->frage2; ?></h2>
    <?php if (isset($this->bisher)): ?>
        <p class="p1-left"><?php echo $this->bisher; ?></p>
    <?php endif; ?>
	
    <input class="submit" type="submit" name="<?php echo BFT_STIMMT; ?>" value="<?php echo $this->button3; ?>" />
    <input class="submit" type="submit" name="<?php echo BFT_WEISSNICHT; ?>" value="<?php echo $this->button2; ?>" />
    <input class="submit" type="submit" name="<?php echo BFT_STIMMTNICHT; ?>" value="<?php echo $this->button1; ?>" />
</div>


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
