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

</script>
@endsection
