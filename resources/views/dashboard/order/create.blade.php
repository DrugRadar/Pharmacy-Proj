@extends('layouts.app')
@section('content')
<div class="">
    <h1>Create Order</h1>

    <form method="POST" action="{{route('order.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-between">
        <div class="mb-3 mt-3 col-4 p-0">
            <label for="exampleFormControlInput1" class="form-label">Client Name</label>
                    <select class="js-example-basic-single js-example-responsive" style="width: 50%" name="client_id">
                    @foreach($clients as $client)
                            <option value="{{$client->id}}">{{
                                $client->name    
                            }}</option>
                    @endforeach
                    </select>
        </div>
        <div class="mb-3 mt-3 col-4 p-0">
            <label for="exampleFormControlInput1" class="form-label">Client Address</label>
                    <select class="js-example-basic-single js-example-responsive" style="width: 50%" name="client_address_id">
                    @foreach($addresses as $address)
                            <option value="{{$address->id}}">{{
                              $address->street_name . ' ' . $address->building_number     
                            }}</option>
                    @endforeach
                    </select>
        </div>
        <div class="mb-3 mt-3 col-4 p-0">
            <label for="exampleFormControlInput1" class="form-label">Client insured?</label>
                    <select class="js-example-basic-single js-example-responsive" style="width: 50%" name="is_insured">
               
                            <option value="0">
                              No  
                            </option>
                            <option value="1">
                              Yes  
                            </option>
              
                    </select>
        </div>
        </div>
        <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label col-2 p-0">Medicines</label>
                    <select class="js-example-basic-single-tags js-example-responsive col-8 p-0" multiple="multiple" style="width: 50%" name="medicine_id[]">
                    @foreach($medicines as $medicine)
                            <option value="{{$medicine->id}}">{{
                                $medicine->name    
                            }}</option>
                    @endforeach
                    </select>
        </div>
        @if(Auth::user()->hasrole('admin'))
        <div class="mb-3 mt-3 me-2">
            <label for="exampleFormControlInput1" class="form-label col-2 p-0">Assigned Pharmacy</label>
                    <select class="js-example-basic-single js-example-responsive col-8 p-0" id="pharmacy" style="width: 50%" name="assigned_pharmacy_id">
                    @foreach($pharmacies as $pharmacy)
                            <option value="{{$pharmacy->id}}">{{
                                $pharmacy->name    
                            }}</option>
                    @endforeach
                    </select>
        </div>
        @endif
        <div class="mb-3 mt-3 me-2">
            <label for="exampleFormControlInput1" class="form-label col-2 p-0">Doctor</label>
                    <select class="js-example-basic-single js-example-responsive col-8 p-0" id="pharmacy" style="width: 50%" name="doctor_id">
                    @foreach($doctors as $doctor)
                            <option value="{{$doctor->id}}">{{
                                $doctor->name    
                            }}</option>
                    @endforeach
                    </select>
        </div>
        @if(Auth::user()->hasrole('admin'))
        <div class="mb-3 mt-3 me-2">
            <label for="exampleFormControlInput1" class="form-label col-2 p-0">Creator Type</label>
                    <select class="js-example-basic-single js-example-responsive col-8 p-0" style="width: 50%" name="creator_type">
                            <option value="client">
                           Client
                           </option>
                           <option value="client">
                           Doctor
                           </option>
                           <option value="client">
                           Pharmacy
                           </option>
                    </select>
        </div>
        @endif
        <div class="mb-3 mt-3 me-2">
            <label for="exampleFormControlInput1" class="form-label col-2 p-0">status</label>
                    <select class="js-example-basic-single js-example-responsive col-8 p-0" style="width: 50%" name="status">
                            <option value="processing">
                            Processing
                           </option>
                           <option value="waiting">
                           Waiting For User Confirmation
                           </option>
                           <option value="confirmed">
                           Confirmed
                           </option>
                           <option value="delivered">
                           Delivered
                           </option>
                           <option value="canceled">
                           Canceled
                           </option>
                    </select>
        </div>
        <div class="mb-3 p-0">
            <label for="exampleFormControlTextarea1" class="form-label col-2 p-0 text-2xl">Total Price</label>
            <input type="number" name="total_price" class="form-control w-50 col-8" id="exampleFormControlInput1" placeholder="Total Price">
        </div>
        <button type="submit" class="btn btn-success align-self-end">Order</button>
    </form>
</div>
@endsection
@section('scripts')
<script>
let assigned_pharmacy_id;
$('#pharmacy').change(function(){
    assigned_pharmacy_id=$(this).val();
})
$(document).ready(function() {
    $('.js-example-basic-single-tags').select2({  tags: true});
    $('.js-example-basic-single').select2();
});



</script>
@endsection