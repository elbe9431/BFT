<?php

		/**
		*	generateEliminationTable creates a table with a list of berufsfeldern
		*	to eliminate them
		**/
		function generateEliminationTable($berufsfelder, $baselink = "alpha"){
		 	
		 	$numbBerufsfelder = 0;
		 	$berufsfelderArray = array("tick");
		 	
		 	if(get_class($berufsfelder) == 'JobList'){
		 	 	echo("JobList");
				$numbBerufsfelder = count($berufsfelder->getBerufeList());
				$berufsfelderArray = $berufsfelder->getBerufeList();
			}
		 	//print_r($berufsfelderArray);
		 	$eliminate = 'Streichen?';
		 	
			$table = '<table class="box-table-a" summary="Contains Berufsfelder">';
			$table .='<thead>';
			$table .='<tr>';
			$table .='<th scope="col" class="long">Berufsfelder</th>';
			$table .='<th scope="col" class="short">gg</th>';
			$table .=' </tr>';
    		$table .='</thead>';
    		$table .='<tbody>';
    		
    		for($a = 0; $a < $numbBerufsfelder; $a++){
					
				if(is_object($berufsfelderArray[$a])){
					if(get_class($berufsfelderArray[$a]) == 'MarkableEntry'){
					 //echo("MARK AB");
						$berufsfeldName = $berufsfelderArray[$a]->getName();
				 		//$eliminate = $berufsfelderArray[$a]->isMarked();
				 		if($berufsfelderArray[$a]->isMarked()){
							$table .='<tr><td class="longu">';
						}else{
							$table .='<tr><td class="long">';
						}
				 		
						$table .='<a href="'.$baselink.'?beruf='.$berufsfeldName.'">'.$berufsfeldName.'</a></td>';
						$table .='<td class="short"><a href="'.$baselink.'?beruf='.$berufsfeldName.'">'.$eliminate.'</a></td></tr>';
						$table .="\r\n";
					}
				}else{
					$table .='<tr><td class="long">';
					$table .='<a href="'.$baselink.'?beruf='.$berufsfelderArray[$a].'">'.$berufsfelderArray[$a].'</a></td>';
					$table .='<td class="short"><a href="'.$baselink.'?beruf='.$berufsfelderArray[$a].'">'.$eliminate.'</a></td></tr>';
					$table .="\r\n";
				}
						
			}
			$table .="</tbody></table>";
    		
    		return $table;
		} 
		
		function generateTable($berufswege, $baselink = "alpha"){
		 	
		 	if(is_array($berufswege) && (($numbBerufswege = count($berufswege)) != 0)){
		 	 	
				echo(	'<table id="box-table-a" summary="Contains Berufswege">
    				<thead>
    				<tr>
        			<th scope="col">Studium</th>
            		<th scope="col">Ausbildung</th>
       				 </tr>
    				</thead>
    				<tbody>');
    			$half = $numbBerufswege/2;
				//echo $half;
			
				for($a = 0; $a < $numbBerufswege/2; $a++){
				
					echo('<tr><td><a href="'.$baselink.'?beruf='.$berufswege[$a].'">'.$berufswege[$a]);
					echo('</a></td><td><a href="'.$baselink.'?beruf='.$berufswege[$half].'">'.$berufswege[$half++].'</a></td></tr>');
					echo("\r\n");
				}
				echo("</tbody></table>");
			
				//$_SESSION["berufsfeld_id"] = $berufsfeld_id;
			}			
		}
		
		function generateP2Table($berufswege, $baselink = "alpha"){
		 	
		 	if(is_array($berufswege) && (($numbBerufswege = count($berufswege)) != 0)){
		 	 	
				echo(	'<table id="box-table-a" summary="Contains Berufswege">
    				<thead>
    				<tr>
        			<th scope="col">Top der Berufe</th>
            		
       				 </tr>
    				</thead>
    				<tbody>');
    			$half = $numbBerufswege/2;
				//echo $half;
			
				for($a = 0; $a < 10; $a++){
					if($a <= $numbBerufswege){
						echo('<tr><td><a href="'.$baselink.'?beruf='.$berufswege[$a].'">'.$berufswege[$a].'</a></td></tr>');
					}else{
						echo('<tr><td><a href="'.$baselink.'?beruf='.'--'.'">'.''.'</a></td></tr>');
					}
					
				}
				echo("</tbody></table>");
			
				//$_SESSION["berufsfeld_id"] = $berufsfeld_id;
			}else{
				if(get_class($berufswege) == 'Joblist'){
				 	
					echo(	'<table id="box-table-a" summary="Employee Pay Sheet">
    				<thead>
    				<tr>
        			<th scope="col">Top der Berufe</th>
            		
       				 </tr>
    				</thead>
    				<tbody>');
    				$numbBerufswege = count($berufswege->getBerufeList());
    				$half = $numbBerufswege/2;
					//echo $half;
					$berufswegeArray = $berufswege->getBerufeList();
					for($a = 0; $a < $numbBerufswege; $a++){
						//if($a <= $numbBerufswege){
						 	//[$a];
							echo('<tr><td><a href="'.$baselink.'?beruf='.$berufswegeArray[$a].'">'.$berufswegeArray[$a].'</a></td></tr>');
						//}else{
							//echo('<tr><td><a href="'.$baselink.'?beruf='.'--'.'">'.''.'</a></td></tr>');
						//}
						
					}
					echo("</tbody></table>");
					}
			}			
		}
		
		

?>