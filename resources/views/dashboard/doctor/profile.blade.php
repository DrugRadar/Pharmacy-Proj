@extends('layouts.app')
@section('content')

<section class="vh-75" style="background-color: #f4f5f7;">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-6 mb-4 mb-lg-0">
            <div class="card mb-3" style="border-radius: .5rem;">
            <div class="row g-0">
                <div class="col-md-4 gradient-custom text-center text-white"
                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                <img src="{{url("storage/image/".$doctor->avatar_image)}}"
                    alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                <h5>Marie Horwitz</h5>
                <p>Web Designer</p>
                <i class="far fa-edit mb-5"></i>
                </div>
                <div class="col-md-8">
                <div class="card-body p-4">
                    <h6>Profile Details</h6>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <h6>Name</h6>
                        <p class="text-muted">{{$doctor->name}}</p>
                    </div>
                    <div class="col-6 mb-3">
                        <h6>Email</h6>
                        <p class="text-muted">{{$doctor->email}}</p>
                    </div>
                    </div>
                    <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <h6>Member since</h6>
                        <p class="text-muted">{{$doctor->created_at}}</p>
                    </div>
                    </div>
                    {{-- <hr class="mt-0 mb-4"> --}}
                    <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <h6>National ID</h6>
                        <p class="text-muted">{{$doctor->national_id}}</p>
                    </div>
                    <div class="col-6 mb-3">
                        <h6>Pharmacy Name</h6>
                        <p class="text-muted">{{$doctor->Pharmacy->name}}</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

@endsection