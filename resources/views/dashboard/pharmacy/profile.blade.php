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

<div class="card align-self-center bg-gradient-dark">
    <img src="{{$pharmacy->getFirstMediaUrl('avatar_image', 'thumb') ? $pharmacy->getFirstMediaUrl('avatar_image', 'thumb') : asset('assets/gifs/user.png')}}"
        alt="profile picture" class="profile__picture">
    <a href="{{route('pharmacy.profile.edit', Auth::user()->userable_id)}}" class="w-25 align-self-end mt-1 me-1"
        style="border:none; background:transparent; text-decorations:none; color:inherit;  position:relative; top: 28px; right: 128px;"><i
            class='bx bx-edit' style="font-size: 33px;"></i></a>
    <div class="text">
        <h3>Doctor Name</h3>
        <p>{{$pharmacy->name}}</p>
        <hr>
    </div>
    <div class="contact row ">
        <hr>
        <div class="col-6 ">
            <h5>Email</h5>
            <p>{{$pharmacy->email}}</p>
        </div>
        <div class="col-6">
            <h5>National ID</h5>
            <p>{{$pharmacy->national_id}}</p>
        </div>
    </div>
    <hr>
    <div class="contact row">
        <hr>
        <div class="col-6">
            <h5>Area Name</h5>
            <p>{{$pharmacy->Area->name}}</p>
        </div>
        <div class="col-6">
            <h5>Member since</h5>
            <p>{{$pharmacy->created_at->diffForHumans()}}</p>
        </div>
    </div>
</div>

@endsection