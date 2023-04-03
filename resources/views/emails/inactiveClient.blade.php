<x-mail::message>
# We miss you!

Hello {{$client->name}},
We noticed that you haven't used our application in a while.

<div style="width: fit-content; margin:0 auto;"><img src="{{asset('/assets/gifs/emailImage.png')}}" alt="email picture"  style="width:200px; height:200px;"></div>

We miss you and hope to see you soon!

Best Regards,<br>
{{ config('app.name') }}
</x-mail::message>
