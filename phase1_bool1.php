<?php include("Includes/header_phase1_a.php"); ?>

<body>
		<div id="site">
    		<div id="kopf">
      			[Kopfteil]
    		</div>
    		<div id="main">
    		
    		<?php
				include("Includes/model/BerufswegWahlGenerator.php");
			
				$actualList = 'none';
				if(session_is_registered('list')){
 					if ( isset($_SESSION['list'])){
					  	//echo("save list");	 	
						$actualList = $_SESSION['list'];
						$list2iterate = clone $actualList;	
						$_SESSION['list'] = $list2iterate;
					}
				}else{
					//$this->phase = 1;
				}
			
			
				//Session - User - Phase - Run - /BerufsfeldId
				if($session->getUser()){
					echo("Benutzer mit Id: ".$session->getUser()->getUserID()." - ");
					if($session->getPhase()){
					 	echo("Phase ".$session->getPhase()." - ");
					 	echo("Run ".$session->getRun()." - ");
					 	if($session->getBerufsfeldID()){
							echo("BerufsfeldID ".$session->getBerufsfeldID()."<br>");
						}
						
						$session->initLists($session->getPhase(), $session->getRun());
					 }
				}
				
				$session->setBerufsfeldID(0);
				
				foreach($list2iterate->getBerufeList() as $geretteBerufsFeld){
					if($session->getBerufsfeldID() < $geretteBerufsFeld){
					 	echo("-> BerufsfeldID ".$session->getBerufsfeldID()." ");
					 	echo("Id of Iterate: ".$geretteBerufsFeld." <br>");
					 
						$session->setBerufsfeldID($geretteBerufsFeld);
						echo("-> BerufsfeldID ".$session->getBerufsfeldID()."<br>");
						
						break;
					}
				}
				
				
				if(/** auswahl getroffen? && g�ltig ?**/ true){
					//$session->incBerufsfeldID();
					if($session->getBerufsfeldID() > 13){
						// endg�ltige Auswertung
						echo("<br>Endg�ltige Auswertung:<br>");
						//BerufswegWahlGenerator::analyzePhaseOne($session);
						include_once("Includes/controller/Evaluator.php");
						Evaluator::analyzePhaseOne($session);
					}
				}
				/*			
				include("Includes/util/ObjectComparator.php");
				$liste = $session->getUser()->getJobList($phase = 1, ($session->getRun()-1), $enum_berufstyp = 'R_JOBFIELD');
				if(ObjectComparator::comparereferences($actualList, $liste)){
					echo("referenz!");
				};*/
			
				//Listen mitnehmen/erzeugen
				//BooleanFeld 1 -> alle erhaltenen Berufsfelder nochmal Pr�sentieren:
				//$geretteBerufsfelderListe = $session->getUser()->getJobList($phase, $run, $enum_berufstyp = 'R_JOBFIELD');
				//$actualList = $geretteBerufsfelderListe;
				// BerufsfeldID �ndern!
			
				
			
				
				
				
			   
				
				//$session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOBFIELD');
					//auswertung?
				
				//noch eine Tabelle f�r Phase 1 anzeigen?
					//mit content zu skeleton?
			 	
				$beruf = '';
				$baselink = 'phase1_bool1.php';
				$link = $baselink;
				// doppelte Abfrage -> erst wird ein Beruf ausgew�lt -> Seite laden -> dann Button -> Seite laden
				if($_GET["beruf"]){
					$beruf = $_GET["beruf"];
					$link .= '?beruf='.$beruf;
				}
				
				//is something changed
				
				
				$listChanged = false;
				if($session->getBerufsfeldID() != 0){
					if($_GET["current"]){
				 		if($_GET["beruf"]){
					 	 	//echo("<br>_GET[current]: ".$_GET["current"]."   _GET[beruf] ".$_GET["beruf"]."<br>");
					 	 	//$beruf = $_GET["beruf"];
							//$link .= '?beruf='.$beruf;
							$listChanged = BerufswegWahlGenerator::evaluateUserChoice($buttonChoice = $_GET["current"], $session, $beruf = $_GET["beruf"]);
			
						}else{
					 		//echo("<br>_GET[current]: ".$_GET["current"]."   No _GET[beruf] ".$_GET["beruf"]."<br>");
							$listChanged = BerufswegWahlGenerator::evaluateUserChoice($buttonChoice = $_GET["current"], $session);
							
						}
					
					}
				}
				
				
				// only if usefull action -> iterate List
				if($listChanged){
					$list2iterate->setBerufeList(array_slice($list2iterate->getBerufeList(), 1));
				}
				
				
				/** all information **/
				echo("<br>Phase $phase Run ".$session->getRun()." ");
				BerufswegWahlGenerator::getInfoText($session, $session->getRun());
				
				echo("<br>Phase $phase Run ".($session->getRun()-1)." ");
				BerufswegWahlGenerator::getInfoText($session, ($session->getRun()-1));
				
			
				
				include("Includes/model/BerufswegMapper.php");
				include("Includes/model/Berufsweg.php");
				
				$berufsweg = new Berufsweg();
				$berufsweg->load(2);
				//echo $berufsweg->getName();
				//$berufswegMapper = new BerufswegMapper();
				//$berufswegMapper->insert($berufsweg);
				include("Includes/model/BerufswegBundleCreator.php");
				
				$berufe = (BerufswegBundleCreator::getInstance()->loadBundle4Berufsfeld($session->getBerufsfeldID()));
				$berufswege = array();
				foreach($berufe as $tberuf){
					$berufswege[] = $tberuf->getName();
				}
			?>
    		
      			
      			
      			<div id="inhalt">
      			
      			</br>
      			
      			</br>
      			
      			</div> <!-- end of inhalt -->
      			
      			
      			<div id="info">
      			
      			
      			<?php 		echo($content);	?>
      			<?php include("getTable_Phase1.php"); ?>
      			
      			<?php generateTable($berufswege, 'phase1_bool1.php'); ?>
      			
      			
      			<?php
      			
      			if($beruf){
						echo('
						<ul>
						    <li><a href="'.$link.'&current=1">
								<b>Stimmt, Das Berufsfeld kann komplett gestrichen werden!</b>
								</a>
							</li>
							<li><a href="'.$link.'&current=2">
								<b>Stimmt, Ich m�chte aber  einen der 10 Berufswege im Test behalten!</b>
								</a>
							</li>
							<li><a href="'.$link.'&current=3">
								<b>Stimmt nicht, Das Berufsfeld soll im Test bleiben! </b>
								</a>
							</li>    
  						</ul>
						
						
						');
					}else{
						echo('
						<ul>
							<li><a href="'.$link.'?current=1">
								<b>Stimmt, Das Berufsfeld kann komplett gestrichen werden!</b>
								</a>
							</li>
							<li><a href="'.$link.'?current=2">
								<b>Stimmt, Ich m�chte aber  einen der 10 Berufswege im Test behalten!</b>
								</a>
							</li>
							<li><a href="'.$link.'?current=3">
								<b>Stimmt nicht, Das Berufsfeld soll im Test bleiben! </b>
								</a>
							</li>    
  						</ul>			
						');
					}
      			
      			?>
      			</div> <!-- end of info -->

    		</div>	<!-- end of main -->
  		</div>
  		
  		<div id="footer">
    		[footer]
  		</div>
</body>

</html>