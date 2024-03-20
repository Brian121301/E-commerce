<?php
// Include the configuration file  
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/minstyle.io@2.0.1/dist/css/minstyle.io.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/searchbar.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light sticky-top navstyle">
        <div class="nav-sides">
            <form action="products.php" method="post">
                <div class="searchBox">
                    <div class="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="searchInput">
                        <input type="text" placeholder="Search Here">
                    </div>
                    <div class="close">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
            </form>
        </div>
        <div class="main-nav">
            <h1 class="nav_h1font">
                <a href="homepage.php">Jule's Crafting Corner</a>
            </h1>
            <nav>
                <ul class="nav justify-content-center">
                    <li class="nav_font nav-item"><a class="nav-link active" href="index.php">home</a></li>
                    <li class="nav_font nav-item"><a class="nav-link" href="products.php">products</a></li>
                    <li class="nav_font nav-item"><a class="nav-link" href="about.php">about</a></li>
                    <li class="nav_fontnav-item"><a class="nav-link" href="contact.php">contact</a></li>
                </ul>
            </nav>
        </div>
        <div class="nav-sides cart-icon nav_font">
            <a href="checkout.php">
                cart
            </a>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm"></div> <!--left column to center content-->
            <div class="col-sm"><!--main column of content-->
                <h2 class="ms-text-center">Products</h2>
                <div class="ms-text-center pb-2">
                    <div class="ms-label ms-large ms-action2 ms-light">$<?php echo $itemPrice; ?></div>
                </div>
                <div id="alerts" class="ms-text-center"></div>
                <div id="loading" class="spinner-container ms-div-center">
                    <div class="spinner"></div>
                </div>
                <div id="content" class="hide">
                    <div id="paypal-button-container"></div>
                    <p id="result-message"></p>
                </div>
            </div>
            <div class="col-sm"></div><!--right column to center content-->
        </div>
    </div>
</body>

</html>