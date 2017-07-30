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
<div class="content-box">
<div class="p1-result">

<table style="width:824px;" cellspacing="0">
   
           <tr>
               
                    <td><h2><?php  echo $this->tablerows[0][0]; ?></h2></td>
              
            </tr>
        
            <tr>
               
                    <td><textarea name="Impressum" style="padding: 10px;" readonly="readonly"><?php  echo $this->tablerows[0][1]; ?></textarea></td>
               
            </tr>
        
    
</table>

<input class="submit" type="submit" style="right: 1em;" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
</div></div>