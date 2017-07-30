<?php
/**
 * Berufsfindungstest :: Template Papierkorb phase 2
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
        <?php if ($this->modus == 42): ?>
            <h4><?php if ($this->todelete == 1) echo BFT_Lang::phase2_papierkorb21; else printf(BFT_Lang::phase2_papierkorb22, $this->todelete); ?></h4>
            <p><?php if ($this->todelete == 1) echo BFT_Lang::phase2_papierkorb23; else printf(BFT_Lang::phase2_papierkorb24, $this->todelete); ?></p>
            <p><?php echo BFT_Lang::phase2_papierkorb25; ?></p>
            <p><?php if ($this->todelete == 1) echo BFT_Lang::phase2_papierkorb26; else printf(BFT_Lang::phase2_papierkorb27, $this->todelete); ?></p>
        <?php else: ?>
            <h4><?php if ($this->todelete == 1) echo BFT_Lang::phase2_papierkorb11; else printf(BFT_Lang::phase2_papierkorb12, $this->todelete); ?></h4>
            <p><?php if ($this->todelete == 1) echo BFT_Lang::phase2_papierkorb13; else printf(BFT_Lang::phase2_papierkorb14, $this->todelete); ?></p>
            <p><?php echo BFT_Lang::phase2_papierkorb15; ?></p>
            <p><?php if ($this->todelete == 1) echo BFT_Lang::phase2_papierkorb16; else printf(BFT_Lang::phase2_papierkorb17, $this->todelete); ?></p>
        <?php endif; ?>
        <input id="sortable-next-button" class="disabled" type="submit" disabled="disabled" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
    </div>

    <div class="droppable"><h4>Papierkorb</h4></div>
    
    <?php $length = count($this->berufswege); $i = 1; foreach($this->berufswege as $bw): ?>
        <div id="<?php echo BFT_BERUFSWEGE.'_'.$bw['bwid']; ?>" class="draggable pos<?php if ((($length == 7) and ($i == 5 or $i == 7)) or (($length == 8) and ($i == 5 or $i == 6 or $i == 7 or $i == 8)) or (($length == 9) and ($i == 6 or $i == 8))) echo '3'.$i; else echo '2'.$i; ?>"><?php echo $bw['bwlerninhaltshort']; ?></div>
    <?php $i++; endforeach; ?>
</div>

<input type="hidden" name="<?php echo BFT_BERUFSWEGE; ?>" value="" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
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
        
        $(".draggable").disableSelection();

    });
</script>
