@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6">
            <h3>Patients List</h3>
        </div>
    </div>

    <table id="patient-table" class="table table-striped" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Email</th>
            <th>Postcode</th>
            <th>Phone</th>
            <th>Diabetes Type</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <script>
        $(document).ready(function () {
            $('#patient-table').DataTable({
                ajax: "{{route('api.patients.index')}}",
                processing: true,
                serverSide: true,
                columns: [
                    {
                        data: 'id',
                        render: function (data, type, row, meta) {
                            return '<a href="/patients/' + data + '">' + data + '</a>';
                        }
                    },
                    {data: 'patient_name'},
                    {data: 'patient_dob'},
                    {
                        data: 'patient_email',
                        render: function (data, type, row, meta) {
                            return '<a href="mailto:' + data + '">' + data + '</a>';
                        }
                    },
                    {data: 'patient_postcode'},
                    {
                        data: 'patient_phone',
                        render: function (data, type, row, meta) {
                            return '<a href="tel:' + data + '">' + data + '</a>';
                        }
                    },
                    {data: 'patient_diabetes_type'},
                    {data: 'created_at',
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
