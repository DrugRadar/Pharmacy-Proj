@extends('layouts.app')
@section('content')
<div>
    <form method="POST" action="{{route('medicine.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput0" class="form-label">Medicine Name</label>
            <input type="text" name="name" class="form-control w-50" id="exampleFormControlInput0" placeholder="Medicine Name">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Medicine Type</label>
            <input type="text" name="type" class="form-control w-50" id="exampleFormControlInput1" placeholder="Medicine Type">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea2" class="form-label">Medicine Price</label>
            <input type="Number" name="price" class="form-control w-50" id="exampleFormControlInput2" placeholder="Medicine Price">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea3" class="form-label">Medicine Quantity</label>
            <input type="Number" name="quantity" class="form-control w-50" id="exampleFormControlInput3" placeholder="Medicine Quantity">
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection