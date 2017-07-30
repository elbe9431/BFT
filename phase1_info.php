<?php include("./Includes/header_phase1_a.php"); ?>

<?php

	if($session->getUser()){
			echo("Benutzer mit Id: ".$session->getUser()->getUserID()." - ");
			if($session->getPhase()){
				echo("Phase ".$session->getPhase()." - ");
				if($session->getBerufsfeldID()){
					echo("BerufsfeldID ".$session->getBerufsfeldID()."<br>");
				}
			}
	}


$info_text = 'Sie haben ('.$entBerufsfelder.') von 13 Themenfelder als im großen und ganzen okay bewertet.  Wir m�chten Sie bitten, diese Auswahl noch etwas zu ver�ndern. Der Test beruht darauf, dass Sie im zweiten Teil gen�gend verschiedene Themenfelder zur Auswahl haben.';

$info_text2='Wir zeigen Ihnen erneut die Themenfelder, welche Sie als im großen und ganzen okay bewertet haben. Bitte schauen Sie, ob es weitere Themenfelder gibt, bei welchen Sie Veränderungen für wünschenswert halten. Sie m�ssen in dieser Phase mindestens 3 Themenfelder im Test behalten. Bewerten Sie daher mindestens (y) Themenfelder neu!';		




?>


<body>
		<div id="site">
    		<div id="kopf">
      			[Kopfteil]
      			<?php
      					if(!$user){
							$user = new User(1, 2);
						}else{
							echo("User still alive");
						} ?>
      			
    		</div>
    		<div id="main">
    		
    		
    		
      			
      			
      			<div id="inhalt">
      			
      			</br>
      				<div id="info-text">
      					<?php
      					include("./Includes/model/InfoTextGenerator.php");
						if($_GET["info"]){
						 	//echo("get info=".$_GET["info"]);
							foreach(InfoTextGenerator::getInfoTexte($_GET["info"]) as $textItem){
								echo("<p>".$textItem->getInfo()." </p>");
							}
							echo("Run jetzt: ".$session->getRun());
							echo('<a href="phase1_bool1.php"><h3>info</h3></a>');
						}
      					?>
      				</div> <!-- end of info-text -->
      			</br>
      			
<?php ?>
				</div> <!-- end of inhalt -->
			</div> <!-- end of main -->
  		</div> <!-- end of site -->
  		<div id="footer">
    		[footer]
  		</div>
	</body>

</html>