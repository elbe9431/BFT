<?php
/**
 * Paartherapietest :: Copyright template
 *
 * @version 1.0
 * @package Paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

global $user;

?>
<textarea name="Copyright" readonly="readonly"><?php if ($user->data['belehrung'] == 1) include 'copyright1.php'; else include 'copyright2.php'; ?></textarea>
<p>Ja, ich erkläre mich mit den oben genannten Teilnahmebedingungen und Datenschutzbestimmungen einverstanden.</p>
<input class="submit" type="submit" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_accept; ?>" />
<input class="submit orange" type="submit" name="<?php echo BFT_CANCEL; ?>" value="<?php echo BFT_Lang::button_cancel; ?>" />
