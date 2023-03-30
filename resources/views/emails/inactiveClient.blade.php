<x-mail::message>
# We miss you!

Hello {{$client->name}},
We noticed that you haven't used our application in a while.
We miss you and hope to see you soon!'

Best Regards,<br>
{{ config('app.name') }}
</x-mail::message>
