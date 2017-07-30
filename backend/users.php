<?php
/**
 * Berufsfindungstest :: Backend users
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');
$reihe=0;

// User speichern
if (isset($_POST['userspeichern'])) {
    $str = '';
    foreach ($users as $key => $val) {
        $str .= $val[0] ? $key . ' = "' . $_POST[$key] . '" , ' : '';
    }
    $str = substr($str, 0, -2);
    $sql = 'UPDATE
                bft_users
            SET
                ' . $str . '
            WHERE
                userid=' . $_POST['userid'];
    $db->query($sql);
    echo 'User gespeichert -> <a href="?page=userlist">Weiter</a>';
}

// User Passwort ändern
elseif (isset($_POST['userpassword'])) {
    $sql = 'UPDATE
                bft_users
            SET
                password = "' . md5($_POST['newpassword']) . '"
            WHERE
                userid=' . $_POST['userid'];
    $db->query($sql);
    echo 'Passwort gespeichert -> <a href="?page=userlist">Weiter</a>';
}

// User Banküberweisung
elseif (isset($_POST['userbankueberw'])) {
    $sql = 'UPDATE
                bft_users
            SET
                bez=1
            WHERE
                userid=' . $_POST['userid'];
    $db->query($sql);

    // Mail senden mit Teilnahmebedingungen
    $mail = new BFT_Mail();
    $mail->SendBankueberweisungBestaetigung($_POST['userid']);
    
    echo 'User freigeschaltet und E-Mail versendet -> <a href="?page=userlist">Weiter</a>';
}

// User Buchung von Berufsberatung auf berufsziele.de
elseif (isset($_POST['buchung'])) {
    $sql = 'UPDATE
                bft_users
            SET
                bez=1
            WHERE
                userid=' . $_POST['userid'];
    $db->query($sql);

    // Mail senden mit Teilnahmebedingungen
    $mail = new BFT_Mail();
    $mail->SendBuchungBestaetigung($_POST['userid']);
    
    echo 'User freigeschaltet und E-Mail versendet -> <a href="?page=userlist">Weiter</a>';
}

// User löschen
elseif (isset($_POST['userloeschen'])) {
    if ($_POST['userloeschen'] == 'Ja') {
        $sql = 'DELETE FROM
                    bft_users
                WHERE
                    userid=' . $_POST['userid'];
        $db->query($sql);
        echo 'User gelöscht -> <a href="?page=userlist">Weiter</a>';
    }
    elseif ($_POST['userloeschen'] == 'Nein') {
        echo 'Löschen abgebrochen -> <a href="?page=userlist">Weiter</a>';
    }
    else {
        echo '<form action="." method="post" accept-charset="utf-8">';
        echo 'User wirklich löschen?<br />';
        echo '<input type="hidden" name="userid" value="' . $_POST['userid'] . '" />';
        echo '<input type="submit" name="userloeschen" value="Ja" />';
        echo '<input type="submit" name="userloeschen" value="Nein" />';
        echo '</form>';
    }
}

// User Liste
elseif ($page == 'userlist') {
    $sql = 'SELECT
                ' . implode(',', $userlist) . '
            FROM
                bft_users';
    if ($id) $sql .= ' WHERE groupname="' . $id . '"';   
	if($bezart && $bezart==-1) $sql .= ' WHERE bezart>0';
	if($bezart && $bezart>-1) $sql .= ' WHERE bezart='. $bezart ;	
	//echo $sql;
    $sql .= ' ORDER BY userid DESC';
	
    if (!$result = $db->query($sql)) {
        die('Error ('.$db->errno.') '.$db->error);
    }
    else {		
        echo '<table>';		
        echo '<tr>';
		echo '<th style="background-color:#EFEFEF">lfdNr.</th>';
        foreach ($userlist as $key => $val) {
            echo '<th style="background-color:#EFEFEF">' . $val . '</th>';
        }
        echo '</tr>';			
        while ($row = $result->fetch_assoc()) {
            if($reihe % 2 ==0){
			 	echo '<tr style="background-color:#A7C8CD">';
			}else{
				echo '<tr>';
			}
			echo '<th style="background-color:#A7C8CD;text-align:center">'.($reihe+1).'</th>';
			foreach ($row as $key => $val) {
                echo '<td>' . output($key, $val) . '</td>';
            }
            echo '</tr>';
			$reihe++;
        }		
        echo '</table>';		
    }
    $result->close();
}

// Einzelner User
elseif ($page == 'user') {
    $sql = 'SELECT
                *
            FROM
                bft_users
            WHERE
                userid = ' . $id;
    if (!$result = $db->query($sql)) {
        die('Error ('.$db->errno.') '.$db->error);
    }
    else {
        $row = $result->fetch_assoc();
        echo '<form action="." method="post" accept-charset="utf-8">';
        foreach ($row as $key => $val) {
            echo '<label>' . $key . '</label>';
            echo '<input type="text" name="' . $key . '" value="' . $val . '" ' . (!$users[$key][0] ? 'disabled="disabled"' : '') . '/>';
            echo '<span>' . $users[$key][1] . '</span>';
            echo '<br />';
        }
        echo '<input type="hidden" name="userid" value="' . $row['userid'] . '" />';
        echo '<input type="reset" />';
        echo '<input type="submit" name="userspeichern" value="Speichern" />';
        echo '<hr />';
        echo '<input type="submit" name="userloeschen" value="User löschen" />';
        echo '<hr />';
        echo '<label>Neues Passwort</label>';
        echo '<input type="password" name="newpassword" value="" />';
        echo '<br />';
        echo '<input type="submit" name="userpassword" value="Passwort ändern" />';
        if ($row['p2'] == 8) {
            echo '<hr />';
            echo '<a href="pdf.php?id='.$id.'&type=alles" target="_blank">Ergebnis als Pdf anzeigen</a><br />';
            echo '<a href="pdf.php?id='.$id.'&type=berufsfelder" target="_blank">Pdf nur mit Berufsfeldern Test 1</a><br />';
            echo '<a href="pdf.php?id='.$id.'&type=berufe" target="_blank">Pdf nur mit Berufen Test 2</a><br /><br /><br /><br />';
        }
        if ($row['bez'] == 0 and $row['bezart'] == 4) {
            echo '<hr />';
            echo 'Banküberweisung ist eingegangen<br />';
            echo '<input type="submit" name="userbankueberw" value="User freischalten" />';
        }
        if ($row['bez'] == 0 and $row['buchen'] == 1) {
            echo '<hr />';
            echo 'Buchung von Berufsberatung auf berufsziele.de bestätigen<br />';
            echo '<input type="submit" name="buchung" value="User freischalten" />';
        }
        echo '</form>';
    }
    $result->close();
}
?>
