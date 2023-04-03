@extends('layouts.app')
@section('content')
<div class="col-12">
    <h1>Doctor</h1>

    <form method="POST" action="{{route(Auth::user()->hasrole('doctor')?'doctor.profile.update':'doctor.update',$doctor->id)}}" enctype="multipart/form-data" class="w-lg-50 row mx-auto">

        @csrf
        @method('put')
        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-100" id="exampleFormControlInput1" placeholder="Doctor Name" value="{{ old('name', $doctor->name) }}">
            @error('name')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="exampleFormControlTextarea1" class="form-label">national_id</label>
            <input type="text" name="national_id" class="form-control w-100" id="exampleFormControlInput1" placeholder="Doctor National id"
                value="{{ old('national_id', $doctor->national_id) }}">
                @error('national_id')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
        </div>

        <div class="mb-3 col-12">
            <label for="exampleFormControlTextarea1" class="form-label">Email</label>
            <input type="text" name="email" class="form-control w-100" id="exampleFormControlInput1" placeholder="Doctor Email"  value="{{ old('email', $doctor->email) }}">
            @error('email')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="exampleFormControlTextarea1" class="form-label">Password</label>
            <input type="text" name="password" class="form-control w-100" id="exampleFormControlInput1" placeholder="Doctor Password" value="{{ old('password', $doctor->password) }}">
            @error('password')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="exampleFormControlTextarea1" class="form-label">Pharmacy Name</label>
            <select name="pharmacy_id" class="form-control w-100 p-1">
            <option value="{{$doctor->pharmacy->id}}" >{{$doctor->pharmacy->name}}</option>
            {{Auth::user()->hasrole('admin')?' ':''}} 
                @if(Auth::user()->hasrole('admin'))
                @foreach($pharmacies as $pharmacy)
                <option value="{{$pharmacy->id}}" {{ old('pharmacy_id', $pharmacy->id) == '1' ? 'selected' : '' }}>{{$pharmacy->name}}</option>
                @endforeach
                @endif
            </select>
            @error('pharmacy_id')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <label class="form-check-label">avatar image</label>
        <input class="form-control w-100" type="file" id="formFile" name="avatar_image">
        @error('avatar_image')
            <p class="text-danger mt-1">{{ $message }}</p>
        @enderror

        <div class="mb-3 col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection