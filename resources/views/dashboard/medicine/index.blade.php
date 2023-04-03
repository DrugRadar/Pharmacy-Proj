@extends('layouts.app')
@section('content')
<div>
    <h2 style="margin-top: 5px;">Medicines</h2>
    <div style="margin-top: -50px;" class="text-center">
        <a href="{{route('medicine.create')}}" class="mt-4 btn btn-success">Create Medicine</a>
    </div>
    <table class="table table-dark table-striped mt-4 " style="max-width: 85% !important;" id="medicine-table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <x-modal role="medicine"></x-modal>
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(function() {
    $('#medicine-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("medicine.index") }}',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'price',
                name: 'price'
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

    window.medicineId = $(this).attr('id');
    var id = window.medicineId;
    const token = $('meta[name="csrf-token"]').attr('content');
    var deleteUrl = '{{ route("medicine.destroy", ":id") }}'.replace(':id', id);
    document.getElementById("form_id").action = deleteUrl;
});

$(function() {
    $('#medicine-table').on('click', '.deleteBtn', function() {
        var id = window.medicineId;
        var deleteUrl = '{{ route("medicine.destroy", ":id") }}'.replace(':id', id);
        $.ajax({
            url: '{{ route("medicine.destroy", ":id") }}'.replace(':id', id),
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
