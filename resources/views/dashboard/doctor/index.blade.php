@extends('layouts.app')
@section('content')
<h1>Doctors</h1>
<div class="text-center">
    <a href="{{route('doctor.create')}}" class="mt-4 btn btn-success">Create Doctor</a>
</div>
<table id="doctors-table" class="table table-bordered yajra-datatable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Doctor name</th>
            <th scope="col">Email</th>
            <th scope="col">National id</th>
            <th scope="col">Actions</th>

        </tr>
    </thead>
    <tbody>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Delete</h5>
                        <button type=" button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="modal-title">Are you sure you want to Delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">CANCEL</button>

                        <form method="POST" id="form_id">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="deleteBtn btn btn-danger m-0">DELETE</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </tbody>
</table>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
$(function() {
    $('#doctors-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("doctor.index") }}',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'national_id',
                name: 'national_id'
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

    window.doctorId = $(this).attr('id');
    var id = window.doctorId;
    const token = $('meta[name="csrf-token"]').attr('content');
    var deleteUrl = '{{ route("doctor.destroy", ":id") }}'.replace(':id', id);
    document.getElementById("form_id").action = deleteUrl;
});

$(function() {
    $('#doctors-table').on('click', '.deleteBtn', function() {
        var id = window.doctorId;
        var deleteUrl = '{{ route("doctor.destroy", ":id") }}'.replace(':id', id);
        $.ajax({
            url: '{{ route("doctor.destroy", ":id") }}'.replace(':id', id),
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