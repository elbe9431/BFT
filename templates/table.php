<?php
/**
 * Berufsfindungstest :: Template general table
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<h2><?php echo $this->headline; ?></h2>
<table cellspacing="0">
    <tr>
        <?php foreach($this->tableheader as $th): ?>
            <th><?php echo $th; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php if (count($this->tablerows) == 0): ?>
        <tr>
            <td class="center" colspan="<?php echo count($this->tableheader); ?>"><?php echo BFT_Lang::table_empty; ?></td>
        </tr>
    <?php else: ?>
        <?php foreach($this->tablerows as $tr): ?>
            <tr>
                <?php foreach($tr as $td): ?>
                    <td><?php echo $td; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
