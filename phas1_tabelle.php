<?php include("Includes/header_phase1_a.php"); ?>


<body>
		<div id="site">
    		<div id="kopf">
      			[Kopfteil]
    		</div>
    		<div id="main">
    		<?php
    			//include("Includes/model/Berufsweg.php");
				//include("Includes/model/BerufswegWahlGenerator.php");
    			require_once("Includes/model/Berufsfeld.php");
    			require_once('./Includes/model/Collection.php');
    			require_once('./Includes/model/job-list.php');
    			require_once("Includes/util/ListPreparatorUtil.php");
    			//require_once('./Includes/model/MarkableEntry.php');
    			
    		
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
    		
    			$actualList = 'none';
				if(session_is_registered('list')){
 					if ( isset($_SESSION['list'])){
					  	echo("save list");
						  /** hier sollte eine Liste ankommen**/	 	
						$actualList = $_SESSION['list'];
						//$actualList = ListPreparatorUtil::transformBerufsfeld2Markable($actualList);
						//$list2iterate = clone $actualList;	
						
					}
				}else{
					//$this->phase = 1;
					$actualList = $session->getUser()->getJobList($session->getPhase(), $session->getRun(), $enum_berufstyp = '_extra_');
					$actualList->addBeruf(1);
					$actualList->addBeruf(2);
					
					$actualList = ListPreparatorUtil::transformBerufsfeld2Markable($actualList);
					echo("liste:> <br><br>"); print_r($actualList); echo("<br><br> liste:>");
					$_SESSION['list'] = $actualList;
						echo("session");
					
				}
				
				if($_GET["beruf"]){
					$beruf = $_GET["beruf"];
					foreach($actualList as $markebleEntry){
					 echo("w: ".$markebleEntry->getName()." ");
						if($markebleEntry->getName() == $beruf){
						 	echo("mark");
							$markebleEntry->remark();
						}
					}
    			}
    			
    		
    		?>
      			
      			
      			<div id="inhalt">
      			
      			</br>
      			
      			</br>
      			
      			</div> <!-- end of inhalt -->
      			
      			
      			<div id="info">
      			
      					<?php include("getTable_Phase1.php"); ?>
      					<?php
      						
      					
      						echo(generateEliminationTable($actualList, $baselink));
      						
      					?>
      					<?php  ?>
      					
      			</div> <!-- end of info -->

    		</div>	<!-- end of main -->
  		</div>
  		
  		<div id="footer">
    		[footer]
  		</div>
</body>

</html>