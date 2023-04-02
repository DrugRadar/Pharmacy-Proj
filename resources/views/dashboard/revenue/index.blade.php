@extends('layouts.app')
@section('content')

<h2>Revenue</h2>
<div class="text-center">
</div>
<table class="table mt-4 table-bordered" id="revenue">
    <thead>
        <tr>
            <th scope=" col">Pharmacy Avatar</th>
            <th scope="col">Pharmacy Name</th>
            <th scope="col">Total Orders</th>
            <th scope="col">Total Revenue</th>

        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection
@section('scripts')
<script type="text/javascript">
$(function() {
    $('#revenue').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("revenue.index") }}',
        columns: [{
                data: 'avatar_image_url',
                name: 'avatar_image_url',
                render: function(data, type, full, meta) {
                    if (data) {
                        return '<img src="' + data +
                            '" alt="profile picture" class="profile__picture" style="border-radius:50%;">';
                    } else {
                        return '';
                    }
                }
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'totalOrders',
                name: 'totalOrders',
                render: function(data, type, full, meta) {
                    if (data) {
                        return data;
                    } else {
                        return '';
                    }
                }
            },
            {
                data: 'totalRevenue',
                name: 'totalRevenue',
                render: function(data, type, full, meta) {
                    if (data) {
                        return data;
                    } else {
                        return '';
                    }
                }
            },

        ]
    });
});
</script>
@endsection