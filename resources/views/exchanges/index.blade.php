@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6">
            <h3>Control Exchange Program List</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href='{{ url("/exchanges/create") }}' class="btn btn-success">Add Exchange Program Record</a>
        </div>
    </div>

    <table id="exchange-table" class="table table-striped" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Patient Name</th>
            <th>Others Brand</th>
            <th>Others Model</th>
            <th>Others Serial Number</th>
            <th>Ours Model</th>
            <th>Ours Serial Number</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <script>

        $(document).ready(function () {
            $('#exchange-table').DataTable({
                ajax: "{{route('api.exchanges.index')}}",
                processing: true,
                serverSide: true,
                columns: [
                    {
                        data: 'id',
                        render: function (data, type, row, meta) {
                            return '<a href="/exchanges/' + data + '">' + data + '</a>';
                        }
                    },
                    {data: 'patient.patient_name'},
                    {data: 'other_device.device_brand'},
                    {data: 'other_device_serial_no'},
                    {data: 'other_device.device_model'},
                    {data: 'our_device.device_model'},
                    {data: 'our_device_serial_no'},
                    {
                        data: 'created_at',
                        render: function (data, type, row, meta) {

                            data = data.split('.')[0]
                            data = data.split('T')[0] + " | " + data.split('T')[1]

                            return data;
                        }
                    },
                    {
                        data: 'updated_at',
                        render: function (data, type, row, meta) {

                            data = data.split('.')[0]
                            data = data.split('T')[0] + " | " + data.split('T')[1]

                            return data;
                        }
                    },
                ],
            });
        });
    </script>

@endsection
