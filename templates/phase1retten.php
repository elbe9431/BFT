<?php
/**
 * Berufsfindungstest :: Template Beruf retten phase 1
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
    <?php if ($this->substep == 22): ?>
        <h3><?php printf(BFT_Lang::phase1_retten2, $this->berufsfelder[0]['bfzeile3']); ?></h3>
        <p><?php echo BFT_Lang::phase1_retten5; ?></p>
        <input class="submit extrawidebig" type="submit" name="<?php echo BFT_STIMMT; ?>" value="<?php echo BFT_Lang::phase1_allestreichen; ?>" />
        <p><?php echo BFT_Lang::phase1_retten6; ?></p>
    <?php else: ?>
        <h3><?php echo BFT_Lang::phase1_retten1; ?></h3>
    <?php endif; ?>
    <p class="p1-left"><?php echo BFT_Lang::phase1_mouseover; ?></p>
    <?php $length = count($this->berufswege) / 2; for ($i = 0; $i < $length; $i++): ?>
        <input class="submit extrawide hastooltip" title="<?php echo $this->berufswege[$i]['bwbeschreibung']; ?>" type="submit" name="<?php echo BFT_RETTEN.$i; ?>" value="<?php echo $this->berufswege[$i]['bwnameshort']; ?>" />
        <input class="submit extrawide hastooltip" title="<?php echo $this->berufswege[$i + 5]['bwbeschreibung']; ?>" type="submit" name="<?php echo BFT_RETTEN.($i + 5); ?>" value="<?php echo $this->berufswege[$i + 5]['bwnameshort']; ?>" />
    <?php endfor; ?>
    <?php if (isset($this->bisher)): ?>
        <p class="p1-left bisher"><?php echo $this->bisher; ?></p>
    <?php endif; ?>
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
