<?php
  include("inc/dbconnect.php");
  include("inc/functions.php");

	if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    $request = trim(filter_input(INPUT_GET, 'invoice_id'));
    $query = 'SELECT * FROM invoice_header WHERE invoice_id='.$request;
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
    $query = 'SELECT * FROM invoice_details WHERE invoice_id='.$request;
    // if db connection works, 
    if (empty($errorMessage)) { 
      try {
        $statement = $db->prepare($query);
        $statement->execute();
        $detail_result = $statement->fetchAll();
        $statement->closeCursor();
      } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        // exit;
      }
    }
  }
  $title = 'INVOICE';
  include_once("inc/header.php");
?>
<?php
  if (!empty($errorMessage)) {
    display_db_error($errorMessage);
  } else {
?>
	<!--main contents-->
	<div class="container">
    <h1>INVOICE</h1>
    <!--add lookup page here button click triger page move to search.php-->

    <!--current invoice list here call display dashboard part-->
    <table>
      
      <thead>
        <tr>
          <th>Invoice Number</th>
          <th>Customer Name</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($result as $invoices) {
          echo '<tr>';
          echo '<td>' . $result[0]['invoice_number']. '</td>';
          echo '<td>' . $result[0]['customer_name']. '</td>';
          echo '</tr>';
        }
      ?>
      </tbody>
    </table>
    <table>
      <caption>INVOICE DETAIL</caption>
      <thead>
        <tr>
          <th>Item</th>
          <th>Item Description</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Total</th>
          <th><a href="itemAdd.php?invoice_id=<?php echo $result[0]['invoice_id']; ?>" >Add Items</a></th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($detail_result as $invoices) {
          echo '<tr>';
          echo '<td>' . $invoices['item'] . '</td>';
          echo '<td>' . $invoices['invoice_description'] . '</td>';
          echo '<td>' . $invoices['quantity'] . '</td>';
          echo '<td>' . $invoices['price'] . '</td>';
          echo '<td>' . $invoices['quantity']*$invoices['price'] . '</td>';
          echo '<td>' . '<a href="itemEdit.php?invoice_id=' . $invoices['invoice_id'] . '">Edit</a> | <a href="itemDelete.php?invoice_id=' . $invoices['invoice_id'] . '">Delete</a></td>';
          echo '</tr>';
        }
      ?>
      </tbody>
    </table>
    <?php
    }
    ?>
  </div>
<!--include footer-->
<?php 
  include_once("inc/footer.php"); 
  db_close();
?>