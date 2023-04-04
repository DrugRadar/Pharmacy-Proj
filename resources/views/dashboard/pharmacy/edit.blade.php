@extends('layouts.app')
@section('content')

<div class="col-12">
    <form method="POST" action="{{route(Auth::user()->hasrole('pharmacy')?'pharmacy.profile.update':'pharmacy.update',$pharmacy->id)}}" enctype="multipart/form-data" class="w-lg-75 row mx-auto">
        @csrf
        @method('put')
        <div class="card">
            <div class="row g-0">
                <div class="col-md-4 d-flex flex-column justify-content-center">
                    <div class="col-12 m-0" style="max-height: 60%;">
                        @if($pharmacy->getFirstMediaUrl('avatar_image', 'thumb'))
                            <img src="{{$pharmacy->getFirstMediaUrl('avatar_image', 'thumb')}}" alt="profile picture" class="img-fluid rounded-start" style="width:100%; height:82%;">
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
                                @if(Auth::user()->hasrole('admin'))
                                @foreach($areas as $area)
                                <option value="{{$area->id}}" {{ old('area_id', $pharmacy->area_id) == $area->id ? 'selected' : '' }}>{{$area->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('area_id')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-2 col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection