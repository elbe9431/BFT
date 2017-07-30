<?php
/**
 * Berufsfindungstest :: Template general footer
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
    <?php if (BFT_Config::debug_mode): ?>
        <div id="debug">
            <div>
                <?php echo session_name().'='.session_id(); ?>
                <?php if (isset($this->section)) echo ', section='.$this->section; ?>
                <?php if (isset($this->step)) echo ', step='.$this->step.'/'.$this->maxsteps; ?>
                <?php if (isset($this->substep)) echo ', substep='.$this->substep; ?>
                <?php if (isset($this->modus)) echo ', modus='.$this->modus; ?>
                <?php if (isset($this->berufsfeld)) echo ', berufsfeld='.$this->berufsfeld; ?>
            </div>
            <pre><?php global $debug; $debug->show(); ?></pre>
        </div>
    <?php endif; ?>
    <?php if ($this->template == "print"): ?>
        <div id="printer"><?php echo $this->printer; ?></div>
    <?php endif; ?>
    <?php if ($this->template == "start"): ?>
        <div id="impress">Copyright &copy; <?php echo date('Y'); ?> Psychodiagnostische Beratungspraxis Hamburg, Inhaber Enno Heyken - <a href="impressum">Impressum</a></div>
    <?php endif; ?>
</body>
</html>
