@extends('layouts.app')
@section('content')
<div class="col-12">
    <form method="POST" action="{{route('pharmacy.store')}}" enctype="multipart/form-data" class="w-lg-50 row mx-auto">
        @csrf

        <div class="mb-3 col-6">
            <label for="nameInput" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-100" id="nameInput" placeholder="Pharmacy Name" value="{{old('name')}}">
            @error('name')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="NationalIdInput" class="form-label">National id</label>
            <input type="text" name="national_id" class="form-control w-100" id="NationalIdInput" placeholder="Pharmacy National id"
                value="{{old('national_id')}}">
            @error('national_id')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="EmailInput" class="form-label">Email</label>
            <input type="text" name="email" class="form-control w-100" id="EmailInput"placeholder="Pharmacy Email"value="{{old('email')}}">
            @error('email')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-12">
            <label for="PasswordInput" class="form-label">Password</label>
            <input type="text" name="password" class="form-control w-100" id="PasswordInput"placeholder="Pharmacy Password" value="{{old('password')}}">
            @error('password')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="PriorityInput" class="form-label">Priority</label>
            <input type="text" name="priority" class="form-control w-100" id="PriorityInput"placeholder="Pharmacy priority" value="{{old('priority')}}">
            @error('priority')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="AreaInput" class="form-label">Area</label>
            <select name="area_id" class="form-control w-100" id="AreaInput">
                @foreach($areas as $area)
                <option value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
            </select>
            @error('area_id')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="AvatarInput" class="form-check-label">avatar image</label>
            <input class="form-control w-100" type="file" id="AvatarInput" name="avatar_image">
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