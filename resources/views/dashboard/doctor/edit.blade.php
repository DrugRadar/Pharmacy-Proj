@extends('layouts.app')
@section('content')
<div class="col-12">
    <h1>Doctor</h1>
    <form method="POST" action="{{route(Auth::user()->hasrole('doctor')?'doctor.profile.update':'doctor.update',$doctor->id)}}" enctype="multipart/form-data" class="w-lg-75 row mx-auto">

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
                            <label for="doctor_name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control w-100" id="doctor_name" placeholder="Doctor Name" value="{{ old('name', $doctor->name) }}">
                            @error('name')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-6">
                            <label for="doctorNationalId" class="form-label">national_id</label>
                            <input type="text" name="national_id" class="form-control w-100" id="doctorNationalId" placeholder="Doctor National id"
                                value="{{ old('national_id', $doctor->national_id) }}">
                                @error('national_id')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="doctorEmail" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control w-100" id="doctorEmail" placeholder="Doctor Email"  value="{{ old('email', $doctor->email) }}">
                            @error('email')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-6">
                            <label for="doctorPassword" class="form-label">Password</label>
                            <input type="text" name="password" class="form-control w-100" id="doctorPassword" placeholder="Doctor Password" >
                            @error('password')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-6">
                            <label for="doctorPharmacy" class="form-label">pharmacy Name</label>
                            <select name="pharmacy_id" class="form-control w-100" id="doctorPharmacy">
                                {{Auth::user()->hasrole('admin')?' ':''}}
                                @if(Auth::user()->hasrole('admin'))
                                @foreach($pharmacies as $pharmacy)
                                <option value="{{$pharmacy->id}}" {{ old('pharmacy_id', $doctor->pharmacy_id) == $pharmacy->id ? 'selected' : '' }}>{{$pharmacy->name}}</option>
                                @endforeach
                                @endif
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