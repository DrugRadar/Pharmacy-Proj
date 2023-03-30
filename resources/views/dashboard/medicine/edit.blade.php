@extends('layouts.app')
@section('content')
<div>
    <h1>Medicine</h1>
    <form method="POST" action="{{route('medicine.update',$medicine->id)}}">
        @csrf
        @method('put')
        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-50" id="exampleFormControlInput1" placeholder="" value="{{ $medicine -> name }}">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Type</label>
            <input type="text" name="type" class="form-control w-50" id="exampleFormControlInput1" placeholder="" value="{{ $medicine -> type }}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea2" class="form-label">Medicine Price</label>
            <input type="Number" name="price" class="form-control w-50" id="exampleFormControlInput2" placeholder=""value="{{ $medicine -> price }}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea3" class="form-label">Medicine Quantity</label>
            <input type="Number" name="quantity" class="form-control w-50" id="exampleFormControlInput3" value="{{ $medicine -> quantity }}">
        </div>

        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection