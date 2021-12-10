<?php 
    session_start(); 

    if (!isset($_SESSION['username'])) {
      $_SESSION['msg'] = "You must log in first";
      header('location: login.php');
    }
    if (isset($_GET['logout'])) {
      session_destroy();
      unset($_SESSION['username']);
      header("location: login.php");
    }
?>

<?php
	// initializing variables
	$item_name = "";
	$item_price = "";

	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'inventory');
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	// Add item
	if (isset($_POST['add'])) {
	// receive all input values from the form
	echo "connect";
	$item_name=mysqli_real_escape_string($db, $_POST['product_name']);
	$item_price=mysqli_real_escape_string($db, $_POST['price']);
	$quant=mysqli_real_escape_string($db, $_POST['quant']);
	$image = $_FILES['image']["tmp_name"];
	$img_cont=addslashes(file_get_contents($image));
	$query = "INSERT INTO product (product_name,price,quantity,images) 
				VALUES('$item_name','$item_price','$quant','$img_cont')";
	if(mysqli_query($db, $query)) {
		echo "<script>alert('Successfully stored');</script>";
		}
		else {
			echo"<script>alert('Somthing wrong!!!');</script>";
		}
		$_SESSION['success_message'] = "Item added successfully.";
		header('location: add.php');
	}
?>