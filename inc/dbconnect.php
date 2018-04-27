<?php
$servername = 'localhost';
$dbname = 'invoices';
$username = 'root';
$password = ''; // delete this later
$dsn = "mysql:host=$servername;dbname=$dbname";

try { 
  $db = new PDO($dsn, $username, $password);
  $errorMessage = ''; // to check db connection works fine 
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // use exception to handle exeptional case (db not connectable)
  $errorMessage = $e->getMessage();
  exit;
}

function display_db_error($errorMessage) {
  echo '<aside>';
  echo '<ul>';
  echo "<li>$errorMessage</li>";
  echo '</aside>';
}



