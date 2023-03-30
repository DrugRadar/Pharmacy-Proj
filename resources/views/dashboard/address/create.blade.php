@extends('layouts.app')
@section('content')
<div>
    <form method="POST" action="{{route('address.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">area</label>
            <select name="area_id" class="form-control w-50" id="creator">
                @foreach($areas as $area)
                <option value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">client_id</label>
            <select name="client_id" class="form-control w-50" id="creator">
                @foreach($clients as $client)
                <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">street_name</label>
            <input type="text" name="street_name" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Name">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">building_number</label>
            <input type="text" name="building_number" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Address">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">floor_number</label>
            <input type="text" name="floor_number" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Address">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">flat_number</label>
            <input type="text" name="flat_number" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Address">
        </div>
        <div class="mb-3">
            <label for="is_main" class="form-label">is_main</label>
            <select name="is_main" class="form-control w-50" id="is_main">
                <option value=1>Yes</option>
                <option value=0>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection