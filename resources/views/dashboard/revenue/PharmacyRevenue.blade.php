@extends('layouts.app')
@section('content')

<div class="card mx-auto w-50 h-60 d-flex justify-content-center">
    <div class="card-header text-center bg-success text-white" style="font-weight: 500; font-size:large;">
        Total Revenue
    </div>
    <div class="card-body text-center">
        <h5 class="card-title">{{$pharmacy_revenue}}$</h5>
    </div>
</div>

@endsection