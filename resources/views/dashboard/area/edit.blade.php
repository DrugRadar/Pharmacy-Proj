@extends('layouts.app')
@section('content')
<div>
    <h1>Areas</h1>
    <form method="POST" action="{{route('area.update',$area->id)}}">
        @csrf
        @method('put')
        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control w-50" id="exampleFormControlInput1" placeholder="Area name" value="{{ $area -> name }}">
            @error('name')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
            <input type="text" name="address" class="form-control w-50" id="exampleFormControlInput1" placeholder="Adreess" value="{{ $area -> address }}">
            @error('address')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-3">
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection