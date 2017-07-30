<?php
 
// Include the main class, the rest will be automatically loaded
include 'Includes/dwoo/dwooAutoload.php'; 
 
// Create the controller, it is reusable and can render multiple templates
$dwoo = new Dwoo(); 
 
// Create some data
$data = array('a'=>5, 'b'=>6);
 
// Output the result ... 
$dwoo->output('Includes/template/index.tpl', $data);
// ... or get it to use it somewhere else
$dwoo->get('Includes/template/index.tpl', $data);
 
?>