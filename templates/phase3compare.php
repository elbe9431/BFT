<?php
/**
 * Berufsfindungstest :: Template Compare phase 3
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<input type="hidden" name="match" value="<?php echo $this->berufsweg[1]['bwid'].'_'.$this->berufsweg[2]['bwid']; ?>" />
<div class="compare-left">
    <div class="compare-box">
        <p class="top">Wunsch A</p>
        <h3 class="headline"><?php echo $this->berufsweg[1]['bwname']; ?></h3>
        <p class="text"><?php echo str_replace('Ich will Inhalte', '<strong>Ich will Inhalte</strong>', $this->berufsweg[1]['bwlerninhalt']); ?></p>
        <p class="text"><img src="images/arrow.png" /><?php echo str_replace('Im Berufsleben', '<strong>Im Berufsleben</strong>', $this->berufsweg[1]['bwtätigkeit']); ?></p>
        <p class="handle handle1">Paartherapeuten-Tipps</p>
        <p class="hinweise hinweise1"><?php echo $this->berufsweg[1]['bwberater']; ?></p>
    </div>
    <h3>Wunsch A ist mir…</h3>
    <input class="submit" type="submit" name="A" value="Viel wichtiger" />
    <input class="submit yellow" type="submit" name="B" value="Etwas wichtiger" />
</div>
<div class="compare-right">
    <div class="compare-box">
        <p class="top">Wunsch B</p>
        <h3 class="headline"><?php echo $this->berufsweg[2]['bwname']; ?></h3>
        <p class="text"><?php echo str_replace('Ich will Inhalte', '<strong>Ich will Inhalte</strong>', $this->berufsweg[2]['bwlerninhalt']); ?></p>
        <p class="text"><img src="images/arrow.png" /><?php echo str_replace('Im Berufsleben', '<strong>Im Berufsleben</strong>', $this->berufsweg[2]['bwtätigkeit']); ?></p>
        <p class="handle handle2">Paartherapeuten-Tipps</p>
        <p class="hinweise hinweise2"><?php echo $this->berufsweg[2]['bwberater']; ?></p>
    </div>
    <h3>Wunsch B ist mir…</h3>
    <input class="submit yellow" type="submit" name="C" value="Etwas wichtiger" />
    <input class="submit" type="submit" name="D" value="Viel wichtiger" />
</div>
<?php
if ($this->modus == 1) {
echo '<div class="compare-middle"><input class="submit red" type="submit" name="E" value="Beide völlig unwichtig" /></div>';
}
?>
<?php
if ($this->modus == 2) {
echo '<div class="compare-middle"><input class="submit red" type="submit" name="E" value="Beide völlig unwichtig" /></div>';
}
?>
<div class="oder">
    oder
</div>

<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function fade(elem, interval)
        {
            if(!(elem instanceof $)) {
                elem = $(elem);
            }

            if(elem.is(':not(:visible)')) {
                elem.css('opacity', '0').show();
            }

            elem.css('opacity', function() {
                    var current = $(this).data('fadeLevel') || 0;

                    //normalize - accounts for tiny descrepancies in parsing
                    if(current < 0) { current = 0; }
                    if(current > 1) { current = 1; }

                    $(this).data('fadeLevel', current + interval)

                    return $(this).data('fadeLevel');
                });

            if(elem.data('fadeLevel') < 0 || elem.data('fadeLevel') > 1 ) {
                clearTimeout(elem.data('fadeTimer'));
            }
        }

        function fadeIn(elem) { fadeTo(elem, 0.08, 0); }
        function fadeOut(elem) { fadeTo(elem, -0.08, 1); }
        function fadeTo(elem, interval, level) {
            if(!$(elem).data('itemOpen')) {
                clearTimeout($(elem).data('fadeTimer'));
                $(elem).data('fadeLevel', level).data('fadeTimer', setInterval(function() { fade(elem, interval) }, 30));
            }
        }

        $('.handle1').hover(function() {
           fadeIn('.hinweise1');
        }, function() {
           fadeOut('.hinweise1');
        });
                
        $('.handle2').hover(function() {
           fadeIn('.hinweise2');
        }, function() {
           fadeOut('.hinweise2');
        });
    });
</script>
