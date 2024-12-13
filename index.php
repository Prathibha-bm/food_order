<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "hotel"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $item_name = $_POST['item_name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $table_num = $_POST['table_num'];
    $quantity = $_POST['quantity'];
    $total_price = 250 * $quantity; // Assuming Rs 250 per item
    $payment_method = $_POST['payment_method'];

    // Insert data into the database
    $sql = "INSERT INTO items (item_name,name, email, table_num, quantity, total_price, payment_method) 
            VALUES ('$item_name','$name','$email', $table_num, $quantity, $total_price, '$payment_method')";
    if ($conn->query($sql) === TRUE) {
        // Output JavaScript for the alert box
        echo "<script>
                alert('Order confirmed!');
              </script>";
    } else {
        echo "<script>
                alert('Error: " . addslashes($conn->error) . "');
              </script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="cs.css" />
    <style>
        .menu-item {
            margin-bottom: 20px;
            text-align: center;
        }

        .menu-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .menu-item h5 {
            margin-top: 10px;
        }

        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }

        .cart-link {
            color: #fff;
            text-decoration: underline;
            cursor: pointer;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        

    </style>
</head>

<body>

    <div id="sectionHome">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/food-munch-img.png" class="food-munch-logo" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                    <a class="nav-link active" id="navItem1" href="#wcuSection">
                             Why Choose Us?<style></style>
                            <span class="sr-only">(current)</span>
                        </a>
                        <a class="nav-link" href="#delivery_and_payment" id="navItem3">Delivery & Payment</a>
                        <a class="nav-link" href="#follow_us" id="navItem4">Follow Us</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="banner-section-bg-container d-flex justify-content-center flex-column">
            <div class="text-center">
                <h1 class="banner-heading mb-3">Get Delicious Food Anytime</h1>
                <p class="banner-caption mb-4">Eat Smart & Healthy</p>
                <button class="custom-button" onclick="display('sectionHome1')">View Menu</button>
                <a href="form.html"><button class="custom-outline-button">Order Now</button></a><style></style>
            </div>
        </div>

        <div class="wcu-section pt-5 pb-5" id="wcuSection">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="wcu-section-heading">Why Choose Us?</h1>
                        <p class="wcu-section-description">
                            We use both original recipes and classic versions of famous food
                            items.
                        </p>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="wcu-card p-3 mb-3">
                            <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/food-serve.png" class="wcu-card-image" />
                            <h1 class="wcu-card-title mt-3">Food Service</h1>
                            <p class="wcu-card-description">
                                Experience fine dining at the comfort of your home. All our
                                orders are carefully packed and arranged to give you the nothing
                                less than perfect.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="wcu-card p-3 mb-3">
                            <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/fruits-img.png" class="wcu-card-image" />
                            <h1 class="wcu-card-title mt-3">Fresh Food</h1>
                            <p class="wcu-card-description">
                                The Fresh Food group provides fresh-cut fruits and vegetables
                                directly picked from our partner farms and farm houses so that
                                you always get them tree to plate.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="wcu-card p-3 mb-3">
                            <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/offers-img.png" class="wcu-card-image" />
                            <h1 class="wcu-card-title mt-3">Best Offers</h1>
                            <p class="wcu-card-description">
                                Food Coupons & Offers upto
                                <span class="offers">50% OFF</span>
                                and Exclusive Promo Codes on All Online Food Orders.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="healthy-food-section pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="text-center">
                            <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/healthy-food-plate-img.png" class="healthy-food-section-img" />
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <h1 class="healthy-food-section-heading">
                            Fresh, Healthy, Organic, Delicious Fruits
                        </h1>
                        <p class="healthy-food-section-description">
                            Say no to harmful chemicals and go fully organic with our range of
                            fresh fruits and veggies. Pamper your body and your senses with
                            the true and unadulterated gifts from mother nature. with the true
                            and unadulterated gifts from mother nature.
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div id="delivery_and_payment">
            <div class="delivery-and-payment-section pt-5 pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5 order-1 order-md-2">
                            <div class="text-center">
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/delivery-payment-section-img.png" class="delivery-and-payment-section-img" />
                            </div>
                        </div>
                        <div class="col-12 col-md-7 order-2 order-md-1">
                            <h1 class="delivery-and-payment-section-heading">
                                Delivery and Payment
                            </h1>
                            <p class="delivery-and-payment-section-description">
                                Enjoy hassle-free payment with the plenitude of payment options
                                available for you. Get live tracking and locate your food on a
                                live map. It's quite a sight to see your food arrive to your door.
                                Plus, you get a 5% discount on every order every time you pay
                                online.
                            </p>
                            <div class="mt-3">
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/visa-card-img.png" class="payment-card-img" />
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/master-card-img.png" class="payment-card-img" />
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/paypal-card-img.png" class="payment-card-img" />
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/american-express-img.png" class="payment-card-img" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="follow_us">
            <div class="thanking-customers-section pt-5 pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-7 d-flex flex-column justify-content-center">
                            <h1 class="thanking-customers-section-heading">
                                Thank you for being a valuable customer to us.
                            </h1>
                            <p class="thanking-customers-section-description">
                                We have a surprise gift for you
                            </p>
                            <div class="d-md-none">
                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/thanking-customers-section-img.png" class="thanking-customers-section-img" />
                            </div>
                            <div>
                                <button type="button" class="custom-button" data-toggle="modal" data-target="#exampleModal">
                                    Redeem Gift
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog mt-5">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title thanking-customers-section-modal-title" id="exampleModalLabel">
                                                    Gift Voucher
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/gift-voucher-img.png" class="w-100" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 d-none d-md-block">
                            <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/thanking-customers-section-img.png" class="thanking-customers-section-img" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="footer-section pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="https://d1tgh8fmlzexmh.cloudfront.net/ccbp-responsive-website/food-munch-logo-light.png" class="food-munch-logo" />
                        <h1 class="footer-section-mail-id">orderfood@foodmunch.com</h1>
                        <p class="footer-section-address">
                             Jyothi Nagar,ckm, Karnataka,India.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="sectionHome1">
        <div class="explore-background mb-5">
            <div class="container ">
                <div class="row">
                    <a class="view-heading" onclick="display('sectionHome')" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                    </a>
                    <div class="col-12 pb-5 text-center">
                        <h1 class="explore-heading">Explore Menu</h1>
                        <button class="custom-outline-button"  onclick="viewCart()">View Cart</button>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://imgmedia.lbb.in/media/2023/05/645df3ddad09c45b4771cf01_1683878877966.jpg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Non-Veg Starters</h1>
                            <a class="view-heading" onclick="display('section2')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://i.pinimg.com/originals/a4/2b/3a/a42b3a59c5e3a4dc92e1b833ba1782f9.jpg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Veg Starters</h1>
                            <a class="view-heading" onclick="display('section3')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://cdn.diffords.com/contrib/encyclopedia/2022/10/63492b3330994.jpg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Drinks & Desserts</h1>
                            <a class="view-heading" onclick="display('section4')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://www.lecremedelacrumb.com/wp-content/uploads/2022/09/easy-creamy-potato-soup-12-2.jpg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Soups</h1>
                            <a class="view-heading" onclick="display('section5')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://thumbs.dreamstime.com/z/indian-curry-dishes-17901001.jpg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Currey</h1>
                            <a class="view-heading" onclick="display('section6')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3">
                        <div class="explore-part-container pt-3  text-center">
                            <img src="https://www.salonebly.com/fleetcart/storage/media/CSOTD6XSgyqyzKOzE2Tk3finRuhpUF6qR3LYqzgp.jpeg" class="non-veg-starter-image" />
                            <h1 class="non-veg-heading">Noodles</h1>
                            <a class="view-heading" onclick="display('section7')" target="_blank">View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="section2">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-2 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://flawlessfood.co.uk/wp-content/uploads/2021/03/Tandoori-Chicken-Tikka-Kebab-433-1536x1017.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Kabab <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs220</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2 add-to-cart15">Add to Cart</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://cdn.shopify.com/s/files/1/0524/2113/2440/files/Untitled_design_-_2023-06-09T144444.193.jpg?v=1686302118" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Biriyani <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://atasteofflavours.com/wp-content/uploads/2021/02/IMG_1608-scaled.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Tandoori <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 450</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://pikturenama.com/wp-content/uploads/2021/04/Low-res-Andhra-Pepper-Chicken-5.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Chicken Pepper Dry<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 280</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhOlmtxjgICQa-aKeXotMhrdw853gM9irtYEazQ6rGZPJa-jLjXA1Z6XCwNF5My5AYs1Gn9v_fFpuJOq03tAuR4huSar9MDgt5ngi5G5W3GhHbG6fSqxVgqVj9IWQTU3w0fdS9d58_CWR3mzBYRkTV1_oXlsWrv8KkUlO7QiYk1m14EN3T9QC1VuBvyfQ/w1200-h630-p-k-no-nu/Adobe_Express_20230228_1656140_1.png" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2"> Chicken Lollipop <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.tastingtable.com/img/gallery/the-untraditional-meat-thats-popular-for-israeli-shawarma/l-intro-1672315523.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Roll <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 270</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="notification" id="cartNotification15" style="display: none;">
        Item added to cart. <span class="cart-link" onclick="viewCart()">View Cart</span>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addToCartButtons = document.querySelectorAll(".add-to-cart15");
            const notification = document.getElementById("cartNotification15");
    
            addToCartButtons.forEach(button => {
                button.addEventListener("click", (event) => {
                    const container = event.target.closest('.explore-part-container');
                    const itemName = container.querySelector('.non-veg-heading').childNodes[0].nodeValue.trim();
                    const itemPrice = parseInt(container.querySelector('.para-north[style*="color:green;"]').innerText.replace('Rs ', '').trim(), 10);
    
                    const item = {
                        name: itemName,
                        price: itemPrice,
                        quantity: 1
                    };
                    addToCart(item);
                    showNotification();
                });
            });
    
            function showNotification() {
                notification.style.display = "block";
                setTimeout(() => {
                    notification.style.display = "none";
                }, 3000);
            }
    
            function addToCart(item) {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
    
                const existingItem = cart.find(cartItem => cartItem.name === item.name);
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push(item);
                }
    
                localStorage.setItem("cart", JSON.stringify(cart));
            }
    
            function viewCart() {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                if (cart.length === 0) {
                    alert("Your cart is empty.");
                    return;
                }
    
                const cartWindow = window.open("", "Cart", "width=500,height=500");
                renderCart(cartWindow, cart);
            }
    
            function renderCart(cartWindow, cart) {
                if (cart.length === 0) {
                    cartWindow.document.body.innerHTML = '<h1>Your Cart is Empty</h1><button onclick="window.close()">Close</button>';
                    return;
                }
    
                let cartDetails = cart.map((item, index) => `
                    ${index + 1}. ${item.name} - Rs ${item.price} x ${item.quantity} = Rs ${item.price * item.quantity}
                    <button onclick="opener.updateItemQuantity(${index}, -1)">-</button>
                    ${item.quantity}
                    <button onclick="opener.updateItemQuantity(${index}, 1)">+</button>
                    <button onclick="opener.removeItemFromCart(${index})">Remove</button>
                `).join("<br>");
    
                cartWindow.document.body.innerHTML = `
                    <h1>Your Cart</h1>
                    ${cartDetails}<br><br>
                    <button onclick="window.close()">Close</button>
                `;
            }
    
            window.updateItemQuantity = function (index, change) {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                if (cart[index]) {
                    cart[index].quantity += change;
                    if (cart[index].quantity <= 0) {
                        cart.splice(index, 1);
                    }
                    localStorage.setItem("cart", JSON.stringify(cart));
    
                    let cartWindow = window.open("", "Cart", "width=500,height=500");
                    renderCart(cartWindow, cart);
                }
            };
    
            window.removeItemFromCart = function (index) {
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                cart.splice(index, 1);
                localStorage.setItem("cart", JSON.stringify(cart));
    
                let cartWindow = window.open("", "Cart", "width=500,height=500");
                renderCart(cartWindow, cart);
            };
    
            window.viewCart = viewCart;
        });
    </script>
    <div id="section3">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://rasoirani.com/wp-content/uploads/2020/04/veg-hyderabadi-biryani.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-2">Pallav <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                            
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.shikararestaurant.com/wp-content/uploads/2018/01/masla-dosa.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ">Dosa <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 150</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2 add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://pipingpotcurry.com/wp-content/uploads/2017/03/Vegetable-Sambar-Instant-Pot-Piping-Pot-Curry.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3">Idly Sambar <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 80</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://bonmasala.com/wp-content/uploads/2022/11/puliyogare-recipe-BoN.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3">Puliyogre<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 70</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://www.shutterstock.com/image-photo/homemade-masala-fried-puri-poori-260nw-1079957924.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3"> Puri <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 150</p>
                            <a href="form.html "><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://kj1bcdn.b-cdn.net/media/81875/malabar-paratha.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3">Parota <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 170</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="section4">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.themixer.com/en-us/wp-content/uploads/sites/2/2022/11/391.-Mudslide-Cocktail-Recipe_Featured-Image_Canva_Mizina.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Classic Mudslide<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 220</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.mashed.com/img/gallery/chocolate-martini-cocktail-recipe/intro-1660575728.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Chocolate Martini<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 230</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://ichef.bbci.co.uk/food/ic/food_16x9_832/recipes/white_russian_36079_16x9.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">White Russian <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://www.thespruceeats.com/thmb/VCPHQWd8eoN7-rAIuk0K64ZUv7U=/2746x1831/filters:fill(auto,1)/chocolate-mousse-recipe-1375149-hero-01-d3bae0e0fca6401983596d717cf4e309.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Mousse<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://wallpapercrafter.com/desktop/121702-sweets-food-bowls-ice-cream-berries-fruit.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2"> Ice cream<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="http://www.baltana.com/files/wallpapers-18/Cookies-HD-Desktop-Wallpaper-46632.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Cookies<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 250</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="section5">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="http://3.bp.blogspot.com/-qLHtp6EvUbI/UqNU7sLJpxI/AAAAAAAABSQ/DDAmdR0baho/s1600/2tomato+soup.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Tomato Soup <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 170</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.drweil.com/wp-content/uploads/2016/12/diet-nutrition_recipes_roasted-vegetable-soup_2725x1804_000071339861.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Vegetable Soups <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 120</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://www.allrecipes.com/thmb/UeFtapHyGFBo4Lx-72GxgjrOGnk=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/13978-lentil-soup-DDMFS-4x3-edfa47fc6b234e6b8add24d44c036d43.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Lentil Soup<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 130</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://www.unileverfoodsolutions.lk/dam/global-ufs/mcos/meps/sri-lanka/calcmenu/recipes/LK-recipes/general/chicken-and-sweet-corn-soup/main-header.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Sweet corn soup <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 190</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://thumbs.dreamstime.com/b/broccoli-soup-tasty-wooden-background-43700270.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2"> Broccoli soup<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 130</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>

                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.preparedfoodphotos.com/wp-content/uploads/FrenchOnionSoup001_ADL-2.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">French Onion soup <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 90</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div id="section6">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://4.bp.blogspot.com/-QgO4sHd7Dl4/WIpnATPabII/AAAAAAAACkA/80ehgUy-9RAgnL1-2JDCs2nBEf7CQoFngCLcB/s1600/Butter%2BChicken%2BRecipe.JPG" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Butter Chicken <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 95</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://www.seriouseats.com/thmb/HaBfNjG3Fr61qU6_1h9lHY_3Yl0=/1500x1125/filters:fill(auto,1)/__opt__aboutcom__coeus__resources__content_migration__serious_eats__seriouseats.com__recipes__images__2016__03__20160328-channa-masala-recipe-6-ae4913c04d5b43e9acef2917a74aa5fc.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Veg Chana Masala <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 70</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://templeofspices.com.au/wp-content/uploads/2020/03/Vegetable-Korma-Curry-4-scaled.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Veg Korma <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 150</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://madscookhouse.com/wp-content/uploads/2020/10/Paneer-Butter-Masala-Nut-Free.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Paneer Masala<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 175<p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://i.ytimg.com/vi/FtCdvlVhzds/maxresdefault.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2"> Egg Curry <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 50</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://i.ytimg.com/vi/mJ8kw-5ifzE/maxresdefault.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ml-2">Mutton Curry<span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 200</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="section7">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a class="view-heading" onclick="display('sectionHome1')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="60" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </a>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container  pb-3 ">
                            <img src="https://img-global.cpcdn.com/recipes/0ae7c7664f915ab6/1502x1064cq70/veg-hakka-noodles-recipe-main-photo.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ">Hakka Noodles <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 80</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 shadow mt-3 mb-3 pb-5">
                        <div class="explore-part-container pb-3 ">
                            <img src="https://jackslobodian.com/wp-content/uploads/2021/03/Vegetable-Vegan-Chow-Mein-2.jpg" class="biriyani-image " />
                            <h1 class="non-veg-heading mt-3 ">Veg Noodles <span class="heading-span ">4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span></h1>
                            <p class="para-north">North, Southern, Andhra </p>
                            <p class=" para-north" style="font-weight:bold; color:green;"> Rs 70</p>
                            <a href="form.html"><button class="button-part-1 order-now-btn" onclick="openOrderForm()">Order Now</button></a>
                            <button class="button-part-2  add-to-cart15">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://assets.ccbp.in/frontend/static-website/ccbp-ui-kit.js">
    </script>

</body>
</html>