<?php
$mysql = new mysqli("db2511.1und1.de", "dbo331453744", "1astrid", "db331453744");
printf("Client version: %s\n", $mysql->client_version); 
printf("Server version: %s\n", $mysql->server_version); 
$mysql->query("DROP TABLE IF EXISTS temp_table"); 
$mysql->query("CREATE TABLE temp_table(username varchar(20), user_id int, user_id2 int)"); 
$mysql->query("INSERT INTO temp_table VALUES ('foo', 1, 2)"); 
if ($stmt = $mysql->prepare("SELECT username FROM temp_table WHERE user_id = ? AND user_id2 = ?")) 
{ 
    $stmt->bind_param('ii', $user_id, $user_id2);
    $user_id = 1;
    $user_id2 = 2; 
    $stmt->execute(); 
    $stmt->bind_result($name); 
    $stmt->fetch(); 
    printf("Name: %s\n", $name); 
    $stmt->close(); 
} 
$mysql->close(); 
?>
