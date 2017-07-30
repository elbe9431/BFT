<?php
/**
 * Berufsfindungstest :: Template Sortieren phase 2
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<ol id="sortable-background">
    <?php foreach($this->berufswege as $bw): ?>
        <li></li>
    <?php endforeach; ?>
</ol>

<ul id="sortable">
</ul>

<?php $p = count($this->berufswege) % 2; $i = 1; foreach($this->berufswege as $bw): ?>
    <ul class="sortable-dest pos<?php echo $p.$i; ?>">
        <li id="<?php echo BFT_BERUFSWEGE.'_'.$bw['bwid']; ?>" class="sortable-item"><?php echo $bw['bwlerninhaltshort']; ?></li>
    </ul>
<?php $i++; endforeach; ?>

<div id="sortable-description">
    <h4><?php echo BFT_Lang::phase2_frage; ?></h4>
    <p><?php printf(BFT_Lang::phase2_anleitung1, $this->tosort); ?></p>
    <p><?php echo BFT_Lang::phase2_anleitung2; ?></p>
    <p><?php echo BFT_Lang::phase2_anleitung3; ?></p>
    <input id="sortable-next-button" class="disabled" type="submit" disabled="disabled" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
</div>

<input type="hidden" name="<?php echo BFT_BERUFSWEGE; ?>" value="" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var modus = <?php echo $this->tosort; ?>;
        $("#sortable-next-button").attr("disabled", "disabled").addClass("disabled").removeClass("submit");
        $("#sortable").sortable({
            containment: '#box',
            placeholder: 'ui-state-highlight',
            dropOnEmpty: false,
            revert: 200,
            tolerance: 'pointer',
            update: function() {
                $("input[name='<?php echo BFT_BERUFSWEGE; ?>']").attr("value", $("#sortable").sortable("serialize"));
                if ($("#sortable li").length == modus) {                
                    $(".disabled").removeAttr("disabled").removeClass("disabled").addClass("submit");
                }
            }
        });
        $(".sortable-dest").sortable({
            connectWith: '#sortable',
            containment: '#box',
            placeholder: 'ui-state-highlight',
            revert: 200,
            tolerance: 'pointer'
        });
        $(".sortable-item").disableSelection();
    });
</script>
