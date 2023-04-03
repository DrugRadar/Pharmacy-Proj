@extends('layouts.app')
@section('content')
<div>
    <h2 style="margin-top: 5px;">Pharmacies</h2>
    <div class="text-center" style="margin-top: -50px;">
        <a href="{{route('pharmacy.create')}}" class="mt-4 btn btn-success">Create Pharmacy</a>
    </div>
    <table class="table table-dark table-striped mt-4 " style="max-width: 85% !important;" id="pharmacy-table">
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
        <tbody>

        </tbody>
    </table>
    <x-modal role="pharmacy"></x-modal>
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
                        data: 'area_name',
                        name: 'area_name'
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
            window.pharmacyId = $(this).attr('id');
            var id = window.pharmacyId;
            const token = $('meta[name="csrf-token"]').attr('content');
            var deleteUrl = '{{ route("pharmacy.destroy", ":id") }}'.replace(':id', id);
            document.getElementById("form_id").action = deleteUrl;
        });

        $(function() {
            $('#pharmacy-table').on('click', '.deleteBtn', function() {
                var id = window.pharmacyId;
                var deleteUrl = '{{ route("pharmacy.destroy", ":id") }}'.replace(':id', id);
                $.ajax({
                    url: '{{ route("pharmacy.destroy", ":id") }}'.replace(':id', id),
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