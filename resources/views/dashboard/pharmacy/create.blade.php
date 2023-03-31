@extends('layouts.app')
@section('content')
<div>
    <form method="POST" action="{{route('pharmacy.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-50" id="exampleFormControlInput1" placeholder="Pharmacy Name" value="{{old('name')}}">
            @error('name')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Email</label>
            <input type="text" name="email" class="form-control w-50" id="exampleFormControlInput1"placeholder="Pharmacy Email"value="{{old('email')}}">
            @error('email')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Password</label>
            <input type="text" name="password" class="form-control w-50" id="exampleFormControlInput1"placeholder="Pharmacy Password">
            @error('password')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">national_id</label>
            <input type="text" name="national_id" class="form-control w-50" id="exampleFormControlInput1" placeholder="Pharmacy National id"
                value="{{old('national_id')}}">
            @error('national_id')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">area</label>
            <select name="area_id" class="form-control w-50" id="creator">
                @foreach($areas as $area)
                <option value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
            </select>
            @error('area_id')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <label class="form-check-label">avatar image</label>
        <input class="form-control w-50" type="file" id="formFile" name="avatar_image">
        @error('avatar_image')
            <p class="text-danger mt-1">{{ $message }}</p>
        @enderror
        
        <br>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection