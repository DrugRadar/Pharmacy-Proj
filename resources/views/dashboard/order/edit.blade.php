@extends('layouts.app')
@section('content')
<?php use App\Models\Medicine; ?>
<?php use App\Models\Doctor; ?>
<?php use App\Models\Pharmacy; ?>
<div class="">
    <h1>Edit Order</h1>

    <form method="POST" action="{{route('order.update',[$order->id])}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        @if($order->orderPrescription )
        <div class="mb-3 mt-3 col-4 p-0">
            @foreach($order->orderPrescription as $orderPrescription)
            <label for="exampleFormControlInput1" class="form-label">Prescription</label>
            <img id="exampleFormControlInput1"src="{{url('storage/image/'.$orderPrescription->prescription)}}"/>
            @endforeach
        </div>
        @endif
        <div class="mb-3 mt-3 col-4 p-0">
            <label for="exampleFormControlInput1" class="form-label">Order Total price</label>
                    <input class="form-control w-50" style="width: 50%" name="client_id" id="exampleFormControlInput1" value="{{$order->total_price}}" disabled>
                    </input>
        </div>
        <div class="d-flex justify-content-between">

        <div class="mb-3 mt-3 col-4 p-0">
            <label for="exampleFormControlInput1" class="form-label">Client Name</label>
                    <input class="form-control w-50" style="width: 50%" name="client_id" id="exampleFormControlInput1" value="{{$client->name}}" disabled>
                    </input>
        </div>
        <div class="mb-3 mt-3 col-4 p-0">
            <label for="exampleFormControlInput1" class="form-label">Client Address</label>
            <!-- <input class="form-control w-50" style="width: 50%" name="client_address" id="exampleFormControlInput1" value="{{$clientAddress->street_name}}" disabled> -->
            <select class="js-example-basic-single js-example-responsive form-control w-50" style="width: 50%" name="client_address_id" value="{{$clientAddress->street_name}}">        
            @foreach($addresses as $address)
                            <option  value="{{$address->id}}">{{
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
                    @foreach($order->orderMedicine as  $key =>  $medicine)
                            <option  value="{{$medicine->medicine_id?$medicine->medicine_id:$medicine->medicine_name}}" selected="selected">{{  
                                $medicine->medicine_name?$medicine->medicine_name:Medicine::find($medicine->medicine_id)->name
                            }}</option>

                    @endforeach
                    @foreach($medicines as  $medicine)
                            <option  value="{{$medicine->id}}">{{  
                               $medicine->name
                            }}</option>
                    @endforeach
                    </select>
        </div>
        @if(Auth::user()->hasrole('admin'))
        <div class="mb-3 mt-3 me-2">
            <label for="exampleFormControlInput1" class="form-label col-2 p-0">Assigned Pharmacy</label>
                    <select class="js-example-basic-single js-example-responsive col-8 p-0" id="pharmacy" style="width: 50%" name="assigned_pharmacy_id">
                    @if($order->assigned_pharmacy_id)
                    <option value="{{$order->assigned_pharmacy_id}}">{{
                        Pharmacy::find($order->assigned_pharmacy_id)->name   
                            }}</option>
                    @endif        
                    @foreach($pharmacies as $pharmacy)
                            <option value="{{$pharmacy->id}}">{{
                                $pharmacy->name    
                            }}</option>
                    @endforeach
                    </select>
        </div>
        @endif
        @if(Auth::user()->hasrole('admin')||Auth::user()->hasrole('pharmacy'))
        <div class="mb-3 mt-3 me-2">
            <label for="exampleFormControlInput1" class="form-label col-2 p-0">Doctor</label>
                    <select class="js-example-basic-single js-example-responsive col-8 p-0" id="pharmacy" style="width: 50%" name="doctor_id">
                    @if($order->doctor_id)
                    <option value="{{$order->doctor_id}}">{{
                        Doctor::find($order->doctor_id)->name   
                            }}</option>
                    @endif        
                    @foreach($doctors as $doctor)
                            <option value="{{$doctor->id}}">{{
                                $doctor->name    
                            }}</option>
                    @endforeach
                    </select>
        </div>
        @endif
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
                    <select class="js-example-basic-single js-example-responsive col-8 p-0" style="width: 50%" name="status" value='{{$order->status}}'>
                    <option value="canceled">
                           New
                           </option>        
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
        <button type="submit" class="btn btn-success align-self-end">continue</button>
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
    $('.js-example-basic-single-tags').select2({
        tags: true,
    tokenSeparators: [',']});
    $('.js-example-basic-single').select2();
});



</script>
@endsection