<?php
$servername = 'localhost';
$dbname = 'invoices';
$username = 'root';
$password = 'Patryse3698'; //delete this later
$dsn = "mysql:host=$servername;dbname=$dbname";

try { 
  $db = new PDO($dsn, $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // use exception to handle exeptional case (db not connectable)
  echo "Unable to connect" .$e->getMessage();
  exit;
}

//seperate try catch block for each point of interaction
try {
  $db->query("SELECT invoice_number, customer_name FROM invoice_header"); // query method one argument (query as a string)
  echo "Retrieved Results";
} catch (Exception $e) {
  echo "Unable to retrieved data";
  exit;
}
