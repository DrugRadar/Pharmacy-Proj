@extends('layouts.app')
@section('content')
<div class="col-12">
    <form method="POST" action="{{route('doctor.store')}}" enctype="multipart/form-data" class="w-lg-50 row mx-auto">
        @csrf

        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-100" id="exampleFormControlInput1" placeholder="Doctor Name" value="{{old('name')}}">
            @error('name')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">National id</label>
            <input type="text" name="national_id" class="form-control w-100" id="exampleFormControlInput1" placeholder="Doctor National id" 
                value="{{old('national_id')}}">
            @error('national_id')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12">
            <label for="exampleFormControlTextarea1" class="form-label">Email</label>
            <input type="text" name="email" class="form-control w-100" id="exampleFormControlInput1" placeholder="Doctor Email" value="{{old('email')}}">
            @error('email')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="exampleFormControlTextarea1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control w-100" id="exampleFormControlInput1" placeholder="Doctor Password">
            @error('password')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-3 col-6">
            <label for="exampleFormControlTextarea1" class="form-label">Pharmacy Name</label>
            <select name="pharmacy_id" class="form-control w-100">
            @if(Auth::user()->hasRole('admin'))
                @foreach($pharmacies as $pharmacy)
                <option value="{{$pharmacy->id}}">{{$pharmacy->name}}</option>
                @endforeach
            @else
                <option value="{{Auth::user()->userable_id}}">{{Auth::user()->name}}</option>
            @endif    
            </select>
            @error('pharmacy_id')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-check-label">avatar image</label>
            <input class="form-control w-100" type="file" id="formFile" name="avatar_image">
            @error('avatar_image')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </form>
</div>
@endsection