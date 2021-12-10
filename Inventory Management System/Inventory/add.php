<?php 
    session_start(); 
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Items</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/script.js"></script>
        <script src="https://kit.fontawesome.com/d8306965cb.js" crossorigin="anonymous"></script>
        <link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
    </head>
    <body>
    <div class="navbar">
            <div><a style="color: purple; text-decoration: none;" href="index.php"><h1>Housekeeping Inventory</h1></a></div>
            <div><a style="color: purple; text-decoration: none;" href="index.php"><h3>Home</a></h3></div>
            <div><a style="color: purple; text-decoration: none;" href="add.php"><h3>Add Items</a></h3></div>
            <div class="dropdown">
                <button onclick="dropdown()" class="dropbtn">
                    <img class="avatar-img" src="avatar.png" alt="avatar">
                    <?php echo $_SESSION['username']?>
                    <i class="fas fa-chevron-circle-down"></i>
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a class="dropdown-item" href="index.php?logout='1'">Log Out</a>
                </div>
            </div>
        </div>


        <div class="add-edit">
                <div class="add-item">
                    <form method="POST" class="add-form" action="additem.php" autocomplete="off" enctype="multipart/form-data">
                        <fieldset>
                        <legend><h2 style="text-align:center">Add Item Here</h2></legend>
                        <div class="form-group">
                        <button class="add-image-button" onclick="document.getElementById('getFile').click()">Add Image</button>
                        <input type='file' id="getFile" style="display:none" name="image">
                    </div>
                        <div class="form-group">
                            <input type="text" name="product_name" placeholder="Item name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="price"  min="0" max="" placeholder="Price" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="quant" id="quant" min="1" max="" placeholder="Quantity" required>
                        </div>
                        
                        <button type="submit" class="addbtn form-group add-edit-button-1 add-edit-button" name="add">Add item</button>
                        </fieldset>
                    </form> 
                    <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                        <div class="success-message" style="margin-bottom: 20px;font-size: 16px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
                        <?php
                        unset($_SESSION['success_message']);
                    }
                    ?>
                </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="head">
                    <h2 class="header-title">Items in stock</h2>
                </div>
                <div class="search">
                    <form action="#" autocomplete="off">
                        <input type="text" id="myInput" onkeyup="SearchTable()" name="search" placeholder="Search..." required ><i class="fas fa-search"></i>
                    </form>
                </div>
                <table class="supTable" id="myTable">    
                    <thead>
                        <tr class="header">
                            <th class="sortable" onclick="sortTable('supTable', 0)">ID</th>
                            <th class="sortable" onclick="sortTable('supTable', 1)">Name</th>
                            <th class="sortable" onclick="sortTable('supTable', 2)">Price</th>
                            <th class="sortable" onclick="sortTable('supTable', 3)">Quantity</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $conn = new mysqli("localhost", "root", "", "inventory");
                        $sql="DELETE FROM product
                        WHERE product_id NOT IN
                        (SELECT MAX(product_id) AS MaxRecordID
                                FROM product
                                GROUP BY product_name, price, quantity);";
                        $conn->query($sql);
                        $sql = "SELECT * FROM product";
                        $result = $conn->query($sql);
                        $count = 0;
                        if ($result->num_rows >  0) {
                            while ($row = $result->fetch_assoc()) {
                                $count = $count + 1;
                        ?>                  
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $row["product_name"] ?></td>
                                <td><?php echo $row["price"]  ?></td>
                                <td><?php echo $row["quantity"]  ?></td>
                                <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['images']); ?>" width='100' height='100'></td>                
                                <td><a href="up"><a href="edit.php?id=<?php echo $row["product_id"] ?>">Edit</a> | <a href="up"><a href="delete.php?id=<?php echo $row["product_id"] ?>">Delete</a></th>
                            </tr>
                        <?php }} ?>
                    </tbody>
                </table>          
            </div>
        </div>
    </body>
</html>