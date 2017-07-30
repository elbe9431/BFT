<?php
	include("Includes/header_templ.php");
	include_once("Includes/controller/Evaluator.php");
	
	if(session_is_registered('refresh')){
		if(!$_SESSION['refresh']){
  			Evaluator::incRun($session);
	 		$session->setBerufsfeldID(1);
			$_SESSION['refresh'] = true;
  			//echo("refresh wasn't filled'");
		}
		
	}else{
	 	Evaluator::incRun($session);
	 	$session->setBerufsfeldID(1);
		$_SESSION['refresh'] = true;
		//echo("new refresh");
	}
	
	
	
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
	
	
	include("./Includes/model/InfoTextGenerator.php");
	$content = '';
	$nextLink = '';
	if($_GET["info"]){
						 	
			foreach(InfoTextGenerator::getInfoTexte($_GET["info"]) as $textItem){
					$content.=("<p>".$textItem->getInfo()." </p>");
			}
			//$content.=("Run jetzt: ".$session->getRun());
			//$content.=('<a href="phase1_bool1.php"><h3>info</h3></a>');
			
			
			switch($_GET["info"]){
				case 1:
					$nextLink = '<a href="Phase1tpl_nurRelevante.php"><h3>weiter</h3></a>';
					break;
				case 2:
					$nextLink = '<a href="Phase1tpl_nurVSundSG.php"><h3>weiter</h3></a>';
					break;
				case 3:
					//if($_GET["desc"]){
					//	if($_GET["desc"] == 'VS'){
							$nextLink = '<a href="Phase1tpl_tabelle.php?desc=VS"><h3>weiter</h3></a>';
					//	}else{
						
					//	}
					//}
					
					break;
				case 4:
					$nextLink = '<a href="Phase1tpl_tabelle.php?desc=SG"><h3>weiter</h3></a>';
					break;
				case 5:
					$nextLink = '<a href="Phase1tpl_tabelle_relevante.php"><h3>weiter</h3></a>';
					break;	
					
			}
	}
	
	include_once("Includes/view/ListInfo.php");
	/*
	$currentListInfos='';
				$delJobFields = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'D_JOBFIELD');
				$currentListInfos .= ListInfo::printListInfo($delJobFields);
				$rescJobs = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOB');
				$currentListInfos .= ListInfo::printListInfo($rescJobs);
				$rescJobFields = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOBFIELD');
				$currentListInfos .= ListInfo::printListInfo($rescJobFields);
    			echo($currentListInfos);
    			echo('<br />');
    			echo($phase = $delJobFields->getPhase());
    			echo('<br />');
				echo($berufsTyp = $delJobFields->getBerufsTyp());
				echo('<br />');
				echo($run = $delJobFields->getRun());
	*/
	
	// Include the main class, the rest will be automatically loaded
	include 'Includes/dwoo/dwooAutoload.php'; 
 
	// Create the controller, it is reusable and can render multiple templates
	$dwoo = new Dwoo();
	
	$rescJobFields = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOBFIELD');
	$rescJobFieldsNumb = $rescJobFields->getNumberOfJobs();
	//$rescJobFieldsNumb = 12;
	$ReOverTen = $rescJobFieldsNumb - 10;
	$ReOverEight = $rescJobFieldsNumb - 8;
	
	$databaseVar = array("%Re%", "%ReOverEight%", "%ReOverTen%");
	$replaceVar = array("20", $ReOverEight, $ReOverTen);
	$content = str_replace($databaseVar, $replaceVar, $content);
	
	$data = array();
	$data['UserInfos'] = $benutzerInfo;
	$data['content'] = $content;
	$data['nextLink'] = $nextLink;
	
	
	// Output the result ... 
	$dwoo->output('Includes/template/phase1_info.tpl', $data);


?>