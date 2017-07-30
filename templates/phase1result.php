<?php
/**
 * Berufsfindungstest :: Template result phase 1 (another cycle)
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<div class="p1-result">
    <div class="p1-result-left">
        <?php $count = count($this->berufsfelder); ?>
        <?php if ($this->substep == 11): ?>
            <?php if ($this->modus == 1): ?>
                <p><?php printf(BFT_Lang::phase1_relevante11, BFT_Config::max_berufsfelder); ?></p>
            <?php else: ?>
                <p><?php printf(BFT_Lang::phase1_relevante12, BFT_Config::max_berufsfelder); ?></p>
            <?php endif; ?>
            <p><?php printf(BFT_Lang::phase1_relevante2, $count); ?></p>
            <?php if ($count - BFT_Config::max_relevante == 1): ?>
                <p><?php echo BFT_Lang::phase1_relevante31; ?></p>
            <?php else: ?>
                <p><?php printf(BFT_Lang::phase1_relevante32, $count - BFT_Config::max_relevante); ?></p>
            <?php endif; ?>
            <p><?php echo BFT_Lang::phase1_relevante4; ?></p>
            <p><?php echo BFT_Lang::phase1_relevante5; ?></p>
            <p><?php echo BFT_Lang::phase1_relevante6; ?></p>
            <?php if ($count - BFT_Config::max_relevante == 1): ?>
                <p><?php echo BFT_Lang::phase1_relevante71; ?></p>
            <?php else: ?>
                <p><?php printf(BFT_Lang::phase1_relevante72, $count - BFT_Config::max_relevante); ?></p>
            <?php endif; ?>
            <div class="buttonexample"><?php echo BFT_Lang::phase1_button6; ?></div>
            <div class="buttonexample"><?php echo BFT_Lang::phase1_button5; ?></div>
        <?php else: ?>
            <?php if ($this->modus == 1): ?>
                <p><?php printf(BFT_Lang::phase1_streicher11, BFT_Config::max_berufsfelder); ?></p>
            <?php else: ?>
                <p><?php printf(BFT_Lang::phase1_streicher12, BFT_Config::max_berufsfelder); ?></p>
            <?php endif; ?>
            <p><?php printf(BFT_Lang::phase1_streicher2, $count); ?></p>
            <?php if ($count + BFT_Config::min_relevante - BFT_Config::max_berufsfelder == 1): ?>
                <p><?php echo BFT_Lang::phase1_streicher31; ?></p>
            <?php else: ?>
                <p><?php printf(BFT_Lang::phase1_streicher32, $count + BFT_Config::min_relevante - BFT_Config::max_berufsfelder); ?></p>
            <?php endif; ?>
            <p><?php echo BFT_Lang::phase1_streicher4; ?></p>
            <p><?php echo BFT_Lang::phase1_streicher5; ?></p>
            <p><?php echo BFT_Lang::phase1_streicher6; ?></p>
            <?php if ($count + BFT_Config::min_relevante - BFT_Config::max_berufsfelder == 1): ?>
                <p><?php echo BFT_Lang::phase1_streicher71; ?></p>
            <?php else: ?>
                <p><?php printf(BFT_Lang::phase1_streicher72, $count + BFT_Config::min_relevante - BFT_Config::max_berufsfelder); ?></p>
            <?php endif; ?>
            <div class="buttonexample"><?php echo BFT_Lang::phase1_button4; ?></div>
        <?php endif; ?>
    </div>
    <div class="p1-result-right">
        <?php if ($this->substep == 11): ?>
            <h3><?php echo BFT_Lang::phase1_relevante8; ?></h3>
        <?php else: ?>
            <h3><?php echo BFT_Lang::phase1_streicher8; ?></h3>
        <?php endif; ?>
        <ol>
            <?php foreach ($this->berufsfelder as $val): ?>
                <li><?php echo $val['bfname']; ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
    <input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
</div>
