<?php
/**
 * Berufsfindungstest :: Backend keys
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

// Neuer Schlüssel
if (isset($_POST['keyneu'])) {
    $sql = 'INSERT INTO
                bft_keys
            VALUES
                (NULL, "' . $_POST['keyname'] . '", 1)';
    $db->query($sql);
    echo 'Schlüssel hinzugefügt -> <a href="?page=keylist">Weiter</a>';
}

// Schlüsel speichern
elseif (isset($_POST['keyspeichern'])) {
    $str = '';
    foreach ($keys as $key => $val) {
        $str .= $val[0] ? $key . ' = "' . $_POST[$key] . '" , ' : '';
    }
    $str = substr($str, 0, -2);
    $sql = 'UPDATE
                bft_keys
            SET
                ' . $str . '
            WHERE
                keyid=' . $_POST['keyid'];
    $db->query($sql);
    echo 'Schlüssel gespeichert -> <a href="?page=keylist">Weiter</a>';
}

// Schlüssel löschen
elseif (isset($_POST['keyloeschen'])) {
    if ($_POST['keyloeschen'] == 'Ja') {
        $sql = 'DELETE FROM
                    bft_keys
                WHERE
                    keyid=' . $_POST['keyid'];
        $db->query($sql);
        echo 'Schlüssel gelöscht -> <a href="?page=keylist">Weiter</a>';
    }
    elseif ($_POST['keyloeschen'] == 'Nein') {
        echo 'Löschen abgebrochen -> <a href="?page=keylist">Weiter</a>';
    }
    else {
        echo '<form action="." method="post" accept-charset="utf-8">';
        echo 'Schlüssel wirklich löschen?<br />';
        echo '<input type="hidden" name="keyid" value="' . $_POST['keyid'] . '" />';
        echo '<input type="submit" name="keyloeschen" value="Ja" />';
        echo '<input type="submit" name="keyloeschen" value="Nein" />';
        echo '</form>';
    }
}

// Key Liste
elseif ($page == 'keylist') {
    $sql = 'SELECT
                ' . implode(',', $keylist) . '
            FROM
                bft_keys
            ORDER BY
                keyid';
    if (!$result = $db->query($sql)) {
        die('Error ('.$db->errno.') '.$db->error);
    }
    else {
        echo '<table>';
        echo '<tr>';
        foreach ($keylist as $key => $val) {
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
    echo '<label>Schlüssel</label>';
    echo '<input type="text" name="keyname" value="" />';
    echo '<span>Groß- und Kleinschreibung wird beim Login ignoriert - maximal 20 Zeichen</span>';
    echo '<br />';
    echo '<input type="submit" name="keyneu" value="Schlüssel erstellen" />';
    echo '</form>';
}

// Einzelner Schlüssel
elseif ($page == 'key') {
    $sql = 'SELECT
                *
            FROM
                bft_keys
            WHERE
                keyid="' . $id . '"';
    if (!$result = $db->query($sql)) {
        die('Error ('.$db->errno.') '.$db->error);
    }
    else {
        $row = $result->fetch_assoc();
        echo '<form action="." method="post" accept-charset="utf-8">';
        foreach ($row as $key => $val) {
            echo '<label>' . $key . '</label>';
            echo '<input type="text" name="' . $key . '" value="' . $val . '" ' . (!$keys[$key][0] ? 'disabled="disabled"' : '') . '/>';
            echo '<span>' . $keys[$key][1] . '</span>';
            echo '<br />';
        }
        echo '<input type="hidden" name="keyid" value="' . $row['keyid'] . '" />';
        echo '<input type="reset" />';
        echo '<input type="submit" name="keyspeichern" value="Speichern" />';
        echo '<hr />';
        echo '<input type="submit" name="keyloeschen" value="Schlüssel löschen" />';
        echo '</form>';
    }
    $result->close();
}
?>
