@component('mail::message')
# Order Confirmation

Hello {{ $order->client->name }},

Thank you for your order. We have received your request and will process it shortly. Please find the details of your order below:

**Order ID:** {{ $order->id }}<br>
**Order Date:** {{ $order->created_at }}<br>

If you would like to confirm your order, please click the button below:

@component('mail::button', ['url' => route('stripe', ['id' => $order->id])])
    Confirm Order
@endcomponent

If you would like to cancel your order, please click the button below:
   
@component('mail::button', ['url' => route('order.orderCancel', $order->id)])
  Cancel Order
@endcomponent


Thank you for your business!

Regards,<br>
The DrugRadar Team
@endcomponent
