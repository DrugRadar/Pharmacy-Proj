@extends('layouts.app')
@section('content')
<div class="col-12">
    <h1>Medicine</h1>
    <form method="POST" action="{{route('medicine.update',$medicine->id)}}" class="w-lg-50 mx-auto">
        @csrf
        @method('put')
        <div class="mb-3 col-12">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-100" id="exampleFormControlInput1" placeholder="" value="{{ old('name', $medecine->name) }}">
            @error('name')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12">
            <label for="exampleFormControlTextarea1" class="form-label">Type</label>
            <input type="text" name="type" class="form-control w-100" id="exampleFormControlInput1" placeholder="Medicine type" value="{{ old('type', $medecine->type) }}">
            @error('type')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12">
            <label for="exampleFormControlTextarea2" class="form-label">Medicine Price</label>
            <input type="Number" name="price" class="form-control w-100" id="exampleFormControlInput2" placeholder="Medicine price" value="{{ old('price', $medecine->price) }}">
            @error('price')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection