<?php
// connect Database
$conn = mysqli_connect('localhost', 'root', '', 'leather1');
session_start();
// insert items in cart
if (isset($_POST['cart'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $sql = " INSERT INTO cart (product_name,product_image,product_price) VALUES('" . $product_name . "','" . $product_image . "','" . $product_price . "')";
    if (!mysqli_multi_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title> leather bags </title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    
            <a href="index.php" class="active">Home</a>
            
            <a href="BestBags.php">Best Bags</a>
            
            <a href="AllBags.php">All Bags</a>
           
            <a href="cart.php" style="float:right"><img src="images/shopping-cart.png" alt="">
                    <!--to coll--><span> <?php
                            echo $_SESSION['itemInCart'];
                            ?></span></a>

    </div>

    <!--   about      -->

    <section class="wrapper">
        <div class="content-text">
            <h2>Women Bags</h2>
            <p> Fashion Backpack Handbags, Canvas & Beach Tote Bags, Clutches, Hobos & Shoulder Bags, Satchels and more from the wide range of products.</p>
        </div>
        
    </section>

    <div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="images/im12.jpg" style="width:100%" "height:100%">
  
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="images/im2.jpg" style="width:100%" "height:100%">
  
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="images/im3.jpg" style="width:100%" "height:100%">
  
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>


</body>

</html>