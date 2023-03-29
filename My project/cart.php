<?php
$conn = mysqli_connect('localhost', 'root', '', 'leather1');
session_start();

if (isset($_POST['RemoveCart'])) {
    $cart_id = mysqli_real_escape_string($conn, $_POST['cart_id']);

    $sqlDelete = "DELETE FROM cart WHERE  cart_id ='$cart_id' ";
    if (mysqli_multi_query($conn, $sqlDelete)) {
        $query = " SELECT COUNT(*) FROM cart";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $_SESSION['itemInCart'] = $row[0];
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
if (isset($_POST['Clear'])) {

    $sqlDelete = "DELETE FROM cart  ";
    if (mysqli_multi_query($conn, $sqlDelete)) {
        $query = " SELECT COUNT(*) FROM cart";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $_SESSION['itemInCart'] = $row[0];
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Cart </title>
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
    
            <a href="index.php" >Home</a>
            
            <a href="BestBags.php">Best Bags</a>
            
            <a href="AllBags.php">All Bags</a>
           
            <a href="cart.php" style="float:right" class="active"><img src="images/shopping-cart.png" alt="">
                    <span> <?php
                            echo $_SESSION['itemInCart'];
                            ?></span></a>

    </div>

    <!--  View Bag  -->

    <section class="bag">
        <div class="view-bag">
            <div>
                <h2 class="title"> Your Cart </h2>
                <?php
                if (!$_SESSION['itemInCart']) {
                    echo '<p class="no-product">There is No Product Yet in cart</p>';
                }
                if ($_SESSION['itemInCart']) {
                ?>
                    <table class="cart-table">
                        <tr>
                            <th>Bag</th>
                            <th>Price</th>
                        </tr>
                        <?php

                        $query = "SELECT * FROM cart";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                                <tr>
                                    <td class="product-display">
                                        <span><img src="images/<?php echo $row["image"]; ?>" alt="" width="100px"></span>
                                        <span> 
                                            <p><?php echo $row["name"]; ?></p>
                                        </span>

                                    </td>
                                    <td> SAR <?php echo $row["price"]; ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="cart_id" value="<?php echo $row["cart_id"]; ?>">
                                            
                                            <input type="submit" class="btn" value="Cancel" name="RemoveCart">
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>

                    <!-- Summary Bag -->

                    <?php

                    $sqlSum = "SELECT SUM(price) FROM cart";
                    $resultSum = mysqli_query($conn, $sqlSum);
                    $rowSum = mysqli_fetch_array($resultSum);
                    $_SESSION['total'] = $rowSum[0];

                    ?>
                    <div>
                        <h2 class="title"> Summary Cart </h2>

                        <table class="summary-table">
                            <tr>
                                <td> Total Products </td>
                                <td>SAR <?php echo $_SESSION['total'] ?></td>
                            </tr>
                            <tr>
                                <td> Code </td>
                                <td><input type="text" placeholder="write code here.. "></td>
                            </tr>

                            <tr>
                                <td colspan="2"><button class="buy"><a href="chakout.php">Buy</a></button>
                                    <form action="" method="post">
                                        <input type="submit" name="Clear" value="Clear Cart">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </section>


</body>

</html>