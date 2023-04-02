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
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control w-100" id="exampleFormControlInput1" placeholder="Pharmacy Name" value="{{ old('name', $pharmacy->name) }}">
                @error('name')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-6">
                <label for="exampleFormControlTextarea1" class="form-label">national_id</label>
                <input type="text" name="national_id" class="form-control w-100" id="exampleFormControlInput1" placeholder="Pharmacy National id"
                    value="{{ old('national_id', $pharmacy->national_id) }}">
                @error('national_id')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-12">
                <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                <input type="text" name="email" class="form-control w-100" id="exampleFormControlInput1" placeholder="Pharmacy Eamil" value="{{ old('email', $pharmacy->email) }}">
                @error('email')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-6">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                <input type="text" name="password" class="form-control w-100" id="exampleFormControlInput1" placeholder="Pharmacy Password" value="{{ old('password', $pharmacy->password) }}">
                @error('password')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-6">
                <label for="exampleFormControlTextarea1" class="form-label">area</label>
                <select name="area_id" class="form-control w-100" id="creator">
                    @foreach($areas as $area)
                    <option value="{{$area->id}}" {{ old('area_id', $area->id) == '1' ? 'selected' : '' }}>{{$area->name}}</option>
                    @endforeach
                </select>
                @error('area_id')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2 col-12">
                <label class="form-check-label">avatar image</label>
                <input class="form-control w-100" type="file" id="formFile" name="avatar_image">
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