@extends('layouts.app')
@section('content')
<div class="col-12">
    <h1>Pharmacy</h1>
    <form method="POST" action="{{route('pharmacy.update',$pharmacy->id)}}" enctype="multipart/form-data" class="w-lg-75 row mx-auto">
        @csrf
        @method('put')
        <!-- <div class="col-4">
            @if($pharmacy->getFirstMediaUrl('avatar_image', 'thumb'))
                <img src="{{$pharmacy->getFirstMediaUrl('avatar_image', 'thumb')}}" alt="profile picture" class="profile__picture" style="width:200px; height:200px;">
            @else
                <img src="{{asset('/public/assets/gifs/admin.png')}}" alt="profile picture" class="profile__picture" style="width:200px; height:200px;">
            @endif
        </div> -->

        <div class="col-7 row">
            <div class="mb-2 col-6">
                <label for="nameInput" class="form-label">Name</label>
                <input type="text" name="name" class="form-control w-100" id="nameInput" placeholder="Pharmacy Name" value="{{ old('name', $pharmacy->name) }}">
                @error('name')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-6">
                <label for="NationalIdInput" class="form-label">national_id</label>
                <input type="text" name="national_id" class="form-control w-100" id="NationalIdInput" placeholder="Pharmacy National id"
                    value="{{ old('national_id', $pharmacy->national_id) }}">
                @error('national_id')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-12">
                <label for="EmailInput" class="form-label">Email</label>
                <input type="text" name="email" class="form-control w-100" id="EmailInput" placeholder="Pharmacy Eamil" value="{{ old('email', $pharmacy->email) }}">
                @error('email')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-12">
                <label for="PasswordInput" class="form-label">Password</label>
                <input type="text" name="password" class="form-control w-100" id="PasswordInput" placeholder="Pharmacy Password" value="{{ old('password', $pharmacy->password) }}">
                @error('password')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 col-6">
                <label for="PriorityInput" class="form-label">Priority</label>
                @if(Auth::user()->hasrole('admin'))
                <input type="text" name="priority" class="form-control w-100" id="PriorityInput"placeholder="Pharmacy priority" value="{{$pharmacy->priority}}">
                @else
                <input type="text" name="priority" disabled class="form-control w-100" id="PriorityInput"placeholder="Pharmacy priority" value="{{$pharmacy->priority}}">
                @endif
                @error('priority')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-6">
                <label for="AreaInput" class="form-label">area</label>
                <select name="area_id" class="form-control w-100" id="AreaInput">
                    @foreach($areas as $area)
                    <option value="{{$area->id}}" {{ old('area_id', $area->id) == '1' ? 'selected' : '' }}>{{$area->name}}</option>
                    @endforeach
                </select>
                @error('area_id')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-12">
                <label for="AvatarInput" class="form-check-label">avatar image</label>
                <input class="form-control w-100" type="file" id="AvatarInput" name="avatar_image">
                @error('avatar_image')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection