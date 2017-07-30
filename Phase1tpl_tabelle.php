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
		
		if(session_is_registered('desc')){
			if ( isset($_SESSION['desc'])){
				$desc = $_SESSION['desc'];
			}
		}
		
	}else{
	 	//echo("Erzeuge Listen erstmalig<br>");
	 	if(isset($_GET["desc"])){
			if($_GET["desc"] == 'VS'){ //Präsenation Tabelle mit allen allen VS
				//gerettete Berufswege  +	
				$rescJobList = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOB');
				//entfernte Berufsfelder (mit und ohne gerettete Berufswege) = Vorraussetzung fuer
				$delJobFieldsList = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'D_JOBFIELD');
				//= Vollstreicher
				$fullDelJobFieldList = Evaluator::getFullDeletedBerufsfelder($session, $delJobFieldsList, $rescJobList);
				
				// Deleted Jobfields with rescued Jobs
				$delJobFieldWithRescJobsList = ListPreparatorUtil::generateListofDelJobFieldsWithRescJobs($delJobFieldsList, $fullDelJobFieldList);
				
				$actualList = ListPreparatorUtil::transformBerufsfeld2Markable($fullDelJobFieldList);
				$_SESSION['tabellenListe'] = $actualList;
				$_SESSION['desc'] = 'VS';
			}else{ //Präsentation mit Tabelle mit allen SG- maximal 10
			 	//echo("Erzeuge Listen erstmalig SG<br>");
			 
			 	//gerettete Berufswege  +	
				$rescJobList = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOB');
				//entfernte Berufsfelder (mit und ohne gerettete Berufswege) = Vorraussetzung fuer
				$delJobFieldsList = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'D_JOBFIELD');
			 
			 	// full deleted Jobfields = vollständig entfernte Berufsfelder (ohne gerettete Berufswege)
		 		$fullDelJobFieldList = Evaluator::getFullDeletedBerufsfelder($session, $delJobFieldsList, $rescJobList);
			 	// Deleted Jobfields with rescued Jobs
		 		$delJobFieldWithRescJobsList = ListPreparatorUtil::generateListofDelJobFieldsWithRescJobs($delJobFieldsList, $fullDelJobFieldList);
			 $actualList = ListPreparatorUtil::transformBerufsfeld2Markable($delJobFieldWithRescJobsList);
				$_SESSION['tabellenListe'] = $actualList;
				$_SESSION['desc'] = 'SG';
			}
			
		}
	}
	
	/*$delJobFields = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'D_JOBFIELD');
		echo('rescJobList::<br>');
		echo($delJobFields->__toString());
		foreach($delJobFields as $job){
			print_r($job);
			echo("<br>");
			//echo("--".$job->getPhase());
		}
		$rescJobList = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOB');
		print_r($rescJobList);
		echo("<br>");
		$fullDelJobFieldList = Evaluator::getFullDeletedBerufsfelder($session, $delJobFields, $rescJobList);
		print_r($fullDelJobFieldList);
		$delJobFieldWithRescJobsList = ListPreparatorUtil::generateListofDelJobFieldsWithRescJobs($delJobFields, $fullDelJobFieldList);
		echo("<br>");
		print_r($delJobFieldWithRescJobsList);
		echo("<br>");
		echo("<br>markList: <br>"); echo("<br>");
		$actualList = ListPreparatorUtil::transformBerufsfeld2Markable($delJobFieldWithRescJobsList);
		print_r($actualList);*/
		
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
    	$newfullDelJobFieldList = new Joblist($session->getPhase(), $session->getRun(), 'D_JOBFIELD_FULL');
    	//unmarkedList
    	$newRescJobFieldList= new Joblist($session->getPhase(), $session->getRun(), 'R_JOBFIELD');
	
    
    
    foreach($actualList as $markebleEntry){
     	
     	if(trim($markebleEntry->getName()) == trim($beruf)){
					//echo("!!!mark!!!!");
					$markebleEntry->remark();
		}
     	
		if($markebleEntry->isMarked()){ 
		 	$i++;
		 	
		 	$newfullDelJobFieldList->addBeruf($markebleEntry);
		}else{
			$newRescJobFieldList->addBeruf($markebleEntry);
		}
		 	//echo(" i: ".$i);
	}
	
	$infoText = '';
	if($desc == 'SV'){
	 	$nrVS = $fullDelJobFieldList->getNumberOfJobs();
		$bound = (8 - $nrVS);
	}else{
		$bound = 8;
	}
	if($i == $bound){
	 
	 	//old status
	 	$delJobFields = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'D_JOBFIELD');
	 	$infoText .= ListInfo::printMoreListInfo($delJobFields);
	 	
	 	$rescJobList = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOB');
	 	$fullDelJobFieldList = Evaluator::getFullDeletedBerufsfelder($session, $delJobFields, $rescJobList);
	 	$infoText .= ListInfo::printMoreListInfo($fullDelJobFieldList);
	 
	 	if($desc == 'SV'){
			//Bei VollstreicherWahl: die Acht bleiben Vollstreicher - der Rest gerettet
	 			//schauen wie die deletedListe verändert werden muss -> welche Vollstreicher hinzufügen?
	 		$infoText .='List of JobFields choosed NOW to be full deleted:<br>';
	 		$newfullDelJobFieldList = ListPreparatorUtil::transformMarkable2Berufsfeld($newfullDelJobFieldList);
	 		$infoText .= ListInfo::printMoreListInfo($newfullDelJobFieldList);
	 		
	 		//a list of not deletedJobFields
	 		$newListOfJobFieldstoNotDelete = new JobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'NOT_DEL_JOBFIELD');
	 		$newListOfJobFieldstoNotDelete = ListPreparatorUtil::fillUpDeletedJobFieldsWithFullDeletedJobFields($fullDelJobFieldList, $newfullDelJobFieldList, $newListOfJobFieldstoNotDelete);
	 		
	 		$infoText .='List of JobFields choosed not to be deleted:<br>';
	 		$infoText .= ListInfo::printMoreListInfo($newListOfJobFieldstoNotDelete);
	 		
	 		$concatedList = new JobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOBFIELD');
	 		//aus der markierten Tabelle, Liste aller unmarkierten in normale Liste umwandeln
	 		$newRescJobFieldList = ListPreparatorUtil::transformMarkable2Berufsfeld($newRescJobFieldList);
	 		
	 		$concatedList = ListPreparatorUtil::concatLists($newRescJobFieldList, $newListOfJobFieldstoNotDelete, $concatedList);
	 		$rescJobFieldsList = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOBFIELD');
	 		$concatedList = ListPreparatorUtil::concatLists($rescJobFieldsList, $concatedList, $concatedList);
	 		$infoText .= ListInfo::printMoreListInfo($concatedList);
	 		
		}else{
		 	//Präsentation mit Tabelle mit allen SG- maximal 10. Alle VS stehen bereits zuvor als Streicher fest. Danach: Ende Phase 1
			$infoText .='List of JobFields choosed NOW to be SG:<br>';
	 		$newSGJobFieldList = ListPreparatorUtil::transformMarkable2Berufsfeld($newfullDelJobFieldList);
	 		$infoText .= ListInfo::printMoreListInfo($newSGJobFieldList);
	 		
	 		//a list of not deletedJobFields
	 		$newListOfJobFieldstoNotDelete = new JobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'NOT_DEL_JOBFIELD');
	 		$newListOfJobFieldstoNotDelete = ListPreparatorUtil::fillUpDeletedJobFieldsWithFullDeletedJobFields($fullDelJobFieldList, $newSGJobFieldList, $newSGJobFieldList);
	 		
	 		$infoText .='List of JobFields choosed not to be deleted:<br>';
	 		$infoText .= ListInfo::printMoreListInfo($newListOfJobFieldstoNotDelete);
	 		
	 		$concatedList = new JobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOBFIELD');
	 		//aus der markierten Tabelle, Liste aller unmarkierten in normale Liste umwandeln
	 		$newRescJobFieldList = ListPreparatorUtil::transformMarkable2Berufsfeld($newRescJobFieldList);
	 		
	 		$concatedList = ListPreparatorUtil::concatLists($newRescJobFieldList, $newListOfJobFieldstoNotDelete, $concatedList);
	 		$rescJobFieldsList = $session->getUser()->getJobList($session->getPhase(), ( $session->getRun() - 1 ), $enum_berufstyp = 'R_JOBFIELD');
	 		$concatedList = ListPreparatorUtil::concatLists($rescJobFieldsList, $concatedList, $concatedList);
	 		$infoText .= ListInfo::printMoreListInfo($concatedList);
		}
	 
	 	 	
	 	//print_r($newListOfJobFieldstoNotDelete);
	 	/*$newfullDelJobFieldList = ListPreparatorUtil::transformMarkable2Berufsfeld($newfullDelJobFieldList);
	 	$infoText .='List of JobFields choosed to be full deleted after Transform:<br>';
	 	$infoText .= $newfullDelJobFieldList->__toString();
	 	$infoText .= ListInfo::printListInfo($newfullDelJobFieldList);
	 	$infoText .= '<br>';
	 	$infoText .= '<br>';
	 	*/
	 	
	 	
	 	
	 	$infoText = '';
		$extraLink = '<a href="testPhase2tpl.php?info=4"><h3>Weiter zur Phase 2</h3></a>';
		//echo("boumce!");
	}
	
	
	include("Includes/view/tablePainter.php");
	
	
	$table = generateEliminationTable($actualList, $baselink);
	
	$data = array();
	
	$data['infoText'] = $infoText;
	$data['berufsfelder_table'] = $table;
	$data['UserInfos'] = $benutzerInfo;
	$data['currentStatus'] = $extraLink;
	$data['monitorInfos'] = $currentListInfos;
	
	
		// Include the main class, the rest will be automatically loaded
		include 'Includes/dwoo/dwooAutoload.php'; 
 
		// Create the controller, it is reusable and can render multiple templates
		$dwoo = new Dwoo();
		
		// Output the result ... 
		$dwoo->output('Includes/template/phase1.tpl', $data);

	
?>