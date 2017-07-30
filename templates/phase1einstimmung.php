<?php
/**
 * Berufsfindungstest :: Template Einstimmungsfrage phase 1
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
    <h3><?php echo BFT_Lang::phase1_einstimmung1; ?></h3>
    <p class="p1-left"><?php echo BFT_Lang::phase1_einstimmung2; ?></p>
    <div class="table-wrapper">
        <table cellspacing="0">
            <tr>
                <td><?php echo $this->frage1; ?></td>
            </tr>
        </table>
    </div>
    <div class="table-wrapper">
        <table cellspacing="0">
            <tr>
                <td><?php echo $this->frage2; ?></td>
            </tr>
        </table>
    </div>
    <input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
</div>
