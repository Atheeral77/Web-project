<?php
// connect Database
$conn = mysqli_connect('localhost', 'root', '', 'leather1');
session_start();
// insert items in cart
if (isset($_POST['cart'])) {
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $sql = " INSERT INTO cart (image,price,name) VALUES('" . $image . "','" . $price . "','" . $name . "')";
    if (!mysqli_multi_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> All Bags </title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- retrive cart items -->
    <?php
    $query = " SELECT COUNT(*) FROM cart";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $_SESSION['itemInCart'] = $row[0];
    ?>
    <!--   Header    -->
    <div class="header">
    <a href="index.php" class="logo"><img src="images/logo.jpeg" alt="" style="width: 200px; margin: 20px auto;"></a>
    <div class="navbar">
    
            <a href="index.php">Home</a>
            
            <a href="BestBags.php">Best Bags</a>
            
            <a href="AllBags.php" class="active">All Bags</a>
           
            <a href="cart.php" style="float:right"><img src="images/shopping-cart.png" alt="">
                    <span> <?php
                            echo $_SESSION['itemInCart'];
                            ?></span></a>

    </div>
    <!--   display itmes     -->
    <h2 class="title"> All Bags!</h2>
    <div class="product-items">
        
        <?php

        $query = "SELECT * FROM all_bags ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
        ?>
                <div class="item">
                    <img src="images/<?php echo $row["image"]; ?>" width="100%" alt="">
                    <p> <?php echo $row["name"]; ?></p> 
                    <p> SAR <?php echo $row["price"]; ?></p>
                    <form action="" method="post">
                        <input type="hidden" name="image" value="<?php echo $row["image"]; ?>">
                        <input type="hidden" name="name" value="<?php echo $row["name"]; ?>">
                        <input type="hidden" name="price" value="<?php echo $row["price"]; ?>">
                        <input style="left:-6px;top:-2px" type="submit" value="Buy Now" name="cart">
                    </form>
                </div>
        <?php
            }
        }
        ?>
    </div> 
</body>

</html>