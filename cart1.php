<?php
// Include the configuration file  
require_once 'config.php';
?>
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
        <a href="./gallery.html">Gallery</a>
        <a href="./login.html">Login</a>
        <a href="./products.html">Product Listing</a>
        <a href="./cart.html">Shopping Cart</a>
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
        <div id="payment-box">
            <div id="paypal-button-container"></div>
        </div>
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

    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_SANDBOX ? PAYPAL_SANDBOX_CLIENT_ID : PAYPAL_PROD_CLIENT_ID; ?>&currency=<?php echo $currency; ?>"></script>

    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    "purchase_units": [{
                        "custom_id": "<?php echo $itemNumber; ?>",
                        "description": "<?php echo $itemName; ?>",
                        "amount": {
                            "currency_code": "<?php echo $currency; ?>",
                            "value": <?php echo $itemPrice; ?>,
                            "breakdown": {
                                "item_total": {
                                    "currency_code": "<?php echo $currency; ?>",
                                    "value": <?php echo $itemPrice; ?>
                                }
                            }
                        },
                        "items": [{
                            "name": "<?php echo $itemName; ?>",
                            "description": "<?php echo $itemName; ?>",
                            "unit_amount": {
                                "currency_code": "<?php echo $currency; ?>",
                                "value": <?php echo $itemPrice; ?>
                            },
                            "quantity": "1",
                            "category": "DIGITAL_GOODS"
                        }, ]
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    setProcessing(true);

                    var postData = {
                        paypal_order_check: 1,
                        order_id: orderData.id
                    };
                    fetch('paypal_checkout_validate.php', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json'
                            },
                            body: encodeFormData(postData)
                        })
                        .then((response) => response.json())
                        .then((result) => {
                            if (result.status == 1) {
                                window.location.href = "payment-status.php?checkout_ref_id=" + result.ref_id;
                            } else {
                                const messageContainer = document.querySelector("#paymentResponse");
                                messageContainer.classList.remove("hidden");
                                messageContainer.textContent = result.msg;

                                setTimeout(function() {
                                    messageContainer.classList.add("hidden");
                                    messageText.textContent = "";
                                }, 5000);
                            }
                            setProcessing(false);
                        })
                        .catch(error => console.log(error));
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>

</html>
