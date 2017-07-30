<?php
/**
 * Paartherapietest :: Backend groups
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Enno Heyken berufsziele@aol.com
 * @copyright 2016 Enno Heyken. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

// Neue Gruppe
if (isset($_POST['gruppeneu'])) {
    if ($_POST['gruppeneu'] == 'Schule vor Ort') {
        $sql = 'INSERT INTO
                    bft_groups
                VALUES
                    (NULL, "", "' . $_POST['beschreibung'] . '", 1, 0, 2, 1, 1, 2, 2, 0, 2, 2, 1, 0, 0, 0, 0)';
    }
    elseif ($_POST['gruppeneu'] == 'Schule Dauerlink') {
        $sql = 'INSERT INTO
                    bft_groups
                VALUES
                    (NULL, "", "' . $_POST['beschreibung'] . '", 1, 0, 2, 1, 1, 1, 0, 0, 2, 2, 1, 0, 0, 0, 0)';
    }
    elseif ($_POST['gruppeneu'] == 'Berufsberatung in Praxis') {
        $sql = 'INSERT INTO
                    bft_groups
                VALUES
                    (NULL, "", "' . $_POST['beschreibung'] . '", 1, 0, 2, 1, 2, 1, 2, 0, 1, 1, 0, 0, 0, 0, 0)';
    }
    elseif ($_POST['gruppeneu'] == 'Berufsberatung zuhause') {
        $sql = 'INSERT INTO
                    bft_groups
                VALUES
                    (NULL, "", "' . $_POST['beschreibung'] . '", 1, 0, 2, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)';
    }
    else {
        $sql = 'INSERT INTO
                    bft_groups
                VALUES
                    (NULL, "", "' . $_POST['beschreibung'] . '", 1, 0, 2, 1, 1, 1, 0, 0, 2, 2, 1, 1, 0, 0, 0)';
    }
    $db->query($sql);
    $groupid = $db->insert_id;
    $sql = 'UPDATE
                bft_groups
            SET
                name = "bft' . sprintf("%03d", $groupid) . '"
            WHERE
                groupid=' . $groupid;
    $db->query($sql);
    echo 'Gruppe hinzugefügt -> <a href="?page=grouplist">Weiter</a>';
}

// Gruppe speichern
elseif (isset($_POST['gruppespeichern'])) {
    $str = '';
    foreach ($groups as $key => $val) {
        $str .= $val[0] ? $key . ' = "' . $_POST[$key] . '" , ' : '';
    }
    $str = substr($str, 0, -2);
    $sql = 'UPDATE
                bft_groups
            SET
                ' . $str . '
            WHERE
                groupid=' . $_POST['groupid'];
    $db->query($sql);
    echo 'Gruppe gespeichert -> <a href="?page=grouplist">Weiter</a>';
}

// Gruppe löschen
elseif (isset($_POST['gruppeloeschen'])) {
    if ($_POST['gruppeloeschen'] == 'Ja') {
        $sql = 'DELETE FROM
                    bft_groups
                WHERE
                    groupid=' . $_POST['groupid'];
        $db->query($sql);
        echo 'Gruppe gelöscht -> <a href="?page=grouplist">Weiter</a>';
    }
    elseif ($_POST['gruppeloeschen'] == 'Nein') {
        echo 'Löschen abgebrochen -> <a href="?page=grouplist">Weiter</a>';
    }
    else {
        echo '<form action="." method="post" accept-charset="utf-8">';
        echo 'Gruppe wirklich löschen?<br />';
        echo '<input type="hidden" name="groupid" value="' . $_POST['groupid'] . '" />';
        echo '<input type="submit" name="gruppeloeschen" value="Ja" />';
        echo '<input type="submit" name="gruppeloeschen" value="Nein" />';
        echo '</form>';
    }
}

// Gruppen Liste
elseif ($page == 'grouplist') {
    $sql = 'SELECT
                ' . implode(',', $grouplist) . '
            FROM
                bft_groups
            ORDER BY
                groupid';
    if (!$result = $db->query($sql)) {
        die('Error ('.$db->errno.') '.$db->error);
    }
    else {
        echo '<table>';
        echo '<tr>';
        foreach ($grouplist as $key => $val) {
            echo '<th>' . $val . '</th>';
        }
        echo '</tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            foreach ($row as $key => $val) {
                echo '<td>' . output($key, $val) . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
    $result->close();
    echo '<hr />';
    echo '<form action="." method="post" accept-charset="utf-8">';
    echo '<label>Beschreibung</label>';
    echo '<input type="text" name="beschreibung" value="" />';
    echo '<br />';
    echo '<span>Neue Gruppe: </span>';
    echo '<input type="submit" name="gruppeneu" value="Schule vor Ort" />';
    echo '<input type="submit" name="gruppeneu" value="Schule mit Anmeldung" />';
    echo '<input type="submit" name="gruppeneu" value="Schule Dauerlink" />';
    echo '<input type="submit" name="gruppeneu" value="Berufsberatung in Praxis" />';
    echo '<input type="submit" name="gruppeneu" value="Berufsberatung zuhause" />';
    echo '</form>';
}

// Einzelne Gruppe
elseif ($page == 'group') {
    $sql = 'SELECT
                *
            FROM
                bft_groups
            WHERE
                groupid="' . $id . '"';
    if (!$result = $db->query($sql)) {
        die('Error ('.$db->errno.') '.$db->error);
    }
    else {
        $row = $result->fetch_assoc();
        echo '<form action="." method="post" accept-charset="utf-8">';
        foreach ($row as $key => $val) {
            echo '<label>' . $key . '</label>';
            echo '<input type="text" name="' . $key . '" value="' . $val . '" ' . (!$groups[$key][0] ? 'disabled="disabled"' : '') . '/>';
            echo '<span>' . $groups[$key][1] . '</span>';
            echo '<br />';
        }
        echo '<input type="hidden" name="groupid" value="' . $row['groupid'] . '" />';
        echo '<input type="reset" />';
        echo '<input type="submit" name="gruppespeichern" value="Speichern" />';
        if ($row['groupid'] > 3) {
            echo '<hr />';
            echo '<input type="submit" name="gruppeloeschen" value="Gruppe löschen" />';
        }
        echo '</form>';
    }
    $result->close();
}
?>
