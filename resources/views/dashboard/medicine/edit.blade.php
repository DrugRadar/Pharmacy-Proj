@extends('layouts.app')
@section('content')
<div class="col-12">
    <h1>Medicine</h1>
    <form method="POST" action="{{route('medicine.update', $medicine->id)}}" enctype="multipart/form-data" class="w-lg-50 row mx-auto">
        @csrf
        @method('put')
        <div class="mb-3 col-12">
            <label for="medicineName" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-100" id="medicineName" placeholder="" value="{{ old('name', $medicine->name) }}">
            @error('name')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12">
            <label for="medicineType" class="form-label">Type</label>
            <input type="text" name="type" class="form-control w-100" id="medicineType" placeholder="Medicine type" value="{{ old('type', $medicine->type) }}">
            @error('type')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12">
            <label for="medicinePrice" class="form-label">Medicine Price</label>
            <input type="Number" name="price" class="form-control w-100" id="medicinePrice" placeholder="Medicine price" value="{{ old('price', $medicine->price) }}">
            @error('price')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-2 col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection