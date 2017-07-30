<?php include("./Includes/header.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>seite mit footer</title>
	<head>
	
	<link href="../paartherapietest/Includes/styles/table_1.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
	
	
	
	html,body {
      margin: 0;
      padding: 0;
      height: 100%;
    }
    #site {
      min-height: 100%;
      margin: 0 50px;
      background: #ffea00;
      border-left: 2px solid #ff9800;
      border-right: 2px solid #ff9800;
    }
    #main {
      padding-bottom: 3em;
    }
    #footer {
      background: #ff9800;
      height: 3em;
      margin-top: -3em;
      margin-left: 50px;
      margin-right: 50px;
    }
		A:link {text-decoration: none; color: #E5B200;}
		A:active {text-decoration: none; font-size: 14px;}
		
	
	#inhalt { 	
		height: 70%;
		text-align: left;
		margin:auto;
		padding: 35px;
		background-color: #dedede;
		/* border: 1px dotted black; */
		overflow: auto;
	}
	
	
		#info {height:400px;}
	
	
	.button {
		display:block;
		color:#FFFFFF;
		background-color:#98bf21;
		font-weight:bold;
		/*font-size:11px;*/
		width:320px;
		text-align:center;
		padding:0; padding-top:3px; padding-bottom:4px; /* padding:25px 0 100px 15px; *//* padding:0; padding-top:3px; padding-bottom:4px; */
		list-style:none;
		border:1px solid #ffffff;
		outline:1px solid #98bf21;
		text-decoration:none;
		margin-left:1px;
	}
	.button li {display:inline; float:left; margin-right:5px;}
	
	.button:hover {
		background-color:#7A991A;
	}

	a.tryitbtn,a.tryitbtn:link,a.tryitbtn:visited,a.showbtn,a.showbtn:link,a.showbtn:visited
	{
		display:block;
		color:#FFFFFF;
		background-color:#98bf21;
		font-weight:bold;
		font-size:11px;
		width:120px;
		text-align:center;
		padding:0;
		padding-top:3px;
		padding-bottom:4px;
		border:1px solid #ffffff;
		outline:1px solid #98bf21;
		text-decoration:none;
		margin-left:1px;
	}

	a.tryitbtn:hover,a.tryitbtn:active,a.showbtn:hover,a.showbtn:active
	{
		background-color:#7A991A;
	}
	
		
		
	</style>
	
	</head>
	
	
	
	
	
	<body>
		<div id="site">
    		<div id="kopf">
      			[Kopfteil]
    		</div>
    		<div id="main">
    		
    		
    		
      			
      			
      			<div id="inhalt">
      			
      			</br>
      			</br>
      			
<?php	include("./Includes/db/DBmod.php");

		$phase = 1;
		$run = 1;

		if(!$user){
			$user = new User(1, 2);
			//echo('No User before:new user<br>');
			
			
			//$user->addRescuedBerufsweg("swine");
			//echo("<br>getLastBerufsweg ".$user->getLastBerufsweg());
			//echo("<br>DeletedBerufsfeld ".$user->getDeletedBerufsfeld());
			
		}else{
			//echo("<br>User found: ".$user->getLastBerufsweg()."<br>");
			//echo("<br>User (getJobLists()): ".print_r($user->getJobLists())."<br>");
			/*
			foreach($user->getJobLists() as $joblist){
			 echo("foreach <br><br>");
			 print_r($joblist);
			 echo("<br><br>");
				foreach($joblist as $job){
				 	echo("::".$job."::");
				}
			}*/
		}
		
		
		//wenn user nicht über Listen verfügt - erzeugen! (um nicht immer überprüfen zu müssen)
		if($joblist = $user->getJobList($phase, $run, $enum_berufstyp = 'D_JOBFIELD')){
			
		}else{
			$user->addJobList(new Joblist($phase, $run, 'D_JOBFIELD'));
		}
		if($joblist = $user->getJobList($phase, $run, $enum_berufstyp = 'R_JOB')){
			
		}else{
			$user->addJobList(new Joblist($phase, $run, 'R_JOB'));
		}
		if($joblist = $user->getJobList($phase, $run, $enum_berufstyp = 'R_JOBFIELD')){
			
		}else{
			$user->addJobList(new Joblist($phase, $run, 'R_JOBFIELD'));
		}
		
		
								
		if(!$berufsfeld_id){
		 	//echo("flop:".$berufsfeld_id." ");
		 	echo("session".$berufsfeld_id." erzeugt");
			$berufsfeld_id = 1;
		}
		
		
		//begin to build link...
		$link = 'site_table_button2.php';
		
		if( $_GET["beruf"]){
			$beruf = $_GET["beruf"];
			$link .= '?beruf='.$beruf;
			//echo("session".$berufsfeld_id." gespeichert");
			//$_SESSION["berufsfeld_id"] = $berufsfeld_id;
		}
		
		if($_GET["current"]){
			
			switch ($_GET["current"]) {
				
				case 1:
				        echo "Stimmt, Das Berufsfeld kann komplett gestrichen werden!";
				        
				        $joblist = $user->getJobList($phase, $run, $enum_berufstyp = 'D_JOBFIELD');
				        if($berufsfeld_id == $joblist->getLastBeruf()){
							echo("already : ".$joblist->getLastBeruf()." in list");
						}else{
							/* jetzt speichern!*/
							$joblist->addBeruf($berufsfeld_id);
						}
				        $_SESSION["user"] = $user;
				        $berufsfeld_id++;
				    	$_SESSION["berufsfeld_id"] = $berufsfeld_id;
				        
				        
				        
				     			        
					break;
				case 2:
				        echo "Stimmt, Ich möchte aber  einen der 10 Berufswege im Test behalten!";
				        if($beruf){
				         	
				         	/** berufsweg **/
				         	$rJoblist = $user->getJobList($phase, $run, $enum_berufstyp = 'R_JOB');
				         	
				         	if($beruf == $rJoblist->getLastBeruf()){
								//echo("already : ".$rJoblist->getLastBeruf()." in list");
							}else{
								/* jetzt speichern!*/
								$rJoblist->addBeruf($beruf);
							}
							
							/** berufsfeld **/
							$djoblist = $user->getJobList($phase, $run, $enum_berufstyp = 'D_JOBFIELD');
							if($berufsfeld_id == $djoblist->getLastBeruf()){
								//echo("already : ".$djoblist->getLastBeruf()." in list");
							}else{
								/* jetzt speichern!*/
								$djoblist->addBeruf($berufsfeld_id);
							}
							
							$_SESSION["user"] = $user;
							$berufsfeld_id++;
				    		$_SESSION["berufsfeld_id"] = $berufsfeld_id;
				        		
						}else{
							$warning = 'Keinen Berufsweg ausgewählt';
						}
				        
					break;
				case 3:
				        echo "Stimmt nicht, Das Berufsfeld soll im Test bleiben!";
				        
				        $joblist = $user->getJobList($phase, $run, $enum_berufstyp = 'R_JOBFIELD');
				        if($berufsfeld_id == $joblist->getLastBeruf()){
							//echo("already : ".$joblist->getLastBeruf()." in list");
						}else{
							/* jetzt speichern!*/
							$joblist->addBeruf($berufsfeld_id);
						}
				    	$_SESSION["user"] = $user;
				    	$berufsfeld_id++;
				    	$_SESSION["berufsfeld_id"] = $berufsfeld_id;
				    break;
			}
		}
		
		

		echo ("berufsfeld_id ::".$berufsfeld_id);	

		
		$i = 0;
		
		if(trim(`hostname`) == 'icpu161__'){
			$mysql = new mysqli("db2511.1und1.de", "dbo331453744", "1astrid", "db331453744");
			if ($stmt = $mysql->prepare("SELECT title FROM Berufsweg WHERE berufsfeld_id = ? ")) 
			{ 
			    $stmt->bind_param('i', $berufsfeld_id);
			    $user_id = 1;
			    $user_id2 = 2; 
			    $stmt->execute(); 
			    $stmt->bind_result($title); 
			    while ($stmt->fetch()) {
				 	$berufe[$i] = $title;
				 	//$berufe[$i][$i] = $id;
				 	$i++; 				
					//echo $title." ".$i++;
				}
			    printf("Name: %s\n", $title); 
			    $stmt->close(); 
			}else{
				echo("bong");
			} 
		}else{
			$db = DBmod::getInstance();
			if ($stmt = $db->prepare("SELECT title FROM Berufsweg WHERE berufsfeld_id = ? ")) {
			 
				$berufsfeld_id = (int)$berufsfeld_id;
					
				/* bind parameters for markers */
				$stmt->bind_param("i", $berufsfeld_id);
				
				/* execute query */
				$stmt->execute();
				$stmt->store_result();
	
				/* bind result variables */
				$stmt->bind_result($title);
				
				
				$i = 0;
	    		$berufe = array();
				while ($stmt->fetch()) {
				 	$berufe[$i] = $title;
				 	//$berufe[$i][$i] = $id;
				 	$i++; 				
					//echo $title." ".$i++;
				}
				$stmt->close(); 
			}
		}
		
		if($i != 0){
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
				
				echo('<tr><td><a href="site_table_button2.php?beruf='.$berufe[$a].'">'.$berufe[$a]);
				echo('</a></td><td><a href="site_table_button2.php?beruf='.$berufe[$half].'">'.$berufe[$half++].'</a></td></tr>');
			}
			echo("</tbody></table>");
			
			$_SESSION["berufsfeld_id"] = $berufsfeld_id;
		}
		
    	
	?>
      			</br>
      			</br>
      			</br>
      			</br>
      			[Hauptteil]
      			
      		
      			
      			
      			</div> <!-- end of inhalt -->
      			
      			<div id="info">

				
				<?php //build link! 
					if($beruf){
						echo('
						<ul>
						    <li><a href="'.$link.'&current=1">
								<b>Stimmt, Das Berufsfeld kann komplett gestrichen werden!</b>
								</a>
							</li>
							<li><a href="'.$link.'&current=2">
								<b>Stimmt, Ich möchte aber  einen der 10 Berufswege im Test behalten!</b>
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
							<li><a href="site_table_button2.php?current=1">
								<b>Stimmt, Das Berufsfeld kann komplett gestrichen werden!</b>
								</a>
							</li>
							<li><a href="site_table_button2.php?current=2">
								<b>Stimmt, Ich möchte aber  einen der 10 Berufswege im Test behalten!</b>
								</a>
							</li>
							<li><a href="site_table_button2.php?current=3">
								<b>Stimmt nicht, Das Berufsfeld soll im Test bleiben! </b>
								</a>
							</li>    
  						</ul>			
						');
					}
				
				
				?>
				
				<?php 	echo('<a href="auswertung.php"><h3>Auswertung</h3></a>')	?>
      			</div> <!-- end of info -->

    		</div>
  		</div>
  		<div id="footer">
    		[footer]
  		</div>
	</body>

</html>