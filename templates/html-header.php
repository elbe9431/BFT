<?php
/**
 * Berufsfindungstest :: Template general header
 *
 * @version 1.0
 * @package Hamburger Paartherapie-Test
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access.');

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="de" lang="de" class="no-js">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php echo $this->title; ?></title>
    <meta name="description" content="<?php echo $this->description; ?>" />
    <meta name="keywords" content="<?php echo BFT_Lang::keywords; ?>" />
    <meta name="author" content="<?php echo BFT_Lang::author; ?>" />
    <meta name="contact" content="<?php echo BFT_Lang::contact; ?>" />
    <meta name="language" content="de" />
    <meta name="robots" content="index,follow" />
    <meta name="page-topic" content="Paartherapie, Paarberatung" />
    <script type="text/javascript">
        document.getElementsByTagName("html")[0].className = "js";
    </script>
    <?php if ($this->template == "start"): ?>
    <link rel="stylesheet" href="css/hp.css" type="text/css" media="screen" />
    <?php else: ?>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
    <?php endif; ?>
    <!--[if IE]><link rel="stylesheet" href="css/ie.css" type="text/css" /><![endif]-->
    <?php if (isset($this->slimbox) and $this->slimbox): ?><script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="slimbox/js/slimbox2.js"></script>
    <link rel="stylesheet" href="slimbox/css/slimbox2.css" type="text/css" /><?php endif; ?>
    <?php if ($this->printer): ?><link rel="stylesheet" href="css/print.css" type="text/css" media="print" /><?php endif; ?>   
</head>
<body>
<?php if ($this->template != "start"): ?>
<div id="header-wrapper">
<div id="header">
    <?php if ($this->back): ?>
        <?php if ($this->userid): ?>
        <?php else: ?>
        <?php endif; ?>
        <a class="home" title="Impressum" href="/test?id=impressum">Impressum</a>
        <a class="logout" title="Beenden" href="/logout/<?php echo $this->userid; ?>">Beenden</a>
        <a class="js" title="Zurück" href="javascript:history.back()">Zurück</a>
    <?php endif; ?>
    <?php if ($this->nav): ?><p><?php echo $this->nav; ?></p><?php endif; ?>
    <h1><?php echo BFT_Lang::header_title; ?></h1>
</div>
</div>
<?php endif; ?>
