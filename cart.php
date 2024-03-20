<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jules Crafting Corner - Shopping Cart</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <a href="index.php">
            <h1>Jules Crafting Corner</h1>
        </a>
    </header>

    <nav>
        <a href="./gallery.php">Gallery</a>
        <a href="./login.php">Login</a>
        <a href="./products.php">Product Listing</a>
        <a href="./cart.php">Shopping Cart</a>
    </nav>

    <section>
        <table id="cartTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Cart items will be dynamically added here using JavaScript -->
            </tbody>
        </table>

        <p>Your shopping cart is empty. Start adding some creative products!</p>
        <!-- You can add links to the product listing  -->
        <a href="checkout.php">Proceed to Checkout</a>
    </section>

    <footer>
        <p>&copy; 2024 Jules Crafting Corner</p>
    </footer>

    <script>
        // Example JavaScript code to add items to the shopping cart
        document.addEventListener("DOMContentLoaded", function() {
            // Function to add items to the cart
            function addToCart(product, price) {
                var cartTable = document.getElementById("cartTable");
                var tbody = cartTable.getElementsByTagName("tbody")[0];
                var newRow = tbody.insertRow();

                // Product
                var cell1 = newRow.insertCell(0);
                cell1.innerHTML = product;

                // Price
                var cell2 = newRow.insertCell(1);
                cell2.innerHTML = "$" + price.toFixed(2);

                // Quantity (default to 1)
                var cell3 = newRow.insertCell(2);
                cell3.innerHTML = 1;

                // Total (default to price)
                var cell4 = newRow.insertCell(3);
                cell4.innerHTML = "$" + price.toFixed(2);
            }

            // Example: Add items to the cart (you would trigger this from your product listing page)
            addToCart("Product A", 20.00);
            addToCart("Product B", 15.00);
        });
    </script>
</body>

</html>