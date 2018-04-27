<?php
//connect db, return invoices (invoice header talbe)
function get_invoice_header() {
  include_once("dbconnect.php");
  $query = 'SELECT * FROM invoice_header ORDER BY invoice_number';
  // if db connection works, return invoice header store under invoice
  if (empty($errorMessage)) { 
    try {
      $statement = $db->prepare($query);
      $statement->execute();
	  	$result = $statement->fetchAll();
		  $statement->closeCursor();
    } catch (PDOException $e) {
      $errorMessage = $e->getMessage();
      exit;
    }
  }
  return $result;
}

function display_invoice_header($query) {
  include_once("dbconnect.php");
  // if db connection works, return invoice header store under invoice
  if (empty($errorMessage)) { 
    try {
      $statement = $db->prepare($query);
      $statement->execute();
	  	$result = $statement->fetch();
		  $statement->closeCursor();
    } catch (PDOException $e) {
      $errorMessage = $e->getMessage();
      exit;
    }
  }
  return $result;
}


function change_invoice_header($query) {
  include_once("dbconnect.php");

  if (empty($errorMessage)) { 
    try {
      $statement = $db->prepare($query);
      $statement->execute();
      $statement->closeCursor();
      header('Location: index.php');
    } catch (PDOException $e) {
      $errorMessage = $e->getMessage();
    }
  }
}
function display_db_error($errorMessage) {
  include_once("dbconnect.php"); /********** should I add this here? **********/
  echo '<aside>';
  echo '<ul>';
  echo "<li>$errorMessage</li>";
  echo '</aside>';
}

function db_close() {
  include_once("dbconnect.php"); /********** should I add this here? **********/
  $db = NULL;
  
}
?>