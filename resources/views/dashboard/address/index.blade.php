@extends('layouts.app')
@section('content')
<div>
    <h1>Clients Addresses</h1>
    <div class="text-center">
        <a href="{{route('address.create')}}" class="mt-4 btn btn-success">Create Address</a>
    </div>
    <table class="table table-dark table-striped mt-4 " style="max-width: 85% !important;" id="address-table" style="width:500px !important;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Client ID</th>
                <th scope="col">Area</th>
                <th scope="col">Street</th>
                <th scope="col">Building No.</th>
                <th scope="col">floor No.</th>
                <th scope="col">flat No.</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            <x-modal role="address"></x-modal>
        </tbody>
    </table>
</div>
@endsection
@section('scripts')

<script type="text/javascript">
$(function() {
    $('#address-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("address.index") }}',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'client_id',
                name: 'client_id'
            },
            {
                data: 'area_name',
                name: 'area_name'
            },
            {
                data: 'street_name',
                name: 'street_name'
            },
            {
                data: 'building_number',
                name: 'building_number'
            },
            {
                data: 'floor_number',
                name: 'floor_number'
            },
            {
                data: 'flat_number',
                name: 'flat_number'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
});

$(document).on('click', '.delete', function() {

    window.addressId = $(this).attr('id');
    var id = window.addressId;
    const token = $('meta[name="csrf-token"]').attr('content');
    var deleteUrl = '{{ route("address.destroy", ":id") }}'.replace(':id', id);
    document.getElementById("form_id").action = deleteUrl;
});

$(function() {
    $('#address-table').on('click', '.deleteBtn', function() {
        var id = window.addressId;
        var deleteUrl = '{{ route("address.destroy", ":id") }}'.replace(':id', id);
        $.ajax({
            url: '{{ route("address.destroy", ":id") }}'.replace(':id', id),
            type: 'delete',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log("delete success");
            },
            error: function(xhr) {
                console.log("err");
            }
        });
    });
});
</script>
@endsection
