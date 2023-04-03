@extends('layouts.app')
@section('content')
<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");

*,
*::before,
*::after {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.card {
    width: 28em;
    text-align: center;
    position: relative;
    padding: 0 0 0.2em 0;
    -webkit-box-shadow: 0 0 10px 8px rgba(0, 0, 0, 0.19);
    box-shadow: 0 0 10px 8px rgba(0, 0, 0, 0.19);
    color: white;
}

.card .profile__picture {
    position: absolute;
    height: 128px;
    width: 128px;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    border: 7px solid #39393f;
    box-shadow: 0 -10px 10px 0 rgba(0, 0, 0, 0.19);
}

.text {
    padding: 3.7em 0 0;
}

.text h3 {
    margin: 0 0 0 0;
    font-size: 1.2rem;
    font-weight: 500;
}

.text h5 {
    margin: 0 0 0 0;
    color: #D8D8D8;
    font-weight: 300;
    font-size: 0.9rem;
}

.text p {
    margin: 0px 0 0 0;
    color: #D8D8D8;
}

.contact {
    padding: 0em 0.5em;
}

.contact hr {
    border: 0;
    height: 1px;
    background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.75), rgba(0, 0, 0, 0));
}
</style>

{{-- <section class="vh-75" style="background-color: #f4f5f7;">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-6 mb-4 mb-lg-0">
            <div class="card mb-3" style="border-radius: .5rem;">
            <div class="row g-0">
                <div class="col-md-12">
                <div class="card-body p-4">
                    <h6>Profile Details</h6>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                    <div class="col-4 mb-3">
                        <h6>Name</h6>
                        <p class="text-muted">{{$admin->name}}</p>
</div>
<div class="col-4 mb-3">
    <h6>Email</h6>
    <p class="text-muted">{{$admin->email}}</p>
</div>
<div class="col-4 mb-3">
    <h6>Member since</h6>
    <p class="text-muted">{{$admin->created_at->diffForHumans()}}</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section> --}}

<div class="card align-self-center bg-gradient-dark">
    <img src="{{asset('assets/gifs/admin.png')}}" alt="profile picture" class="profile__picture">
    <div class="text">
        <h3>Name</h3>
        <p>{{$admin->name}}</p>
        <hr>
    </div>
    <div class="contact row">
        <hr>
        <div class="col-12 ">
            <h5>Email</h5>
            <p>{{$admin->email}}</p>
        </div>
    </div>
    <hr>
    <div class="contact row">
        <hr>
        <div class="col-12">
            <h5>Member since</h5>
            <p>{{$admin->created_at->longRelativeToNowDiffForHumans()}}</p>
        </div>
    </div>
</div>

@endsection