<?php include("./Includes/header_phase1.php"); ?>

<?php include_once 'Includes/model/job-list.php'; ?>

<body>
		<div id="site">
    		<div id="kopf">
      			[Kopfteil]
      			<?php
					if(!$user){
							$user = new User(1, 2);
					}else{
						echo("User still alive");
					}
	
				?>
    		</div>
    		<div id="main">
    		
    		
    		
      			
      			
      			<div id="inhalt">
      			
      			</br>
      				
      				
					 <?php
					 
					 	if(session_is_registered('trigger')){
							if ( isset($_SESSION['trigger']) && $_SESSION['trigger'] > 0 ){	 	
								$trigger = $_SESSION['trigger'];
								echo("jaaa");		
							}	
						}
						
						if(session_is_registered('list')){
							if ( isset($_SESSION['list']) && $_SESSION['list'] > 0 ){	 	
								$newlist = $_SESSION['list'];
								echo("jaaa");		
							}	
						}	 
					 
					 	echo("Entscheidung: ".$trigger);
					 	if($trigger == 3){
					 	
					 	 	$db = DBmod::getInstance();
							
							 	echo("jepp");
								foreach($newList->getBerufeList() as $beruf){
										if ($stmt = $db->prepare("SELECT name FROM Berufsfeld WHERE id = ? ")) {
										 	
										
												
											/* bind parameters for markers */
											$stmt->bind_param("i", $beruf);
											
											/* execute query */
											$stmt->execute();
											$stmt->store_result();
								
											/* bind result variables */
											$stmt->bind_result($name);
											
											$stmt->fetch();
											
											$stmt->close(); 
										}
										echo($name);
								}
							
						}	
					  	
      						echo(	'<table id="box-table-a" summary="Employee Pay Sheet">
    								<thead>
				    				<tr>
				        			<th scope="col">Studium</th>
				            		<th scope="col">Ausbildung</th>
				       				 </tr>
				    				</thead>
				    				<tbody>');
    						$half = $i/2;
							//echo $half;
			
							for($a = 0; $a < $i/2; $a++){
								
								echo('<tr><td><a href="'.$baselink.'?beruf='.$berufe[$a].'">'.$berufe[$a]);
								echo('</a></td><td><a href="'.$baselink.'?beruf='.$berufe[$half].'">'.$berufe[$half++].'</a></td></tr>');
							}
								echo("</tbody></table>");
					?>
      				
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