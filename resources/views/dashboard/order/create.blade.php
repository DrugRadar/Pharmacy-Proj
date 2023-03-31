@extends('layouts.app')
@section('content')
<div class="me-5">
    <form method="POST" action="{{route('order.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">Client Name</label>
                    <select class="js-example-basic-single js-example-responsive" style="width: 50%" name="client_id">
                    @foreach($clients as $client)
                            <option value="{{$client->id}}">{{
                                $client->name    
                            }}</option>
                    @endforeach
                    </select>
        </div>
        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">Medicines</label>
                    <select class="js-example-basic-single-tags js-example-responsive" multiple="multiple" style="width: 50%" name="client_address_id">
                    @foreach($medicines as $medicine)
                            <option value="{{$medicine->id}}">{{
                                $medicine->name    
                            }}</option>
                    @endforeach
                    </select>
        </div>
        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">Client Address</label>
                    <select class="js-example-basic-single js-example-responsive" style="width: 50%" name="client_address_id">
                    @foreach($pharmacies as $pharmacy)
                            <option value="{{$pharmacy->id}}">{{
                                $pharmacy->name    
                            }}</option>
                    @endforeach
                    </select>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('.js-example-basic-single-tags').select2({  tags: true});
    $('.js-example-basic-single').select2();
});
</script>
@endsection