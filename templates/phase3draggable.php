<?php
/**
 * Berufsfindungstest :: Template Papierkorb phase 3
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<div id="sortable-wrapper">
    <div id="sortable-description">
        <h4><?php printf(BFT_Lang::phase3_papierkorb1, $this->todelete); ?></h4>
        <p><?php printf(BFT_Lang::phase3_papierkorb2, $this->todelete); ?></p>
        <p><?php echo BFT_Lang::phase3_papierkorb3; ?></p>
        <p><?php echo BFT_Lang::phase3_papierkorb4; ?></p>
        <input id="sortable-next-button" class="disabled" type="submit" disabled="disabled" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
    </div>

    <div class="droppable"><h4>Papierkorb</h4></div>
    
    <?php $length = count($this->todo); $i = 1; foreach($this->berufswege as $bw): ?>
        <div id="<?php echo BFT_BERUFSWEGE.'_'.$bw['bwid']; ?>" class="draggable hastooltip pos<?php if ((($length == 7) and ($i == 5 or $i == 7)) or (($length == 8) and ($i == 5 or $i == 6 or $i == 7 or $i == 8)) or (($length == 9) and ($i == 6 or $i == 8))) echo '3'.$i; else echo '2'.$i; ?>" title="<?php echo $bw['bwlerninhalt']; ?>"><?php echo $bw['bwname']; ?></div>
    <?php $i++; endforeach; ?>
</div>

<input type="hidden" name="<?php echo BFT_BERUFSWEGE; ?>" value="" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var counter = <?php echo $this->todelete; ?>;
        var value = '';
        
        $( '.draggable' ).draggable({
            containment: '#box',
            revert: 'invalid'
        });
        
        $( '.droppable' ).droppable({
            hoverClass: 'droppable-hover',
            tolerance: 'touch',
            drop: function(event, ui) {
                counter--;
                value += ui.draggable.attr( 'id' );
                if (counter > 0) value += ',';
                $( 'input[name="<?php echo BFT_BERUFSWEGE; ?>"]' ).attr( 'value', value );
                if (counter == 0) {                
                    $( ".disabled" ).removeAttr("disabled").removeClass("disabled").addClass("submit");
                    $( ".draggable" ).draggable( "option", "disabled", true ).css('cursor', 'auto');
                }
                ui.draggable.fadeOut();
            }
        });

		$(".hastooltip[title]").tooltip({
            delay: 0,
            layout: '<div class="tooltip"><div class="tooltip-arrow"></div></div>',
            position: 'bottom center',
            offset: [7,132],
		}).dynamic();
    });
</script>
