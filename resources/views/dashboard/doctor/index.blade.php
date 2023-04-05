@extends('layouts.app')
@section('content')

{{Auth::user()->hasrole('pharmacy')}}
<h2 style="margin-top: 5px;">Doctors</h2>
<div style="margin-top: -50px;" class="text-center">
    <a href="{{route('doctor.create')}}" class="mt-4 btn btn-success">Create Doctor</a>
</div>
<table class="table table-dark table-striped mt-4 " style="max-width: 85% !important;" id="doctors-table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">National id</th>
            <th scope="col">Created at</th>
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
    $('#doctors-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("doctor.index") }}',
        columns: [
            {
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
                data: 'created_at',
                name: 'created_at'
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