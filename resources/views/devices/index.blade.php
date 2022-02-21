@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6">
            <h3>Devices Supported in Exchange Program</h3>
        </div>
        <div class="col-md-6 text-end">
           <a href='{{ url("/devices/create") }}' class="btn btn-success">Add New Device</a>
        </div>
    </div>

    <table id="device-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Created At</th>
{{--                <th>Updated At</th>--}}
                <th>Is Activate</th>
            </tr>
        </thead>
        <tbody>

            </tbody>
        </table>

    <script>
        $(document).ready(function () {
            $('#device-table').DataTable({
                ajax: "{{route('api.devices.index')}}",
                processing: true,
                serverSide: true,
                columns: [
                    {
                        data: 'id',
                        render: function (data, type, row, meta) {
                            return '<a href="/devices/' + data + '">' + data + '</a>';
                        }
                    },
                    {data: 'device_brand'},
                    {data: 'device_model'},
                    {data: 'created_at',
                        render: function (data, type, row, meta) {

                            data = data.split('.')[0]
                            data = data.split('T')[0] + " | " + data.split('T')[1]

                            return data;
                        }
                    },
                    {data: 'is_active',
                        render: function (data, type, row, meta) {

                        let color = "text-success";
                        let text = "Active";
                        if(!data){
                            color = "text-danger";
                            text = "Inactive"
                        }
                            return '<span class="'+color+'">'+text+'</span>';
                        }
                    },
                ],

            });
        });
    </script>
@endsection
