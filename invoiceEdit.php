<?php
  include_once("inc/dbconnect.php");
  
	if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    $query = 'SELECT * FROM invoice_header WHERE invoice_number='.$_GET['invoice_number'];
    // if db connection works, 
    if (empty($errorMessage)) { 
      try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
      } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        // exit;
      }
    }
  }
  // if update trigger
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice_number = $_POST['invoice_number'];
    $customer_name = $_POST['customer_name'];
    $query = "UPDATE invoice_header
              SET invoice_number = '$invoice_number', customer_name = '$customer_name' 
              WHERE invoice_number = $invoice_number";

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
  include_once("inc/functions.php");
  $title = 'Home | Invoice Add)';
  include_once("inc/header.php");

  if (!empty($errorMessage)) {
    display_db_error($errorMessage);
  } else {
?>
<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="edit_invoice" method="post">
    <lable>Invoice Number</label>
    <input type="text" name="invoice_number" id="invoice_number" value="<?php echo $result[0]['invoice_number']; ?>"/><br/>
    <lable>Customer Name</label>
    <input type="text" name="customer_name" id="customer_name" value="<?php echo $result[0]['customer_name']; ?>"/><br/>
    <input type="submit" value="Edit Invoice">
  </form>
</div>
<?php 
  }
  include_once("inc/footer.php"); 
  db_close();
?>