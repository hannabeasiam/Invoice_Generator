<?php
  include("inc/dbconnect.php");
  // Once form posted, add data into database
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * validate user input
     *         echo '<td>' . $invoices['item'] . '</td>';
     * echo '<td>' . $invoices['invoice_description'] . '</td>';
     * echo '<td>' . $invoices['quantity'] . '</td>';
     * echo '<td>' . $invoices['price'] . '</td>';
     * 
     * 
     */
    // $invoice_id = $_POST['invoice_id'];
    $item = $_POST['item'];
    $invoice_description = $_POST['invoice_description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $query = "INSERT INTO invoice_details (item, invoice_description, quantity, price)
              VALUES ('$item', '$invoice_description', '$quantity', '$price')";
    $insert_count = $db->exec($query);
    if ($insert_count < 1) {
        $errorMessage = 'Error Occured In Invoice Add.';
    } else {
      // Redirect to Category listing page
      header('Location: invoice.php?invoice_id='.$_GET['invoice_id']);
    }
  }
  include_once("inc/functions.php");
  $title = 'Invoice | Item Add)';
  include_once("inc/header.php");
?>
<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="add_item" method="post">

    <lable>Item</label>
    <input type="text" name="item" id="item" /><br/>
    <lable>Invoice Description</label>
    <input type="text" name="invoice_description" id="invoice_description" /><br/>
    <lable>Qantity</label>
    <input type="text" name="quantity" id="quantity" /><br/>
    <lable>Price</label>
    <input type="text" name="price" id="price" /><br/>
  
    <input type="submit" value="Add Item">
  </form>
</div>
<?php 
  include_once("inc/footer.php"); 
  dbclose();
?>