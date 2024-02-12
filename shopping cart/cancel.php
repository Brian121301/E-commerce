<?php
paypal.Buttons({
  onCancel: function (data) 
  {
    // Show a cancel page, or return to cart
    window.location.href = './payment_form.php';
  }
}).render('#paypal-button-container');
?>