@extends('layouts.app')
@section('content')
<div>
    <h1>Doctors</h1>
    <div class="text-center">
        <a href="{{route('doctor.create')}}" class="mt-4 btn btn-success">Create Doctor</a>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Doctor name</th>
                <th scope="col">ID</th>
                <th scope="col">National id</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        @foreach($doctors as $doctor)
        <tr>
            <td>{{$doctor->name}}</td>
            <td>{{$doctor->id}}</td>
            <td>{{$doctor->national_id}}</td>
            <td>

                <a href="{{route('doctor.edit',$doctor->id)}}"><button class="btn btn-info">Edit</button></a>
                @if($doctor->isBanned())
                <a href="{{route('doctor.unBan',$doctor->id)}}"><button class="btn btn-dark">UnBan</button></a>
                @else
                <a href="{{route('doctor.ban',$doctor->id)}}"><button class="btn btn-dark">Ban</button></a>
                @endif
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal-{{$doctor->id}}">DELETE </button>
                <div class="modal fade" id="exampleModal-{{$doctor->id}}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Delete Doctor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-title">Are you sure you want to Delete this record?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">CANCEL</button>
                                <form method="POST" action="{{route('doctor.destroy',$doctor->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger m-0">DELETE</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>

        @endforeach
    </table>

</div>
@endsection