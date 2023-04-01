@component('mail::message')
@php
  $imagePath = public_path('assets/gifs/admin.png');
  $imageData = base64_encode(file_get_contents($imagePath));
  $imageSrc = 'data:'.mime_content_type($imagePath).';base64,'.$imageData;
@endphp
@component('mail::header', ['url' => ""])
@endcomponent
<center>
<table>
  <tr>
    <td>
      <h1>Order Confirmation</h1>
      <p>Hello {{ $order->client->name }},</p>
      <p>Thank you for your order. We have received your request and will process it shortly. Please find the details of your order below:</p>
      <strong>Order ID:</strong> {{ $order->id }} <br>
      <strong>Order Date:</strong> {{ $order->created_at }} <br>
      <strong>Order Total:</strong> {{ $order->total_price }} <br>
      <p>If you would like to confirm your order, please click the button below:</p>
      <table>
        <tr>
          <td bgcolor="#008000" style="border-radius: 4px;cursor:pointer">
            <a href="{{route('order.orderConfirm' , $order->id)}}" style="color: white; display: inline-block; font-size: 16px; font-weight: 400; line-height: 48px; text-align: center; text-decoration: none; width: 200px;">Confirm Order</a>
          </td>
        </tr>
      </table>
      <p>If you would like to cancel your order, please click the button below:</p>
      <table>
        <tr>
          <td bgcolor="#FF0000" style="border-radius: 4px;;cursor:pointer">
            <a href="" style="color: white; display: inline-block; font-size: 16px; font-weight: 400; line-height: 48px; text-align: center; text-decoration: none; width: 200px;">Cancel Order</a>
          </td>
        </tr>
      </table>
      <p>Thank you for your business!</p>
      <p>Regards,<br>The DrugRadar Team</p>
    </td>
  </tr>
</table>
</center>
@endcomponent