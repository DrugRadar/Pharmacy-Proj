@extends('layouts.app')
@section('content')
<div class="col-12">
    <h1>Doctor</h1>
    <form method="POST" action="{{route('doctor.update',$doctor->id)}}" enctype="multipart/form-data" class="w-lg-75 row mx-auto">
        @csrf
        @method('put')
        <div class="card">
            <div class="row g-0">
                <div class="col-md-4 d-flex flex-column justify-content-center">
                    <div class="col-12 m-0" style="max-height: 60%;">
                        @if($doctor->getFirstMediaUrl('avatar_image', 'thumb'))
                            <img src="{{$doctor->getFirstMediaUrl('avatar_image', 'thumb')}}" alt="profile picture" class="img-fluid rounded-start" style="width:100%; height:82%;">
                        @else
                            <img src="{{asset('/assets/gifs/admin.png')}}" alt="profile picture" class="img-fluid rounded-start" style="width:100%; height:82%;">
                        @endif
                        <input class="form-control form-control-sm w-100 mt-2" type="file" id="AvatarInput" name="avatar_image">
                        @error('avatar_image')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card-body row">
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
                            <label for="exampleFormControlTextarea1" class="form-label">doctor Name</label>
                            <select name="pharmacy_id" class="form-control w-100">
                                @foreach($pharmacies as $pharmacy)
                                <option value="{{$pharmacy->id}}" {{ old('pharmacy_id', $pharmacy->id) == '1' ? 'selected' : '' }}>{{$pharmacy->name}}</option>
                                @endforeach
                            </select>
                            @error('pharmacy_id')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection