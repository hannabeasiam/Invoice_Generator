<?php
  include_once("inc/dbconnect.php");
  // Once form posted, add data into database
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * validate user input
     * 
     * 
     */
    $invoice_number = $_POST['invoice_number'];
  
    $customer_name = $_POST['customer_name'];
    $query = "INSERT INTO invoice_header (invoice_number, customer_name)
              VALUES ('$invoice_number', '$customer_name')";
    $insert_count = $db->exec($query);
    if ($insert_count < 1) {
        $errorMessage = 'Error Occured In Invoice Add.';
    } else {
      // Redirect to Category listing page
      header('Location: index.php');
    }
  }
  include_once("inc/functions.php");
  $title = 'Home | Invoice Add)';
  include_once("inc/header.php");
?>
<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="add_invoice" method="post">
    <lable>Invoice Number</label>
    <input type="text" name="invoice_number" id="invoice_number" /><br/>
    <lable>Customer Name</label>
    <input type="text" name="customer_name" id="customer_name" /><br/>
    <input type="submit" value="Add Invoice">
  </form>
</div>
<?php 
  include_once("inc/footer.php"); 
  db_close();
?>