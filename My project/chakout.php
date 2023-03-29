<?php
$conn = mysqli_connect('localhost', 'root', '', 'leather1');
session_start();

if (isset($_POST['Confirm'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sqlOrder = "INSERT INTO order_confirm (fullname, city,address,phone  ) VALUES ('$fullname' ,'$city','$address','$phone')";

    if (mysqli_multi_query($conn, $sqlOrder)) {

        $sqlDelete = "DELETE FROM cart ";
        if (mysqli_multi_query($conn, $sqlDelete)) {
            $query = " SELECT COUNT(*) FROM cart";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            $_SESSION['itemInCart'] = $row[0];

            header("Location: index.php");
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>bay page</title>
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
           
            <a href="cart.php" style="float:right"  class="active"><img src="images/shopping-cart.png" alt="">
                    <span> <?php
                            echo $_SESSION['itemInCart'];
                            ?></span></a>

    </div>
    <!--  checkout  -->

    <section class="checkout">
        <h2 class="title">Bay</h2>
        <div>
            <form name="checkout" action="" method="post" onsubmit="return(validateForm());" style="direction: rtl;">
                <label>Your name</label> <input type="text" name="fullname" placeholder="name..">
                <br> <br>
                <label>City</label>
                <select name="city">
                    <option value="Please Select">Please select your city</option>
                    <option value="Dammam">Dammam</option>
                    <option value="Riyadh">Riyadh</option>
                    <option value="AlKarj">AlKarj</option>
                    <option value="Jeddah">Jeddah</option>
                </select>
                <br> <br>
                <label> Your Address </label>
                <input type="text" name="address" placeholder="Address...">
                <br> <br>
                <label> Phone number </label>
                <input type="tel" name="phone" placeholder="05XXXXXXXX">
                <br/> <br/>
                <br/><br/>
                <p style="border: 1px solid #d34459; padding:10px;"> ** Paiement when recieving.
                <p>
                    <input type="submit" id="submit" value="Confirmation" name="Confirm">
            </form>
        </div>
    </section>

    <!--   footer     -->
    <footer>
        <p>You can contact us through</p>
        <div class="contact-info"> <img src="images/email.png" width="25px" alt=""> <span>Aaaaammm@gmail.com</span> <img src="images/phone-call.png" width="25px" alt=""> <span>050111222</span></div>
    </footer>
    <script type="text/javascript">
        function validateForm() {

            var fullname = checkout.fullname.value;

            if (fullname == "") {
                alert("Please Your Full name is required");
                return false;
            }
            var city = checkout.city.value;

            if (city === "Please Select") {
                alert("Please Choose your city");
                return false;

            }
            var address = checkout.address.value;

            if (address == "") {
                alert("Please Your Address is required");
                return false;

            }

            var phone = checkout.phone.value;
            if (phone.length != 10) {
                alert("Phone should not be empty and length should be exactly 10 digits");
                return false;

            }


            return true;




        }
    </script>

</body>

</html>