<?php
  include_once("inc/dbconnect.php");
  include_once("inc/functions.php");
  
  $query = 'SELECT * FROM invoice_header ORDER BY invoice_number';
  // if db connection works, 
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
  $title = 'Home';
  include_once("inc/header.php");
?>
	<!--main contents-->
	<div class="container">
    <h1>home</h1>
    <!--add lookup page here button click triger page move to search.php-->

    <!--current invoice list here call display dashboard part-->
    <?php
    if (!empty($errorMessage)) {
      display_db_error($errorMessage);
    } else {
    ?>
    <table>
      <thead>
        <tr>
          <th>Invoice Number</th>
          <th>Customer Name</th>
          <th><a href="invoiceadd.php">Add Invoices</a></th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($result as $invoices) {
          echo '<tr>';
          echo '<td>' . $invoices['invoice_number'] . '</td>';
          echo '<td>' . $invoices['customer_name'] . '</td>';
          echo '<td>' . '<a href="invoiceEdit.php?invoice_number=' . $invoices['invoice_number'] . '">Edit</a> | <a href="invoicedelete.php?invoice_number=' . $invoices['invoice_number'] . '">Delete</a></td>';
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