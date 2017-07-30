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
<?php if(isset($this->headline) and $this->headline): ?>
        <h3><?php echo $this->headline; ?></h3>
    <?php endif; ?>
<br>
               
                    <h2 style="text-align: center;"><?php  echo $this->tablerows[0][0]; ?></h2>
           </a><p>Möchten Sie KlärungsIdeen zu diesem Wunsch zunächst in Form eines <strong>3-Minuten-Videos</strong> anschauen? <br>Dann klicken Sie auf das folgende Videosymbol:<p>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <script type="text/javascript" src="fancybox/video.js"></script>


<a class="video" title="<?php  echo $this->tablerows[0][0]; ?>" href="<?php  echo $this->tablerows[0][2]; ?>">
<?php foreach($this->text as $text): ?>
        <p><?php echo $text; ?></p>
    <?php endforeach; ?>
</a><p>Wenn Sie auf <strong>„Weiter“</strong> klicken, können Sie die Klärungsideen am Bildschirm<br> lesen (<strong>dabe bitte den Scrollbalken rechts  neben dem Text beachten</strong>).<p>

<input class="submit" type="submit" style="right: 1em;" name="<?php echo BFT_NEXT; ?>" value="<?php echo BFT_Lang::button_next; ?>" />
</div></div>