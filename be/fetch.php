<?php
require_once 'Database.php';

$database = new Database("localhost", "root", "", "pdraivok");
$database->connect();

$database->fetchAllDataSortedByName();

$database->closeConnection();
?>
