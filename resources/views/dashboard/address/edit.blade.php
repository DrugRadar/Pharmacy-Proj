@extends('layouts.app')
@section('content')
<div>
    <h1>Addresses</h1>
    <form method="POST" action="{{route('address.update',$address->id)}}">
        @csrf
        @method('put')
                <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">area</label>
            <select name="area_id" class="form-control w-50" id="creator" value="{{$address->area->name}}">
                {{-- <option >{{$address->area->name}}</option> --}}

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
            <input type="text" name="street_name" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Name" value="{{$address -> street_name}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">building_number</label>
            <input type="text" name="building_number" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Address" value="{{$address -> building_number}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">floor_number</label>
            <input type="text" name="floor_number" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Address" value="{{$address -> floor_number}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">flat_number</label>
            <input type="text" name="flat_number" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Address" value="{{$address -> flat_number}}">
        </div>
        {{-- <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Is_main</label>
            <input type="text" name="is_main" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area Address" value="{{$address -> Is_main}}">
        </div> --}}
        <div class="mb-3">
            <label for="is_main" class="form-label">is_main</label>
            <select name="is_main" class="form-control w-50" id="is_main" value="{{$address->is_main}}" >
                <option value=1>Yes</option>
                <option value=0>No</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection