<?php
	include("Includes/header_templ.php");
	
	include("Includes/model/Berufsweg.php");
	include("Includes/model/BerufswegWahlGenerator.php");
	
	require_once("Includes/util/ListPreparatorUtil.php");


	if(session_is_registered('extraDelList')){
		if ( isset($_SESSION['extraDelList'])){
			$actualList = $_SESSION['extraDelList'];
			
			
			
		}
	}else{
	 	
	}

	if(session_is_registered('hitJob')){
		if ( isset($_SESSION['hitJob'])){
			$hitJob = $_SESSION['hitJob'];
		}
	}else{
	 	
	}

	//print_r($actualList);

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

	$beruf = '';
	$baselink = $_SERVER["SCRIPT_NAME"];
				
	$link = $baselink;
	// doppelte Abfrage -> erst wird ein Beruf ausgewält -> Seite laden -> dann Button -> Seite laden
	
	$error = false;
	if($_GET["beruf"] && $_GET["current"]){
		$error = 'Sie können entweder alle Berufe verwerfen oder ein Beruf retten';
		$info .= $error;
	}
	
	if($_GET["beruf"]){
		$beruf = $_GET["beruf"];
		$link .= '?beruf='.$beruf;
		
		if(!$error){
			$extraLink = '<p><a href="phase1_tpl_tabRel_ne.php?info=4"><h3>No</h3></a>';
			$extraLink .= '<a href="phase1_tpl_tabRel_ne.php?choice=ok"><h3>OK</h3></a></p>';
		}
		/*if($hitJob == $beruf)echo("hooo");
		
		$info = $hitJob;
		$_SESSION['hitJob'] = $beruf;*/
	}
	if($_GET["current"]){
		if(!$error){
			$extraLink = '<p><a href="phase1_tpl_tabRel_ne.php?info=4"><h3>No</h3></a>';
			$extraLink .= '<a href="phase1_tpl_tabRel_ne.php?choice=ok"><h3>OK</h3></a></p>';
		}
	}
	
	
	$tempArray = $actualList->getBerufeList();
	if($_GET["choice"]){
		if($_GET["choice"] == 'ok'){
			
			$trash = array_shift($tempArray);
			$actualList->setBerufeList($tempArray);
			$_SESSION['extraDelList'] = $actualList;
				
		}
	}
	$actBerufsfeldID = '';
	if(count($tempArray) >= 1){
	 
			$actBerufsfeldID = $tempArray[0];
			include("Includes/model/BerufswegBundleCreator.php");
			$berufswege = (BerufswegBundleCreator::getInstance()->loadBundle4Berufsfeld($actBerufsfeldID));
			$delJobsTemp = new Joblist($session->getPhase(), $session->getRun(), 'EXTRA_DEL_JOBS_TEMP');
			$delJobsTemp->setBerufeList($berufswege);		
			$delJobsTemp = ListPreparatorUtil::transformBerufsWege2Markable($delJobsTemp);
			
			foreach($delJobsTemp as $markebleEntry){
     	
     			if(trim($markebleEntry->getName()) == trim($beruf)){
					
					$markebleEntry->remark();
				}
			}
			include("Includes/view/tablePainter.php");
			$table = generateMarkableTable($delJobsTemp, $baselink);		
	}else{
	 	$buttonOverride = '<a href="phase2_tpl.php?choice=ok"><h3>Weiter zu Phase 2</h3></a></p>';
	}
	

	if(!$beruf == ''){
		$and ='&';
	}else{
		$and ='?';
	}

	$buttons ='';
	$buttons .='<ul>';
	$buttons .='<li><a href="'.$link.$and.'current=1">';
	$buttons .='<b>Alle Streichen!</b>';
	$buttons .='</a>';
	$buttons .='</li>';
	$buttons .='</ul>';
	
	$buttons .= $extraLink;
	
	if($buttonOverride){
		$buttons = $buttonOverride;
	}

	// Include the main class, the rest will be automatically loaded
	include 'Includes/dwoo/dwooAutoload.php'; 
 
	// Create the controller, it is reusable and can render multiple templates
	$dwoo = new Dwoo();
				
				
	// Create some data
	$data = array('berufsfelder_table'=>$table, 'UserInfos'=>$benutzerInfo, 'buttons'=>$buttons);
	$data['infoText'] = $info; //$params['infoText'];
		$data['nextlink'] = $nextLink;
			/*	
				$data['currentStatus'] = " current: ".$currentListInfos;
				$data['listenInfo'] = $params['listenInfo'];
				$data['infoText'] = $params['infoText'];
				$data['nextlink'] = $params['link'];*/
				
				
	// Output the result ... 
	$dwoo->output('Includes/template/phase1.tpl', $data);	
?>