<?php
  include("inc/dbconnect.php");
  // Once form posted, add data into database
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $invoice_id = $_POST['invoice_id'];
    $item = $_POST['item'];
    $invoice_description = $_POST['invoice_description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $query = "INSERT INTO invoice_details (item, invoice_description, quantity, price, invoice_id)
              VALUES ('$item', '$invoice_description', '$quantity', '$price', '$invoice_id')";
    $insert_count = $db->exec($query);
    if ($insert_count < 1) {
        $errorMessage = 'Error Occured In Invoice Add.';
    } else {
      header('Location: invoice.php?invoice_id='.$invoice_id);
    }
  }
  include_once("inc/functions.php");
  $title = 'Invoice | Item Add)';
  include_once("inc/header.php");
?>
<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="add_item" method="post">
    <input type="hidden" name="invoice_id" value="<?php echo $_GET['invoice_id']; ?>"><br>
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