<?php
	include("Includes/header_templ.php");
	
	include("Includes/model/Berufsweg.php");
	include("Includes/model/BerufswegWahlGenerator.php");


	//Session - User - Phase - Run - /BerufsfeldId
	$benutzerInfo = '';
	if($session->getUser()){
		
		$benutzerInfo = 'Benutzer mit Id: '.$session->getUser()->getUserID();	
		if($session->getPhase()){
	
			$benutzerInfo .= ' - Phase: '.$session->getPhase();
			
			$benutzerInfo .= ' - Run: '.$session->getRun();
			if($session->getBerufsfeldID()){
			
				$benutzerInfo .= ' - BerufsfeldID: '.$session->getBerufsfeldID();
			}
		}
	}
	
	if(session_is_registered('refresh')){
	 	
		$_SESSION['refresh'] = false;
	}else{
	 	
	}
	
	
	if(session_is_registered('relevanteArray')){
	 	
		if($_SESSION['relevanteArray']){
  			//echo("Bekomme Liste aus Session<br>");
			$relevanteBerufsfelder = $_SESSION['relevanteArray'];
			//if(count($relevanteBerufsfelder) >= 1){
				//$berufswege = $rescJobFields->getBerufeList();
			//	$rescJobfieldID = array_shift($relevanteBerufsfelder);
		
			//}
					
		}  
	}else{
	 	//echo("Erzeuge Listen erstmalig<br>");
		$rescJobFields = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOBFIELD');
		$relevanteBerufsfelder = $rescJobFields->getBerufeList();
		//if(count($relevanteBerufsfelder) >= 1){
		//$berufswege = $rescJobFields->getBerufeList();
		//	$rescJobfieldID = array_shift($relevanteBerufsfelder);
		
		//}
		
		$_SESSION['relevanteArray'] = $relevanteBerufsfelder;
	}
	
	
	
	$beruf = '';
	$baselink = $_SERVER["SCRIPT_NAME"];
				
	$link = $baselink;
	// doppelte Abfrage -> erst wird ein Beruf ausgewält -> Seite laden -> dann Button -> Seite laden
	if($_GET["beruf"]){
		$beruf = $_GET["beruf"];
		$link .= '?beruf='.$beruf;
	}
	
	$berufsWahl = new BerufswegWahlGenerator();	
	if($_GET["current"]){
			if($_GET["beruf"]){
				 	 	
			
				
				$answer = $berufsWahl->evaluateUserChoice($buttonChoice = $_GET["current"], $session, $beruf = $_GET["beruf"]);
				$link = $baselink;
				$beruf='';
			
			
			//$answer = BerufswegWahlGenerator::evaluateUserChoice($buttonChoice = $_GET["current"], $session, $beruf = $_GET["beruf"]);
			}else{
				//$answer = BerufswegWahlGenerator::evaluateUserChoice($buttonChoice = $_GET["current"], $session);
				$berufsWahl = new BerufswegWahlGenerator();
				$answer = $berufsWahl->evaluateUserChoice($buttonChoice = $_GET["current"], $session);
			}
					
	}
	
	include_once("Includes/view/ListInfo.php");
	$currentListInfos='';
	$delJobFields = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'D_JOBFIELD');
	$currentListInfos .= ListInfo::printListInfo($delJobFields);
	$rescJobs = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOB');
	$currentListInfos .= ListInfo::printListInfo($rescJobs);
	$rescJobFields = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOBFIELD');
	$currentListInfos .= ListInfo::printListInfo($rescJobFields);

		
	$totalNumb = ($delJobFields->getNumberOfJobs() + $rescJobFields->getNumberOfJobs());
	$params = array();
	
	
	if($beruf){
		$and ='&';
	}else{
		$and ='?';
	}
				 
				$buttons ='';
				$buttons .='<ul>';
				$buttons .='<li><a href="'.$link.$and.'current=1">';
				$buttons .='<b>Stimmt, Das Berufsfeld kann komplett gestrichen werden!</b>';
				$buttons .='</a>';
				$buttons .='</li>';
				$buttons .='<li><a href="'.$link.$and.'current=2">';
				$buttons .='<b>Stimmt, Ich möchte aber  einen der 10 Berufswege im Test behalten!</b>';
				$buttons .='</a>';
				$buttons .='</li>';
				
				$buttons .='<li><a href="'.$link.$and.'current=3">';
				$buttons .='<b>Stimmt nicht, Das Berufsfeld soll im Test bleiben!</b>';
				$buttons .='</a>';
				$buttons .='</li>';
				$buttons .='</ul>';
	
	
	include("Includes/model/BerufswegBundleCreator.php");
				
	//$berufe = (BerufswegBundleCreator::getInstance()->loadBundle4Berufsfeld($session->getBerufsfeldID()));
	
	if(count($relevanteBerufsfelder) >= 1){
				//$berufswege = $rescJobFields->getBerufeList();
			
			if($berufsWahl->getListChanged()){
				$trash = array_shift($relevanteBerufsfelder);
				if(count($relevanteBerufsfelder) >= 1){
					$rescJobfieldID = $relevanteBerufsfelder[0];
				}
				
				$_SESSION['relevanteArray'] = $relevanteBerufsfelder;
			}else{
				$rescJobfieldID = $relevanteBerufsfelder[0];
				$_SESSION['relevanteArray'] = $relevanteBerufsfelder;
			}
			
	}
	
	
	//foreach($rescJobFields as $rescJobfield){
		$berufe = (BerufswegBundleCreator::getInstance()->loadBundle4Berufsfeld($rescJobfieldID));
	//}
				
	$berufswege = array();
	foreach($berufe as $tberuf){
		$berufswege[] = $tberuf->getName();
	}
				
	include("Includes/view/tablePainter.php");
	
    if($totalNumb == 13){
     	$table='';
     	//include_once("Includes/view/ListInfo.php");
     	
     	/** save **/
		include("Includes/db/Serializer.php");
     	$succes = Serializer::getInstance()->serializeJobList($session->getUser(), $delJobFields);
     	if($succes)$table .= "<br>".$delJobFields->__toString()." erfolgreich gespeichert";
     	$succes = Serializer::getInstance()->serializeJobList($session->getUser(), $rescJobs);
     	if($succes)$table .= "<br>".$rescJobs->__toString()." erfolgreich gespeichert";
     	$succes = Serializer::getInstance()->serializeJobList($session->getUser(), $rescJobFields);
     	if($succes)$table .= "<br>".$rescJobFields->__toString()." erfolgreich gespeichert";
     	
     	
     	$buttons = '';
     	
     	//echo("<br>Endgültige Auswertung:<br>");
		include_once("Includes/controller/Evaluator.php");
		/** Evaluator returns link infoText and listenInfo in array**/
		$params = Evaluator::analyzePhaseOne($session); // Attention analyzePhaseOne inc run
		
		//$delJobFields = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'D_JOBFIELD');
		//$table .= ListInfo::printMoreListInfo($delJobFields);
		//$rescJobs = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOB');
		//$table .= ListInfo::printMoreListInfo($rescJobs);
		//$rescJobFields = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOBFIELD');
		//$table .= ListInfo::printMoreListInfo($rescJobFields);
		//echo(ListInfo::printMoreListInfo($rescJobFields));
		
	}else{
		$table = generateTable($berufswege, $baselink);
		//print_r($table);
	}
				
				
		// Include the main class, the rest will be automatically loaded
		include 'Includes/dwoo/dwooAutoload.php'; 
 
		// Create the controller, it is reusable and can render multiple templates
		$dwoo = new Dwoo();
				
				
		// Create some data
		$data = array('berufsfelder_table'=>$table, 'UserInfos'=>$benutzerInfo, 'buttons'=>$buttons, 'UserChoice'=>$answer);
		$data['currentStatus'] = $currentListInfos;
		$data['listenInfo'] = $params['listenInfo'];
		$data['infoText'] = $params['infoText'];
		$data['nextlink'] = $params['link'];
				
				
		// Output the result ... 
		$dwoo->output('Includes/template/phase1.tpl', $data);
	
?>