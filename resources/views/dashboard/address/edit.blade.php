@extends('layouts.app')
@section('content')
<div class="col-12">
    <h1>Addresses</h1>
    <form method="POST" action="{{route('address.update',$address->id)}}" class="row w-lg-50 mx-auto">
        @csrf
        @method('put')
        <div class="mb-3 col-12">
            <label for="exampleFormControlTextarea1" class="form-label">client Name</label>
            <select name="client_id" class="form-control w-100" id="creator">
                @foreach($clients as $client)
                <option value="{{$client->id}}" {{ old('client_id', $client->id) == $client->id ? 'selected' : '' }}>{{$client->name}}</option>
                @endforeach
            </select>
            @error('client_id')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="exampleFormControlTextarea1" class="form-label">Area</label>
            <select name="area_id" class="form-control w-100" id="creator">
                @foreach($areas as $area)
                <option value="{{$area->id}}" {{ old('area_id', $area->id) == $area->id ? 'selected' : '' }}>{{$area->name}}</option>
                @endforeach
            </select>
            @error('area_id')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="exampleFormControlInput1" class="form-label">Street Name</label>
            <input type="text" name="street_name" class="form-control w-100" id="exampleFormControlInput1" placeholder="Adrees street Name" value="{{ old('street_name', $address->street_name) }}">
            @error('street_name')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-4">
            <label for="exampleFormControlTextarea1" class="form-label">Building Number</label>
            <input type="text" name="building_number" class="form-control w-100" id="exampleFormControlInput1" placeholder="Address building number"value="{{ old('building_number', $address->building_number) }}">
            @error('building_number')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-4">
            <label for="exampleFormControlTextarea1" class="form-label">Floor Number</label>
            <input type="text" name="floor_number" class="form-control w-100" id="exampleFormControlInput1" placeholder="Address floor number" value="{{ old('floor_number', $address->floor_number) }}">
            @error('floor_number')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-4">
            <label for="exampleFormControlTextarea1" class="form-label">Flat Number</label>
            <input type="text" name="flat_number" class="form-control w-100" id="exampleFormControlInput1" placeholder="Address flat number" value="{{ old('flat_number', $address->flat_number) }}">
            @error('flat_number')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 col-4">
            <label for="is_main" class="form-label">is_main</label>
            <select name="is_main" class="form-control w-100" id="is_main" value="{{ old('is_main', $address->is_main) }}" >
                <option value=1 {{ old('is_main', $address->is_main) == '1' ? 'selected' : '' }} >Yes</option>
                <option value=0 {{ old('is_main', $address->is_main) == '0' ? 'selected' : '' }}>No</option>
            </select>
            @error('is_main')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <br>
        
        <div class="mb-3 col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-success mx-auto">Update</button>
        </div>
    </form>
</div>
@endsection