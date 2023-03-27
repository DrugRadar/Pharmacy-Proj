@extends('layouts.app')
@section('content')
<div>
    <h1>Areas</h1>
    <div class="text-center">
        <a href="{{route('area.create')}}" class="mt-4 btn btn-success">Create Area</a>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Area name</th>
                <th scope="col">Area Address</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        @foreach($areas as $area)
        <tr>
            <td>{{$area->name}}</td>
            <td>{{$area->address}}</td>
            <td>
                <button class="btn btn-info"><a href="">Edit</a></button>
                <button class="btn btn-info"><a href="">Delete</a></button>
            </td>
           
        </tr>

        @endforeach
    </table>

</div>
@endsection