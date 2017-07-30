<?php

		include("./Includes/db/DBmod.php");
		$db = DBmod::getInstance();
		printf("Client version: %s\n", $db->client_version);
		printf("Server version: %s\n", $db->server_version);

		
	
?>
	
