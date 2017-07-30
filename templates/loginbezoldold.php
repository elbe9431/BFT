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

<div class="bez_ueberw">
    <!--<p><strong>Banküberweisung</strong><br />Per herkömmlicher Banküberweisung bezahlen. Wenn Sie uns die Überweisungsdaten an berufsziele@aol.com mailen (Kopieren und Einfügen oder als Screenshot) dann schalten wir Sie meist innerhalb von 24 Stunden frei, sonst nach Zahlungseingang.<br/><br/><strong>Fragen?</strong> Psychodiagnostische Beratungspraxis, Tel. 040 65993820</p>
    <div class="ueberw-button">
        <input class="submit" type="submit" name="<?php echo BFT_UEBERW; ?>" value="Überweisung" />
    </div>-->
</div>
</form>

<h3>Wie wollen Sie die <?php echo BFT_Lang::Preis($this->userid); ?> Testgebühr bezahlen?</h3>

<?php
    $params = 'project=hmbrgr&amount='.$this->preis.'&user='.$this->userid.'&bezart=2';
    $accessKey = '4b32715c917e314bd5475b475967cec7';
    $seal = md5($params . $accessKey);     
    $url = 'https://billing.micropayment.de/lastschrift/event/?' . $params . '&seal=' . $seal;
?>

<div class="bez_lastschrift">
    <p><strong>Lastschrift</strong><br />
    Per Lastschrift mit dem <strong>TÜV-geprüften</strong> Zahlungssystem <strong>"Micropayment"</strong> zahlen. Sie können den Test sofort nach erfolgreicher Eingabe Ihrer Bankverbindung starten.</p>
    <a href="<?php echo $url; ?>"><img src="http://www.micropayment.de/resources/?what=img&group=dbt&show=type-h.6" style="border:0px; height:38px; width:126px"></a>
</div>

<?php
    $params = 'project=hmbrgr&amount='.$this->preis.'&user='.$this->userid.'&bezart=3';
    $accessKey = '4b32715c917e314bd5475b475967cec7';
    $seal = md5($params . $accessKey);     
    //geändert: 06.09.13 Siehe Email: 06.09.13
	//$url = 'https://billing.micropayment.de/ebank2pay/event/?' . $params . '&seal=' . $seal;
	$url = 'https://billing.micropayment.de/sofort/event/?' . $params . '&seal=' . $seal;
?>

<div class="bez_onlineueberw">
    <p><strong>Onlineüberweisung</strong><br />Per Onlineüberweisung über das <strong>TÜV-geprüfte</strong> Zahlungssystem <strong>"Micropayment"</strong> (mit PIN und TAN) bezahlen. Danach können Sie den Test sofort starten.</p>
    <a href="<?php echo $url; ?>"><img src="http://www.micropayment.de/resources/?what=img&group=eb2p&show=type-h.6" style="border:0px; height:38px; width:181px"></a>
</div>

<form class="bez_paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <p><strong>Paypal</strong><br >Bezahlen Sie bequem und sicher per Paypal. Sie können den Test sofort nach erfolgreicher Bezahlung durchführen.</p>
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="paypal@berufsfindungstest.eu" />
    <input type="hidden" name="lc" value="DE" />
    <input type="hidden" name="item_name" value="Hamburger Berufsfindungstest" />
    <input type="hidden" name="amount" value="<?php echo sprintf("%01.2f", $this->preis / 100); ?>" />
    <input type="hidden" name="currency_code" value="EUR" />
    <input type="hidden" name="no_shipping" value="1" />
    <input type="hidden" name="cancel_return" value="<?php echo 'http://www.paartherapietest.eu/?return='.base64_encode('Paypal_Canceled_'.$this->userid); ?>" />
    <input type="hidden" name="return" value="<?php echo 'http://www.paartherapietest.eu/?return='.base64_encode('Paypal_Success_'.$this->userid); ?>" />
    <input type="hidden" name="notify_url" value="http://www.paartherapietest.eu/api-paypal/paypalapi.php?user=<?php echo $this->userid; ?>" />
    <div class="paypal-button">
        <input type="image" src="/images/paypal.png" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
        <img alt="" border="0" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1">
    </div>
</form>
