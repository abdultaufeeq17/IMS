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
        <title>Home</title>
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
                                <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['images']); ?>" width='120' height='120'></td>               
                                <td><a href="up"><a href="edit.php?id=<?php echo $row["product_id"] ?>">Edit</a> | <a href="up"><a href="delete.php?id=<?php echo $row["product_id"] ?>">Delete</a></th>
                            </tr>
                        <?php }} ?>
                    </tbody>
                </table>          
            </div>
        </div>
    </body>
</html>