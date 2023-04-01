@extends('layouts.app')
@section('content')
<div>
    <h1>Orders</h1>

    <div class="text-center">
        <a href="{{route('order.create')}}" class="mt-4 btn btn-success">Create Order</a>
    </div>

    <table id="orders-table" class="table table-bordered yajra-datatable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">client_name</th>
            <th scope="col">doctor_name</th>
            <th scope="col">status</th>
            <th scope="col">Delivering Address</th>
            <th scope="col">is_insured</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <x-modal role="doctor"></x-modal>
    </tbody>
</table>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
$(function() {
    $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("order.index") }}',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'client_name',
                name: 'client_name'
            },
            {
                data: 'doctor_name',
                name: 'doctor_name'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'client_address_id',
                name: 'client_address_id'
            },
            {
                data: 'is_insured',
                name: 'is_insured'
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
    // window.doctorId = $(this).attr('id');
    // var id = window.doctorId;
    // const token = $('meta[name="csrf-token"]').attr('content');
    // var deleteUrl = '{{ route("doctor.destroy", ":id") }}'.replace(':id', id);
    // document.getElementById("form_id").action = deleteUrl;
});

$(function() {
    // $('#doctors-table').on('click', '.deleteBtn', function() {
    //     var id = window.doctorId;
    //     var deleteUrl = '{{ route("doctor.destroy", ":id") }}'.replace(':id', id);
    //     $.ajax({
    //         url: '{{ route("doctor.destroy", ":id") }}'.replace(':id', id),
    //         type: 'delete',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(response) {
    //             console.log("delete success");
    //         },
    //         error: function(xhr) {
    //             console.log("err");
    //         }
    //     });
    // });
});
</script>
@endsection