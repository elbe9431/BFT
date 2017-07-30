<?php
	include("Includes/header_templ.php");
	
	include("Includes/model/Berufsweg.php");
	include("Includes/model/BerufswegWahlGenerator.php");
	
	
	if(session_is_registered('relevante')){
	 	
		if($_SESSION['relevante']){
		 	//echo("got relevante");
			$relevanteBerufsfelder = $_SESSION['relevante'];
			//print_r($relevanteBerufsfelder);
		}
	}else{
		$rescJobFields = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOBFIELD');
		
		$relevanteBerufsfelder = $rescJobFields->getBerufeList();
		$_SESSION['relevante'] = $relevanteBerufsfelder;
	}
	
	$berufsWahl = new BerufswegWahlGenerator();
	if(count($relevanteBerufsfelder) >= 1){
				//$berufswege = $rescJobFields->getBerufeList();
			
			if($berufsWahl->getListChanged()){
			 	//echo("<br />");
			 	//echo("getListChanged array shift<br />");
				$trash = array_shift($relevanteBerufsfelder);
				if(count($deletedBerufsfelder) >= 1){
					$rescJobfieldID = $relevanteBerufsfelder[0];
				}
				
				$_SESSION['relevante'] = $relevanteBerufsfelder;
			}else{
			 	//echo("<br />");
			 	//echo("take Bf ID<br />");
				$rescJobfieldID = $relevanteBerufsfelder[0];
				$_SESSION['relevante'] = $relevanteBerufsfelder;
			}
			
	}
	
	include("Includes/model/BerufswegBundleCreator.php");
	
	if(session_is_registered('currentBerufe')){
		if($_SESSION['currentBerufe']){
			$currentBerufe = $_SESSION['currentBerufe'];
		}
	}else{
		$currentBerufe = array();
		$nr=0;
		foreach($relevanteBerufsfelder as $berufsfeld){
		 echo("<br />");
			 	echo("loadBundle4Berufsfeld for ID ".$berufsfeld."<br />");
			$berufe = (BerufswegBundleCreator::getInstance()->loadBundle4Berufsfeld($berufsfeld));
			$currentBerufe[] = $berufe[$nr]->getName();
			echo("getName() ".$berufe[$nr]->getName()."<br />");
			$_SESSION['currentBerufe'] = $currentBerufe;
		}
	}
	
	if(session_is_registered('table_berufe')){
	 	
		if(isset($_SESSION['table_berufe'])){
			$table_berufe = $_SESSION['table_berufe'];
			
		}
	}else{
			$table_berufe = array();
			$_SESSION['table_berufe'] = $table_berufe;
		
	}
	
	//print_r($relevanteBerufsfelder);
	
	
	
	
	$beruf = '';
	$baselink = $_SERVER["SCRIPT_NAME"];
	$dynamisch = 1;
	
	foreach($currentBerufe as $key=>$berufname){
	 	$entry = '<a style="color: blue; font-family: Arial; " href="'.$baselink.'?beruf='.$berufname.'">'.$berufname.'</a>';
	 	$dynamisch = ($key + 1);
	 	//echo("key: ".$key." key+1: ".($key + 1)." <br />");
	 	//echo("entry: ".$entry." <br />");
	 	//echo(" ".$dynamisch." mit Wert ".$berufname."<br>");
		${box.$dynamisch} = $entry;
		//$dynamisch++;
	}			
	
	//$berufswege = array();
	//foreach($berufe as $tberuf){
	//			$berufswege[] = $tberuf->getName();
	//}
	
	include("Includes/view/tablePainter.php");
	
	
	
				
	$link = $baselink;
	// doppelte Abfrage -> erst wird ein Beruf ausgewält -> Seite laden -> dann Button -> Seite laden
	if(isset($_GET["beruf"]) && !empty($_GET["beruf"])){
		$beruf = $_GET["beruf"];
		$link .= '?beruf='.$beruf;
		if(!in_array($beruf, $table_berufe)){
			$table_berufe[] = $beruf;
			$_SESSION['table_berufe'] = $table_berufe;
			$beruf_stelle = array_search($beruf, $currentBerufe);
			unset($currentBerufe[$beruf_stelle]);
			$_SESSION['currentBerufe'] = $currentBerufe;
		}	
		
		//$currentBerufe = array_values($currentBerufe);
		$dynamisch = 1;
		$dynamisch_array = array();
		foreach($currentBerufe as $key=>$berufname){
	 		$entry = '<a style="color: blue; font-family: Arial; " href="'.$baselink.'?beruf='.$berufname.'">'.$berufname.'</a>';
	 		$dynamisch = ($key + 1);
	 		
	 		
	 		//echo(" ".$dynamisch." mit Wert ".$berufname."<br>");
			${box.$dynamisch} = $entry;
			//$dynamisch++;
			$dynamisch_array[] = $dynamisch;
		}
		//print_r($dynamisch_array);
		for($i = 1; $i < 9; $i ++){
			if(in_array( $i, $dynamisch_array)){
				//echo(" ".$i." in array <br>");
			}else{
			 	//echo(" delete".$i." <br>");
				${box.$i} = '';
			}
		}		
	}
	
		
		
		$table = generateP2Table($berufswege=$table_berufe, $baselink = "alpha"); 
	
	
	// Include the main class, the rest will be automatically loaded
	include 'Includes/dwoo/dwooAutoload.php'; 
 
	// Create the controller, it is reusable and can render multiple templates
	$dwoo = new Dwoo();
				
				
	// Create some data
	$data = array('table'=>$table, 'UserInfos'=>$benutzerInfo, 'buttons'=>$buttons, 'UserChoice'=>$answer);
	$data['currentStatus'] = " current: ".$currentListInfos;
	$data['listenInfo'] = $params['listenInfo'];
	$data['infoText'] = '';
	$data['nextlink'] = $params['link'];
	$data['box1'] = $box1;
	$data['box2'] = $box2;
	$data['box3'] = $box3;
	$data['box4'] = $box4;
	$data['box5'] = $box5;
				
				
	// Output the result ... 
	$dwoo->output('Includes/template/phase2.tpl', $data);
	
?>