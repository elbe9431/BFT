<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>blue print allboxes 2</title>
	
	
	<link href="../paartherapietest/Includes/styles/default.css" rel="stylesheet" type="text/css" />
	<link href="../paartherapietest/Includes/styles/table_1.css" rel="stylesheet" type="text/css" />
	<link href="../paartherapietest/Includes/styles/phase1.css" rel="stylesheet" type="text/css" />
	<link href="../paartherapietest/Includes/styles/phase1_info.css" rel="stylesheet" type="text/css" />

	<style type="text/css">

		#box-table-a {
			font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
			font-size: 12px;
			margin: 45px;
			width: 300px; /* 480px; */
			text-align: left;
			border-collapse: collapse;
			
			position: absolute;
	  		left: -30px;
	  		top:  -30px; /* 175px; */
	  		width: 360px;
	  		height: 195px;
		}
		#box-table-a th
		{
			font-size: 13px;
			font-weight: normal;
			padding: 8px;
			
			/* color*/
			background: #FFFF00; /* #b9c9fe;*/
			border-top: 4px solid #FFE500; /* #aabcfe; */
			border-bottom: 1px solid #fff;
			color: #FFB200; /* #039; */
		}
		#box-table-a td
		{
			padding: 8px;
			
			background: #FFFF99; /* #e8edff; */
			border-bottom: 1px solid #fff;
			color: #E5B200; /*#669; */
			border-top: 1px solid transparent;
		}
		#box-table-a tr:hover td
		{
			background: #CCFF00; /* #d0dafd; */
			color: #E5B200; /* #339; */
		}


	</style>

		
</head>



<body>

<?php include("Includes/model/BerufswegMapper.php"); ?>
<?php include("Includes/model/Berufsweg.php"); ?>
<?php
	require_once("Includes/db/DBmod.php");
	$berufsweg = new Berufsweg();
	$berufsweg->load(1);
	//echo $berufsweg->getName();
	//echo $berufsweg->getBerufstaetigkeit();
	
	$berufsweg2 = new Berufsweg();
	$berufsweg2->load(2);
	//echo $berufsweg2->getName();
?>

<div id="A">
<?php  
		echo('<a href="'.'phase2_pre.php'.'?beruf='.$berufsweg->getName().'">'.$berufsweg->getName().'</a>'); ?>
</div>

<div id="B">
<?php 
		echo('<a href="'.'phase2_pre.php'.'?beruf='.$berufsweg2->getName().'">'.$berufsweg2->getName().'</a>'); ?>
</div>

<div id="C">

	
	<div id="info">
	<?php 
		include("getTable_Phase1.php");
		$berufswege = array("beruf1", "beruf2", "beruf3", "beruf4", "beruf5", "beruf6");
		if(isset($_GET["beruf"]) && !empty($_GET["beruf"]))
		{
	    	$beruf = $_GET["beruf"];
	    	$berufswege[1] = $beruf;
		} 
		
		
		generateP2Table($berufswege=$berufswege, $baselink = "alpha"); 
	?>
	</div>
</div>


<div id="D">
Beruf H
</div>

<div id="E">
Beruf D
</div>

<div id="F">
Beruf A
</div>



<div id="H">
Beruf E
</div>

<div id="I">
Beruf F
</div>



</body>
</html>