<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - SMTP test</title>
</head>
<body>
<?php

$headers   = array();
//$headers[] = "MIME-Version: 1.0";
//$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: Berufsfindungstest <berufsziele@web.de>";
//$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
$headers[] = "Reply-To: Berufsfindungstest <berufsziele@web.de>";
//$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();
$headers = implode("\r\n", $headers);

mail('berufsziele@aol.com', 'Subject', 'Message', $headers);
mail('carsten.heine@me.com', 'Subject', 'Message', $headers);
mail('carsten.heine@outlook.com', 'Subject', 'Message', $headers);

exit();

require 'PHPMailer/PHPMailerAutoload.php';

$mail1 = new PHPMailer();

// ----

$mail = new PHPMailer();

$mail->isSMTP();

$mail->SMTPDebug = 2; // 0 for production
$mail->Debugoutput = 'html';

$mail->Host = "smtp.kundenserver.de";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = "berufsziele";
$mail->Password = "11rogers";
$mail->SMTPSecure = 'tls';

$mail->setFrom('berufsziele@aol.com', 'Berufsfindungstest');
$mail->addReplyTo('berufsziele@aol.com', 'Berufsfindungstest');
$mail->addAddress('carsten.heine@me.com', 'Carsten Heine');
$mail->CharSet = 'utf-8';
$mail->Subject = 'PHPMailer SMTP test';
$mail->Body = 'This is the body.';

$mail->send();
?>
</body>
</html>