<?php
include "vendor/autoload.php";
include "src/Payment/payment.php";
use Payment\Payment;
$payment = new Payment;
// ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Pay with PayPal</title>
</head>
<body>
   <div class="container">
       <div class="row">
           <div class="col-md-6">
               <form class="form-horizontal" method="POST" action="https://www.sandbox.PayPal.com/cgi-bin/webscr ">
                   <fieldset>
                       <!-- Form Name -->
                       <legend>Pay with PayPal</legend>
                       <!-- Text input-->
                       <div class="form-group">
                           <label class="col-md-4 control-label" for="amount">Payment Amount</label>
                           <div class="col-md-4">
                               <input id="amount" name="amount" type="text" placeholder="amount to pay" class="form-control input-md" required="">
                               <span class="help-block">help</span>
                           </div>
                       </div>
                       <input type='hidden' name='business' value='sb-8fnvz29539915@business.example.com'>
                       <input type='hidden' name='item_name' value='Camera'>
                       <input type='hidden' name='item_number' value='CAM#N1'>
                       <!--<input type='hidden' name='amount' value='10'>-->
                       <input type='hidden' name='no_shipping' value='1'>
                       <input type='hidden' name='currency_code' value='USD'>
                       <input type='hidden' name='notify_url' value='<?php echo $payment->route("notify", "") ?>'>
                       <input type='hidden' name='cancel_return' value='<?php echo $payment->route("cancel.php", "") ?>'>
                       <input type='hidden' name='return' value='<?php echo $payment->route("return", "/shopping cart/return.php") ?>'>
                       <input type="hidden" name="cmd" value="_xclick">
                       <!-- Button -->
                       <div class="form-group">
                           <label class="col-md-4 control-label" for="submit"></label>
                           <div class="col-md-4">
                               <button id="submit" name="pay_now" class="btn btn-danger">Pay With PayPal</button>
                           </div>
                       </div>
                   </fieldset>
               </form>
           </div>
       </div>
   </div>
</body>
</html>