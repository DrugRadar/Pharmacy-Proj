@extends('layouts.app')
@section('content')
<div>
    <h1>Pharmacies</h1>
    <div class="text-center">
        <a href="{{route('pharmacy.create')}}" class="mt-4 btn btn-success">Create Pharmacy</a>
    </div>
    <table class="table mt-4 table-bordered" id="pharmacy-table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">National id</th>
                <th scope="col">Area</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            $('#pharmacy-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("pharmacy.index") }}',
                columns: [{
                        data: 'id',
                        name: 'id'
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
                        data: 'area_id',
                        name: 'area_id'
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