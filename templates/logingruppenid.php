<?php
/**
 * Berufsfindungstest :: Template Gruppen ID oder Key eingeben
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
	<?php if(BFT_Config::test_mode_kostenlos==0): ?>
        
        <p>Geben Sie nun bitte Ihr <strong>persönliches Kennwort</strong> ein, welches Sie im bereits absolvierten Testverlauf am Bildschirm angezeigt bekommen haben. Sie starten dann genau an dem Punkt, an dem Sie aufgehört haben.</p>
    <?php else:?>
        
    <?php endif ?>
    <div class="bottom1">
        <label for="<?php echo BFT_GRUPPENID; ?>"><?php if ($this->modus == 1) echo 'Kennwort'; else echo 'Kennwort:'; ?></label>
        <?php if(isset($_GET['kw']) && $_GET['kw']!=""):?>
			<input class="input" type="text" value="<?php if(isset($this->anmeldung[BFT_GRUPPENID])) {echo $this->anmeldung[BFT_GRUPPENID];}else{echo $_GET['kw'];}; ?>" id="<?php echo BFT_GRUPPENID; ?>" name="<?php echo BFT_GRUPPENID; ?>" />
		<?php else: ?>
         <input class="input" type="text" value="<?php if (isset($this->anmeldung[BFT_GRUPPENID])) echo $this->anmeldung[BFT_GRUPPENID]; ?>" id="<?php echo BFT_GRUPPENID; ?>" name="<?php echo BFT_GRUPPENID; ?>" />
        <?php endif;?>
       
        <?php if (isset($this->error) and $this->error): ?>
            <p class="error"><?php echo $this->error; ?></p>
        <?php endif; ?>
    </div>
</div>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
<input class="submit orange" type="submit" name="<?php echo BFT_CANCEL; ?>" value="<?php echo BFT_Lang::button_cancel; ?>" />
