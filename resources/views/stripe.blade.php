<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 - Stripe Payment Gateway Integration Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<style>
/** Start Generl **/

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Roboto'
}

ul li {
  list-style: none;
}

body {
  margin: 0 auto;
}

/** End Generl **/

/*** Start Parent & Son ***/

.parent {
  margin: 0 auto;
  width: 100%;
  padding: 30px 0;
  border-radius: 5px;
  box-shadow: 23px 27px 28px -20px rgba(0,0,0,0.75);
  height: 100vh;
  min-height: 670px

}

.parent .son {
  width: 100%;
  max-width: 900px;
  height: 100%;
  padding: 80px 0 55px 0;
  margin: 0 auto;
  /* background-image: linear-gradient(to right, #2c73d2, #6d6fd2, #9869cc, #ba63c1, #d65db1); */
  overflow: hidden;
  border-radius: 5px;
  box-shadow:  0px 1px 25px 0px rgba(50, 50, 50, 0.91);

}

.parent .son .container {
  height: 100%;
  position: relative;
  right: -30px;
  margin: 0 auto;
  max-width: 700px;
}

/*** End Parent & Son ****/

/*** Start Left ****/
/*
.parent .son .left,
.parent .son .right {
  display: inline-block
}

.parent .son .left {
  width: 310px;
  height: 370px;
  overflow: hidden;
  position: relative;
  z-index: 333;
  border-radius: 5px;
  box-shadow: 0px 1px 22px 0px rgba(50, 50, 50, 0.65);
}

.parent .son .left .img {
  background-image: url('http://pamperyourmind.com/wp-content/uploads/2016/04/iStock_000065426843_Full.jpg');
  background-size: cover;
  width: 100%;
  height: 62%;
}

.parent .son .left .info {
  width: 100%;
  height: 38%;
  overflow: hidden;
  background-image: linear-gradient(to right, #845ec2, #7464c8, #6169cd, #4b6ed0, #2c73d2);
}

.parent .son .left .info ul:first-of-type {
  float: left;
  width: 50%;
  height: 100%;
  color: white;
  font-size: 8px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding-top: 40px;
  padding-left: 30px
}

.parent .son .left .info ul:first-of-type li {
  margin-bottom: 4px
}

.parent .son .left .info ul:first-of-type li:last-of-type {
  font-size: 28px;
  margin-top: 20px
}

.parent .son .left .info ul:last-of-type {
  float: right;
  width: 50%;
  height: 100%;
  color: white;
  font-size: 8px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding-top: 35px;
  padding-right: 30px;
  text-align: right
}

.left .info ul:last-of-type li:nth-of-type(2) {
  margin-bottom: 20px;
}

.left .info ul:last-of-type li:nth-of-type(2),
.left .info ul:last-of-type li:last-of-type {
  font-size: 12px
}

.left .info ul:last-of-type li:nth-of-type(3),
.left .info ul:last-of-type li:first-of-type {
  color: #95a5a6;
  margin-bottom: 4px
}

.left .circle1 {
  width: 81px;
  height: 81px;
  position: absolute;
  top: 147px;
  right: 50%;
  transform: translate(50%, 50%);
  background-color: #55338D;
  border-radius: 50%;
  font-size: 12px;
  margin: 0 auto;
  text-align: center;
  padding-top: 5px;
  box-shadow: 0px 1px 25px 0px rgba(50, 50, 50, 0.51);
}

.left .circle1 .circle {
  border-right: 3px solid #0081CF;
  border-top: 3px solid #0081CF;
  border-left: 3px solid #fff;
  border-bottom: 3px solid #fff;
  width: 69px;
  height: 70px;
  border-radius: 50%;
  margin: 0 auto;
  padding-top: 16px;
  position: relative;
  top: 0;
  right: 0px
}

.left .circle1 .circle span {
  display: block;
  font-size: 7.5px;
  text-transform: uppercase;
  font-weight: bold
}

.left .circle1 .circle span:first-child {
  color: #95a5a6
}

.left .circle1 .circle span:last-child {
  color: #fff;
  font-size: 14.5px;
  padding: 3px
}
 */

/*** End Left ***/

/*== Start Right ==*/

.parent .son .right {
  height: auto;
  width: 380px;
  position: relative;
  top: -12px;
  right: 55px;
  /*position: absolute;
  top: 40px;
  right: 140px;*/
  background-color: #fff;
  border-radius: 5px;
  box-shadow:  0px 1px 25px 0px rgba(50, 50, 50, 0.91);

}

.parent .son .right .up {
  width: 100%;
  height: 43%;
  background-image: linear-gradient(to right top, #ecf0f1, #e7f5f4, #e6faf1, #eefde8, #fefedf);
  padding: 40px 40px 0 80px;
  border-radius: 5px 5px 0 0
}

.son .right .up ul:first-of-type li:first-of-type{
  margin-bottom: 15px;
  color: #2A3350;
  font-weight: bold;
  font-size: 23px;
}

.son .right .up ul:first-of-type li:not(:first-of-type) {
  color: #34495e;
  font-size: 12.5px;
  letter-spacing: .5px;
  line-height: 20px
}

.son .right .up ul:last-of-type li {
  display: inline-block;
  color: #bdc3c7;
  text-transform: uppercase;
  font-size: 11px;
  font-weight: bold;
  padding: 8px 25px;
  transition: all .3s ease-in-out;
  border-bottom: 2px solid transparent;
}

.son .right .up ul:last-of-type li + li {
  margin-left: 44px;
  margin-top: 29px;
}

.son .right .up ul:last-of-type li:hover,
.son .right .up ul:last-of-type .activecr {
  border-bottom: 2px solid #2C73D2;
  color: #2c3e50;
}

.son .right .down {
  width: 100%;
  height: calc(100% - 43%);
  padding: 30px 0 40px 80px;
}

.son .right .down .payment form label {
  display: block;
  color: #bdc3c7;
  font-size: 11px;
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 7px
}

.son .right .down .payment form input {
  border: 1px solid transparent;
  box-shadow: 0px 0px 17px 0px rgba(50, 50, 50, 0.12);
  padding: 7px;
  margin-bottom: 20px;
  color: #34495e;
  border: 1px solid #ecf0f1;
  border-radius: 3px
}

.son .right .down .payment form label {
  transition: all .3s ease-in-out
}

.son .right .down .payment form .form-group:hover label/*******,
.son .right .down .payment form .form-group .cardNumber *******/ {
  color: #2c3e50
}

.son .right .down .payment form .form-control1 {
  width: 257px
}

.son .right .down .payment form select {
  border: none;
  border-bottom: 1.5px solid #bdc3c7;
  color: #bdc3c7;
  margin-right: 20px;
  font-size: 11px;
  margin-bottom: 20px;
  box-shadow:  0px 0px 22px 0px rgba(50, 50, 50, 0.09);
  padding: 5px
}

.son .right .down .payment form .lab {
  width: 190px;
}

.son .right .down .payment form .lab,
.son .right .down .payment form .lab select {
  transition: all .3s ease-in-out
}


.son .right .down .payment form .lab:hover label{
  color: #2c3e50;
}

.son .right .down .payment form .lab:hover select,
.son .right .down .payment form .CVV input:hover {
  color: #2c3e50;
  border-bottom: 1.5px solid #2c3e50
}

.son .right .down .payment form .form-group1 {
  position: relative
}

.son .right .down .payment form .CVV {
  width: 75px;
  position: absolute;
  top: 0px;
  right: 40px;
  height: 100%;
}

.son .right .down .payment form .CVV input {
  width: 70px;
  padding: 4px;
  margin-bottom: 0;
  transition: all .3s ease-in-out;
  border-bottom: 1.5px solid transparent
}

.btn {
  margin-top: 5px
}
.son .right .down .payment form button {
  background-image: linear-gradient(to left, #845ec2, #7464c8, #6169cd, #4b6ed0, #2c73d2);
  border: none;
  padding: 13px;
  width: 256px;
  color: #fff;
  font-size: 18px;
  box-shadow:  0px 0px 22px 0px rgba(50, 50, 50, .4);
  border-radius: 5px;
  cursor: pointer;
  position: relative
}

.right .down .payment form button:after {
  content:'Donate Now!';
  display: inline-block;
  color: #fff;
  font-size: 18px;
  line-height: 49px;
  width: 256px;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-image: linear-gradient(to left bottom, #2c73d2, #6d6fd2, #9869cc, #ba63c1, #d65db1);
  opacity: 0;
  border-radius: 5px;
  cursor: pointer;
  transition: opacity .2s ease-in-out
}

.right .down .payment form button:hover:after {
  opacity: 1
}

/*== End Right ==*/

/*== Start Media ==*/

@media (max-width: 710px) {

  .parent {
    padding: 0;
    min-height: 1020px
  }

  .parent .son .container {
    right: 0
  }
  .son .container .left,
  .son .container .right {
    display: block;
    margin: 0 auto
  }

  .son .container .right {
    top: 0;
    right: 0;
    margin-top: 50px;
  }
  .son .container .right .up {
    padding: 40px 0 0 0;
    text-align: center
  }

  .son .container .right .down {
    padding: 40px 0px 40px 40px
  }

  .son .right .down .payment form button,
  .right .down .payment form button:after {
    width: 296px
  }

  .son .right .down .payment form .form-control1 {
    width: 295px;
  }
}

@media (max-width: 415px) {
  .son .container .left,
  .son .container .right {
    width: 97%;
  }


  .son .right .up ul:first-of-type li:not(:first-of-type) {
    margin: 0 20px
  }

  .son .right .up ul:last-of-type li {
    display: inline-block;
  }

  .btn {
    text-align: center;
    margin-right: 25px;
  }
  .son .right .down .payment form button,
  .right .down .payment form button:after {
    width: 200px;
  }
}

@media (max-width: 370px) {
  .son .right .down .payment form .form-control1 {
    width: 200px;
  }

  .son .right .down .payment form .CVV {
    width: 90px;
    position: static;
    top: 0;
    right: 0;
    margin-bottom: 20px
  }

  .son .right .down .payment form .CVV input {
    width:  90px
  }
}

/*== End Media ==*/

</style>
<body>


<div class="parent">
    <div class="son">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default credit-card-box">
                        <div class="up">
                            <ul>
                                <li>
                                    <h3 class="panel-title">Payment Details</h3>
                                </li>
                            </ul>
                            <ul>
                                <li class="activecr">credit card</li>
                            </ul>
                        </div>
                        <div class="down">
                            <div class="payment">
                                <div class="panel-body" style="background-color: #f7f7f7;">
                                    @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                    @endif
                                    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                                        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                        @csrf
                                        <div class='form-row row'>
                                            <div class='col-xs-12 form-group required'>
                                                <label class='control-label'>Order ID</label>
                                                <input class='form-control' size='4' type='text' name="order_id" value="{{ $order->id }}" readonly>
                                            </div>
                                        </div>
                                        <div class='form-row row'>
                                            <div class='col-xs-12 form-group required'>
                                                <label class='control-label'>Client Name</label>
                                                <input class='form-control' size='4' type='text' name="client_name" value="{{ $order->client->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class='form-row row'>
                                            <div class='col-xs-12 form-group required'>
                                                <label class='control-label'>Card Number</label>
                                                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                            </div>
                                        </div>
                                        <div class='form-row row'>
                                            <div class='col-xs-4 form-group cvc required'>
                                                <label class='control-label'>CVC</label>
                                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                            </div>
                                            <div class='col-xs-4 form-group expiration required'>
                                                <label class='control-label'>Expiration</label>
                                                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                            </div>
                                            <div class='col-xs-4 form-group expiration required'>
                                                <label class='control-label'> </label>
                                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                            </div>
                                        </div>
                                        <div class='form-row row'>
                                            <div class='col-md-12 error form-group hide'>
                                                <div class='alert-danger alert'>
                                                    Please correct the errors and try again.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                            <div class="col-xs-12">
                                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{ number_format($order->total_price, 2) }})</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">

$(function() {

    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });

        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }

    });

    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
</html>