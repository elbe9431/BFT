<?php
	
	include("Includes/header_templ.php");
	
	include("Includes/model/Berufsweg.php");
	include("Includes/model/BerufswegWahlGenerator.php");

	require_once("Includes/util/ListPreparatorUtil.php");
	
	include_once("Includes/controller/Evaluator.php");
	
	/* Präsenation Tabelle mit allen allen VS - maximal 10. Danach: Ende Phase 1 (= Folie 17)
	oder
	Präsentation mit Tabelle mit allen SG- maximal 10. Alle VS stehen bereits zuvor als Streicher fest. Danach: Ende Phase 1 
	( = Folie 19)
	*/
	

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
	
	if(session_is_registered('tabellenListe')){
	 	//echo(" session->getPhase() ".$session->getPhase());
	 	//echo(" session->getRun() ".$session->getRun());
	 
		if ( isset($_SESSION['tabellenListe'])){
			$actualList = $_SESSION['tabellenListe'];
		}
		
		/*if(session_is_registered('desc')){
			if ( isset($_SESSION['desc'])){
				$desc = $_SESSION['desc'];
			}
		}*/
		
	}else{
	 	echo("Erzeuge Listen erstmalig<br>");
	 	//gerettete Berufswege  +	
		$rescJobList = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOBFIELD');
	 	$actualList = ListPreparatorUtil::transformBerufsfeld2Markable($rescJobList);
		$_SESSION['tabellenListe'] = $actualList;
		
	
	}
	
		
		include_once("Includes/view/ListInfo.php");

	
		$currentListInfos='';
	$delJobFields = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'D_JOBFIELD');
	$currentListInfos .= ListInfo::printListInfo($delJobFields);
	$rescJobs = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOB');
	$currentListInfos .= ListInfo::printListInfo($rescJobs);
	$rescJobFields = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOBFIELD');
	$currentListInfos .= ListInfo::printListInfo($rescJobFields);
	//echo("<br>".$currentListInfos);
	
	
	if($_GET["beruf"]){
			$beruf = $_GET["beruf"];
    }
    //bei Präsentation aller Vollstreicher 8 auswählen
    //wurden 8 ausgewählt?
    $i = 0;
    
    
		//markedList
    	$newDelJobFieldList = new Joblist($session->getPhase(), $session->getRun(), 'EXTRA_DEL_JOBFIELD');
    	//unmarkedList
    	$newRescJobFieldList= new Joblist($session->getPhase(), $session->getRun(), 'R_JOBFIELD');
	
    
    
    foreach($actualList as $markebleEntry){
     	//print_r($markebleEntry);echo('<br>');
     	if(trim($markebleEntry->getName()) == trim($beruf)){
					//echo("!!!mark!!!!");
					$markebleEntry->remark();
		}
     	
		if($markebleEntry->isMarked()){ 
		 	$i++;
		 	//echo(" --".$markebleEntry->toString()."-- ");
		 	$newDelJobFieldList->addBeruf($markebleEntry);
		}else{
			$newRescJobFieldList->addBeruf($markebleEntry);
		}
		 	//echo(" i: ".$i);
	}
	
	$infoText = '';
	//Aus allen R genau (8 - (VS+SG))
	$delJobFields = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'D_JOBFIELD');
	$vsAndsg = $delJobFields->getNumberOfJobs($delJobFields);
	$bound = (8 - $vsAndsg);
	if($i == $bound){
	 
	 	
	 	
	 	$infoText .= ListInfo::printMoreListInfo($delJobFields);
	 	//neue Liste mit Berufsfeldern die zusätzlich gestrichen werden sollen
	 	$newDelJobFieldList = ListPreparatorUtil::transformMarkable2Berufsfeld($newDelJobFieldList);
	 	$infoText .= ListInfo::printMoreListInfo($newDelJobFieldList);
	 	
	 	$_SESSION['extraDelList'] = $newDelJobFieldList;
	 	
	 	//neue Liste der relevanten Berufsfelder
	 	$newRescJobFieldList = ListPreparatorUtil::transformMarkable2Berufsfeld($newRescJobFieldList);
	 	$session->getUser()->getTestParameter()->addListe($newRescJobFieldList);
	 	
	 	
	 	
	 	
	 	
	 	
	 	$infoText = '';
		$extraLink = '<a href="phase1_tpl_tabRel_ne.php?info=4"><h3>Weiter (noch welche Retten?)</h3></a>';
		//echo("boumce!");
	}
	
	
	include("getTable_Phase1.php");
	$table = generateEliminationTable($actualList, $baselink);
	
	$data = array();
	
	$data['infoText'] = $infoText;
	$data['berufsfelder_table'] = $table;
	$data['UserInfos'] = $benutzerInfo;
	$data['buttons'] = $extraLink;
	
	
		// Include the main class, the rest will be automatically loaded
		include 'Includes/dwoo/dwooAutoload.php'; 
 
		// Create the controller, it is reusable and can render multiple templates
		$dwoo = new Dwoo();
		
		// Output the result ... 
		$dwoo->output('Includes/template/phase1.tpl', $data);

	
?>