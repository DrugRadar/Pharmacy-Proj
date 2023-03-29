@extends('layouts.app')
@section('content')
<div>
    <h1>Areas</h1>
    <div class="text-center">
        <a href="{{route('area.create')}}" class="mt-4 btn btn-success">Create Area</a>
    </div>
    <table class="table mt-4 yajra-datatable table-bordered" id="area-table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Area name</th>
                <th scope="col">Area Address</th>
                <th scope="col">Action</th>
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
    $('#area-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("area.index") }}',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'address',
                name: 'address'
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

    window.areaId = $(this).attr('id');
    var id = window.areaId;
    const token = $('meta[name="csrf-token"]').attr('content');
    var deleteUrl = '{{ route("area.destroy", ":id") }}'.replace(':id', id);
    document.getElementById("form_id").action = deleteUrl;
});

$(function() {
    $('#area-table').on('click', '.deleteBtn', function() {
        var id = window.areaId;
        var deleteUrl = '{{ route("area.destroy", ":id") }}'.replace(':id', id);
        $.ajax({
            url: '{{ route("area.destroy", ":id") }}'.replace(':id', id),
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
