<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/emailCard.css')}}">
    </head>
    <body class="d-flex justify-content-center align-items-center">
    <div class="container">
    
        <div class='view'>
          <div class='card'>
            <div class='wraper'>
              <div class='left-panel'>
                <div class='media-wrapper'>
                  <div class='media'>
                     <img class='figure' src="{{asset('/assets/gifs/cancel_order.png')}}" alt="email picture"  style="width:200px; height:200px;">
                  </div>
                </div>
              </div>
              @if($message == 'canceled')
              <div class='right-panel'>
                <h3> Order Cancelled</h3>
                     <p>We're sorry to hear that you've cancelled your order</p>
                     <p>Thank you for choosing DrugRadar. We hope to serve you again in the future.</p>
              </div>
              @else
              <div class='right-panel'>
                <h3> Order Can't be canceled</h3>
                     <p>We're sorry but you can not cancel this order</p>
                     <p>Thank you for choosing DrugRadar. We hope to serve you again in the future.</p>
              </div>
              @endif
            </div>
          </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
    </body>
</html>
