<?php
  include("inc/dbconnect.php");
  include("inc/functions.php");

	if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    $query = 'SELECT * FROM invoice_details WHERE invoice_detail_id='.$_GET['invoice_detail_id'];
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $query = 'DELETE FROM invoice_details WHERE invoice_detail_id='.$_POST['invoice_detail_id'];
      if (empty($errorMessage)) { 
        try {
          $statement = $db->prepare($query);
          $statement->execute();
          $statement->closeCursor();
          header('Location: invoice.php?invoice_id='.$_POST['invoice_id']);
          
        } catch (PDOException $e) {
          $errorMessage = $e->getMessage();
          // exit;
        }
      }
    }

  
  $title = 'INVOICE | DELETE';
  include_once("inc/header.php");
?>
<?php
  if (!empty($errorMessage)) {
    display_db_error($errorMessage);
  } else {
?>
	<!--main contents-->
	<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="delete_item" method="post">
    <input type="hidden" name="invoice_id" value="<?php echo $result[0]['invoice_id']; ?>" ><br>
    <input type="hidden" name="invoice_detail_id" value="<?php echo $result[0]['invoice_detail_id']; ?>" ><br>
    <lable>Item</label>
    <input type="text" name="item" id="item" value="<?php echo $result[0]['item']; ?>"/><br/>
    <lable>Invoice Description</label>
    <input type="text" name="invoice_description" id="invoice_description" value="<?php echo $result[0]['invoice_description']; ?>"/><br/>
    <lable>Qantity</label>
    <input type="text" name="quantity" id="quantity" value="<?php echo $result[0]['quantity']; ?>"/><br/>
    <lable>Price</label>
    <input type="text" name="price" id="price" value="<?php echo $result[0]['price']; ?>"/><br/>
  
    <input type="submit" value="DELETE Item">
  </form>
    <?php
    }
    ?>
  </div>
<!--include footer-->
<?php 
  include_once("inc/footer.php"); 
  db_close();
?>