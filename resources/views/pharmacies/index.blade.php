@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6">
            <h3>Pharmacies Supported in Exchange Program</h3>
        </div>
        <div class="col-md-6 text-end">
           <a href='{{ url("/pharmacies/create") }}' class="btn btn-success">Add New Pharmacy</a>
        </div>
    </div>

    <table id="pharmacy-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Pharmacy Name</th>
                <th>Account No</th>
                <th>Person-In-Charge</th>
                <th>Phone</th>
                <th>Is Activate</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

{{--        @if (count($pharmacies) > 0)--}}
{{--            @foreach ($pharmacies as $pharmacy)--}}
{{--                <tr>--}}
{{--                    <td><a href="{{url("/pharmacies/$pharmacy->id")}}">{{$pharmacy->id}}</a></td>--}}
{{--                    <td>{{ $pharmacy->pharmacy_name }}</td>--}}
{{--                    <td>{{ $pharmacy->pharmacy_account_no }}</td>--}}
{{--                    <td>{{ $pharmacy->pharmacy_pic}}</td>--}}
{{--                    <td><a href="tel:{{$pharmacy->pharmacy_phone}}">{{ $pharmacy->pharmacy_phone}}</a></td>--}}
{{--                    <td class="{{ ($pharmacy->is_active) ? 'text-success' : 'text-danger'}}">{{ ($pharmacy->is_active) ? 'Active' : 'Inactive'}}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--            <!-- Pagination will appear when there's more than 4 items -->--}}
{{--            <div class="d-flex justify-content-center">--}}
{{--                {!! $pharmacies->links() !!}--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <tr>--}}
{{--                <td colspan="5">No records found</td>--}}
{{--            </tr>--}}
{{--        @endif--}}

<script>
    $(document).ready(function () {
        $('#pharmacy-table').DataTable({
            ajax: "{{route('api.pharmacies.index')}}",
            processing: true,
            serverSide: true,
            columns: [
                {
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return '<a href="/pharmacies/' + data + '">' + data + '</a>';
                    }
                },
                {data: 'pharmacy_name'},
                {data: 'pharmacy_account_no'},
                {data: 'pharmacy_pic'},
                {data: 'pharmacy_phone',
                    render: function (data, type, row, meta) {
                        return '<a href="tel:'+data+'">'+data+'</a>';
                    }},
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
