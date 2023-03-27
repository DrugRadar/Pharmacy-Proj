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
                <button class="btn btn-info"><a href="{{route('area.edit' , $area->id)}}" class="text-decoration-none">Edit</a></button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{$area->id}}">
                  Delete
                </button>

            </td>
           
        </tr>
 <!-- Modal -->
        <div class="modal fade"  id="modal{{$area->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Area</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                    <p>Are you sure you want to delete these Records?</p>
        				<p class="text-warning"><small>This action cannot be undone.</small></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger"><a href="{{route('area.delete' , $area->id)}}" class="text-decoration-none">Delete</a></button>
              </div>
            </div>
          </div>
        </div>
        @endforeach
    </table>
</div>
@endsection
  