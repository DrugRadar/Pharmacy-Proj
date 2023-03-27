@extends('layouts.app')
@section('content')
<div>
    <h1>Pharmacies</h1>
    <div class="text-center">
        <a href="{{route('pharmacy.create')}}" class="mt-4 btn btn-success">Create Pharmacy</a>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Pharmacy name</th>
                <th scope="col">ID</th>
                <th scope="col">National id</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        @foreach($pharmacies as $pharmacy)
        <tr>
            <td>{{$pharmacy->name}}</td>
            <td>{{$pharmacy->id}}</td>
            <td>{{$pharmacy->national_id}}</td>
            <td><button class="btn btn-info"><a href="{{route('pharmacy.edit',$pharmacy->id)}}">Edit</a></button></td>
        </tr>

        @endforeach
    </table>

</div>
@endsection