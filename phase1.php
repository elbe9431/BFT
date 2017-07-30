<?php include("Includes/header_phase1_a.php"); ?>
<?php 
//include("Includes/model/TestParameter.php"); 
?>

<body>
		<div id="site">
    		<div id="kopf">
      			[Kopfteil]
    		</div>
    		<div id="main">
    		
    		<?php
    			include("Includes/model/Berufsweg.php");
				include("Includes/model/BerufswegWahlGenerator.php");
			
				//Session - User - Phase - Run - /BerufsfeldId
				if($session->getUser()){
					echo("Benutzer mit Id: ".$session->getUser()->getUserID()." - ");
					if($session->getPhase()){
					 	echo("Phase ".$session->getPhase()." - ");
					 	if($session->getBerufsfeldID()){
							echo("BerufsfeldID ".$session->getBerufsfeldID()."<br>");
						}
					 }
				}
				if(/** auswahl getroffen? && g�ltig ?**/ true){
					//$session->incBerufsfeldID();
					if($session->getBerufsfeldID() > 13){
						// endg�ltige Auswertung
						echo("<br>Endg�ltige Auswertung:<br>");
						include_once("Includes/controller/Evaluator.php");
						Evaluator::analyzePhaseOne($session);
						//BerufswegWahlGenerator::analyzePhaseOne($session);
					}
				}
							
				
				//Listen mitnehmen/erzeugen
				
					//auswertung?
				
				//noch eine Tabelle f�r Phase 1 anzeigen?
					//mit content zu skeleton?
			 	
				$beruf = '';
				$baselink = $_SERVER["SCRIPT_NAME"];
				//$baselink = 'a.php';
				$link = $baselink;
				// doppelte Abfrage -> erst wird ein Beruf ausgew�lt -> Seite laden -> dann Button -> Seite laden
				if($_GET["beruf"]){
					$beruf = $_GET["beruf"];
					$link .= '?beruf='.$beruf;
				}
				
				if($_GET["current"]){
				 	if($_GET["beruf"]){
				 	 	
				 	 	//$beruf = $_GET["beruf"];
						//$link .= '?beruf='.$beruf;
						BerufswegWahlGenerator::evaluateUserChoice($buttonChoice = $_GET["current"], $session, $beruf = $_GET["beruf"]);
					}else{
						BerufswegWahlGenerator::evaluateUserChoice($buttonChoice = $_GET["current"], $session);
					}
					
				}
				
				/** all information **/
			
				$delJobFields = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'D_JOBFIELD')->getBerufeList();
				echo("<br>Bisher gel�schte Berufsfelder: ");
				if(!empty($delJobFields)){
					foreach($delJobFields as $deljobfield){
						echo("$deljobfield :: ");
					}
				}
				echo("<br>");
				
				$rescJobs = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOB')->getBerufeList();
				echo("<br>Bisher gerettete Berufswege: ");
				if(!empty($rescJobs)){
					foreach($rescJobs as $rescJob){
						echo("$rescJob :: ");
					}
				}
				echo("<br>");
				
				$rescJobFields = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = 'R_JOBFIELD')->getBerufeList();
				echo("<br>Bisher gerettete Berufsfelder: ");
				if(!empty($rescJobFields)){
					foreach($rescJobFields as $rescJobField){
						echo("$rescJobField :: ");
					}
				}
				echo("<br>");
			
				
				
				//echo('<a href="b.php"><h3>info</h3></a>');
				
				
				include("Includes/model/BerufswegMapper.php");
			
				
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
      			
      			<?php generateTable($berufswege, $baselink); ?>
      			
      			
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