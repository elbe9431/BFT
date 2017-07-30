<?php
/**
 * Berufsfindungstest :: Template Login Bezahloptionen
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

?>
<div class="bez_back">
    <input class="submit" type="submit" name="<?php echo BFT_CANCEL; ?>" value="Zurück" />
</div>

</form>

<div style="width: 220px; float: left; text-align: right;">
    &nbsp;
</div>
<div style="width: 550px; float: left; text-align: center; margin-left: 50px; margin-bottom: 25px;">
    <h3>Wie wollen Sie die <?php echo BFT_Lang::Preis($this->userid); ?> Testgebühr bezahlen?</h3>
</div>

<br>

<!-- *** PAYPAL *** -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="paypal@berufsfindungstest.eu" />
    <input type="hidden" name="lc" value="DE" />
    <input type="hidden" name="item_name" value="Hamburger Paartherapietest" />
    <input type="hidden" name="amount" value="<?php echo sprintf("%01.2f", $this->preis / 100); ?>" />
    <input type="hidden" name="currency_code" value="EUR" />
    <input type="hidden" name="no_shipping" value="1" />
    <input type="hidden" name="cancel_return" value="<?php echo 'http://www.paartherapietest.eu/?return='.base64_encode('Paypal_Canceled_'.$this->userid); ?>" />
    <input type="hidden" name="return" value="<?php echo 'http://www.paartherapietest.eu/?return='.base64_encode('Paypal_Success_'.$this->userid); ?>" />
    <input type="hidden" name="notify_url" value="http://www.paartherapietest.eu/api-paypal/paypalapi.php?user=<?php echo $this->userid; ?>" />
    <div style="width: 220px; padding-top: 3px; float: left; text-align: right;">
        <input type="image" src="/images/paypal.png" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
        <img alt="" border="0" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1">
    </div>
    <div style="width: 550px; float: left; text-align: center; margin-left: 50px;">
        <strong>Paypal</strong>
        <br >
        Bezahlen Sie bequem und sicher per Paypal. Sie können den Test sofort nach erfolgreicher Bezahlung durchführen.
    </div>
</form>
<div style="clear: both;">&nbsp;</div>

<!-- *** Lastschrift *** -->
<?php
    $params = 'project=leu-bhths-0a01e78e&amount='.$this->preis.'&user='.$this->userid.'&bezart=2';
    $accessKey = '4b32715c917e314bd5475b475967cec7';
    $seal = md5($params . $accessKey);     
    $url = 'https://billing.micropayment.de/lastschrift/event/?' . $params . '&seal=' . $seal;
?>
<div style="width: 220px; float: left; text-align: right;">
    <a href="<?php echo $url; ?>"><img src="http://www.micropayment.de/resources/?what=img&group=dbt&show=type-h.6" style="border:0px; height:38px; width:126px"></a>
</div>
<div style="width: 550px; float: left; text-align: center; margin-left: 50px;">
    <strong>Lastschrift</strong>
    <br />
    <span>Per Lastschrift mit dem <strong>TÜV-geprüften</strong> Zahlungssystem <strong>"Micropayment"</strong> zahlen. Sie können den Test sofort nach erfolgreicher Eingabe Ihrer Bankverbindung starten.</span>
</div>
<div style="clear: both;">&nbsp;</div>


<!-- *** Onlineüberweisung *** -->
<?php
$params = 'project=leu-bhths-0a01e78e&amount='.$this->preis.'&user='.$this->userid.'&bezart=3';
$accessKey = '4b32715c917e314bd5475b475967cec7';
$seal = md5($params . $accessKey);     
//geändert: 06.09.13 Siehe Email: 06.09.13
//$url = 'https://billing.micropayment.de/ebank2pay/event/?' . $params . '&seal=' . $seal;
$url = 'https://billing.micropayment.de/sofort/event/?' . $params . '&seal=' . $seal;
?>
<div style="width: 220px; float: left; text-align: right;">
   <a href="<?php echo $url; ?>"><img src="http://www.micropayment.de/resources/?what=img&group=eb2p&show=type-h.6" style="border:0px; height:38px; width:181px"></a>
</div>
<div style="width: 550px; float: left; text-align: center; margin-left: 50px;">
   <strong>Onlineüberweisung</strong>
   <br />
   Per Onlineüberweisung über das <strong>TÜV-geprüfte</strong> Zahlungssystem <strong>"Micropayment"</strong> (mit PIN und TAN) bezahlen. Danach können Sie den Test sofort starten.
</div>
<div style="clear: both;">&nbsp;</div>


