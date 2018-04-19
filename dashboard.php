<?php 
  include_once("inc/dbconnect.php");
  include_once("inc/functions.php");
  $title = 'Dashboard';
  include_once("inc/header.php");
?>
	<!--main contents-->
	<div class="container">
    <h1>Dashboard</h1>
  </div>
<!--include footer-->
<?php 
  include_once("inc/footer.php");
  db_close();
  ?>