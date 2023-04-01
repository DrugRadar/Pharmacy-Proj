@extends('layouts.app')
@section('content')
<div>
<form method="POST" action="{{route('order.send',[$orderId])}}" enctype="multipart/form-data">
  @csrf
  <div class="d-flex">
            <p type="text" name="medicineName"class="col-4 me-2">Medicine Name </p>
            <p  class="col-4 me-2">Medicine Price</p>
            <p  class="col-4 me-2"> Medicine quantity</p>
            </div>
  @foreach($medicines as $index => $medicine )
  <div class="mb-3 mt-3  p-0">    
            <div class="d-flex">
            <input type="text"class="form-control col-4 me-2" value="{{is_object($medicine) ? $medicine->name  : $medicine}}">
            <input type="number" id="price{{ $index }}" name="price[]" class="form-control col-4 me-2 price" value="{{is_object($medicine) ?$medicine->price:''}}" > 
            <input type="number"id="quantity{{ $index }}" name="quantity[]" value=""class="form-control col-4 me-2 quantity" placeholder="Medicine quantity"> 
     
            </div>
  </div>
  @endforeach
  <label for="total">Total Price:</label>
        <!-- <output id="total"></output> -->
        <input  name="total" id="total" value="">

    </div>
<button type="submit" id="submit-button" class="btn btn-success align-self-end">Send</button>
</form>
</div>

@endsection
@section('scripts')
<script>
function calculateTotalPrice() {
  const prices = document.getElementsByName('price[]');
  const quantities = document.getElementsByName('quantity[]');
  let total = 0;

  for (let i = 0; i < prices.length; i++) {
    total += prices[i].value * quantities[i].value;
  }

  return total;
}

const prices = document.getElementsByName('price[]');
const quantities = document.getElementsByName('quantity[]');

for (let i = 0; i < prices.length; i++) {
  prices[i].addEventListener('input', updateTotalPrice);
  quantities[i].addEventListener('input', updateTotalPrice);
}

function updateTotalPrice() {
  const total = calculateTotalPrice();
  document.getElementById('total').value = total;
}
document.getElementById('submit-button').addEventListener('submit', updateTotalPrice);
</script>
@endsection