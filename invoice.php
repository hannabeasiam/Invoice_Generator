<?php
  include_once("inc/functions.php");
  $title = 'Invoice';
  include_once("inc/header.php");

  if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    $request = trim(filter_input(INPUT_GET, 'invoice_id'));
    $query = "SELECT * FROM invoice_header WHERE invoice_id=$request;";
    echo($query);
    // if db connection works, 

    $result = display_invoice_header("$query");  // fetch data
    echo'<pre>';
    print_r($result);
    echo'</pre>';
    
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /*********
     * validate data here
     */
    $invoice_id = trim(filter_input(INPUT_POST,'invoice_id'));
    $invoice_number = trim(filter_input(INPUT_POST,'invoice_number'));
    $customer_name = trim(filter_input(INPUT_POST,'customer_name'));
    
    if (isset($_POST['edit'])) {
      $query = "UPDATE invoice_header
                SET invoice_number = '$invoice_number', customer_name = '$customer_name' 
                WHERE invoice_id = '$invoice_id'";
      change_invoice_header($query);
      exit;
    }
    if (isset($_POST['delete'])) {
      $query = "DELETE FROM invoice_header
                WHERE invoice_id = '$invoice_id'";
  
      change_invoice_header($query);
      exit;
    }
  }

  if (!empty($errorMessage)) {
    display_db_error($errorMessage);
  } else {
?>
<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="invoice" method="post">
    <input type="hidden" name="invoice_id" id="invoice_id" value="<?php echo $result['invoice_id']; ?>" />
    <lable>Invoice Number</label>
    <input type="text" name="invoice_number" id="invoice_number" value="<?php echo $result['invoice_number']; ?>"/><br/>
    <lable>Customer Name</label>
    <input type="text" name="customer_name" id="customer_name" value="<?php echo $result['customer_name']; ?>"/><br/>
    <input type="submit" name="edit" value="Save Change">
    <input type="submit" name="delete" value="delete">
  </form>
</div>
<?php 
  }
  include_once("inc/footer.php"); 
  db_close();
?>