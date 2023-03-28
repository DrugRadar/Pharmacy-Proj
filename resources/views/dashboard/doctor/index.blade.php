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

    </tbody>
</table>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Delete Pharmacist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-title">Are you sure you want to Delete this record?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">CANCEL</button>
                <form method="POST" action="">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger m-0">DELETE</button>
                </form>
            </div>
        </div>
    </div>
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
</script>
@endsection