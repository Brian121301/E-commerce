<?php
// Include the configuration file  
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PayPal JS SDK Standard Integration</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/minstyle.io@2.0.1/dist/css/minstyle.io.min.css">
  <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-sm"></div> <!--left column to center content-->
      <div class="col-sm"><!--main column of content-->
        <h2 class="ms-text-center"><?php echo $itemName; ?></h2>
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