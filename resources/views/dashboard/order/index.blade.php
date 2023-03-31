@extends('layouts.app')
@section('content')
<div>
    <h1>Orders</h1>

    <div class="text-center">
        <a href="{{route('order.create')}}" class="mt-4 btn btn-success">Create Order</a>
    </div>

</div>

@endsection