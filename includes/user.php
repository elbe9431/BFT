<?php
/**
 * Berufsfindungstest :: User class
 *
 * @version 1.0
 * @package Berufsfindungstest
 * @author Carsten Heine <carstenheine@gmx.de>
 * @copyright 2010 Carsten Heine. All rights reserved.
 */

// Restricted access
defined('_BFT_EXEC') or die('Restricted access');

class BFT_User
{
    public $data = array(
        'userid'   => -1, // defaults for users, who hasn't entered email
        'kennwort' => 0,  // don't show personal password
        'erg1'     => 3,  // show full result of test 1
        'druck1'   => 3,  // allow printing of result of test 1
        'email1'   => 0,  // don't send email at end of test 1
        'erg2'     => 1,  // show result of test 2
        'druck2'   => 1,  // allow printing of result of test 2
        'email2'   => 0,  // don't send email at end of test 2
    );
    
    public function __construct($data)
    {
        if (isset($data->userid) and ($data->userid > 0)) {
            $this->update($data->userid);
        }
    }
    
    public function update($userid)
    {
        // Update an existing user
        global $db;
        if ($userid > 0) {
            $sql = 'SELECT
                        *
                    FROM
                        bft_users AS u, bft_groups AS g
                    WHERE
                        u.userid = '.$userid.' AND
                        g.name = u.groupname';
            if (!$result = $db->query($sql)) {
                die(sprintf(BFT_Lang::error, $db->errno, $db->error));
            }
            if ($row = $result->fetch_assoc()) {
                $this->data = $row;
            }
            $result->close();
        }
    }
}
?>
