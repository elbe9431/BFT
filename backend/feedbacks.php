<?php
/**
 * paartherapietest :: Backend users
 *
 * @version 1.0
 * @package paartherapietest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

if ($page == 'feedbacks' && isset($_GET['del']) && $_GET['del']>0) {
	$feedbackid=$_GET['del'];
	$sql='DELETE FROM bft_feedbacks WHERE feedbackid='.$feedbackid;		
	$db->query($sql);
}
if ($page == 'feedbacks') {
	echo "<h3>Feedbacks ansehen</h3>";
	 $sql = 'SELECT
                ' . implode(',', $feedbacklist) . '
            FROM
                bft_feedbacks';    
	//echo $sql;
    $sql .= ' ORDER BY datum DESC';
	
    if (!$result = $db->query($sql)) {
        die('Error ('.$db->errno.') '.$db->error);
    }
    else {		
        echo '<table>';		
        echo '<tr>';
		echo '<th style="background-color:#EFEFEF">Löschen</th>';
        foreach ($feedbacklist as $key => $val) {
			if($key!="feedbackid"){
            echo '<th style="background-color:#EFEFEF">' . $val . '</th>';
			}
        }
        echo '</tr>';			
        while ($row = $result->fetch_assoc()) {
            if($reihe % 2 ==0){
			 	echo '<tr style="background-color:#A7C8CD">';
			}else{
				echo '<tr>';
			}
			
			echo '<td><a href="#" onclick="del=confirm(\'Soll der ausgewählte Datensatz wirklich gelöscht werden?\');if(del==true)location.href=\'?page=feedbacks&del='.$row['feedbackid'].'\'" >löschen</a></td>';
			foreach ($row as $key => $val) {
				if($key!="feedbackid"){
                echo '<td>' . output($key, $val) . '</td>';
				}
            }
            echo '</tr>';
			$reihe++;
        }		
        echo '</table>';
	   $result->close();		
    }
	
	
 
}
?>

