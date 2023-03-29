@extends('layouts.app')
@section('content')
<div>
    <h1>Clients Addresses</h1>
    <div class="text-center">
        <a href="{{route('address.create')}}" class="mt-4 btn btn-success">Create Address</a>
    </div>
    <table class="table mt-4 yajra-datatable table-bordered" id="address-table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Area ID</th>
                <th scope="col">Street name</th>
                <th scope="col">Building number</th>
                <th scope="col">floor_number</th>
                <th scope="col">flat_number</th>
                <th scope="col">is_main</th>
                <th scope="col">Client ID</th>
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
                data: 'name',
                name: 'area_id'
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
                data: 'is_main',
                name: 'is_main'
            },
            {
                data: 'client_id',
                name: 'client_id'
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
