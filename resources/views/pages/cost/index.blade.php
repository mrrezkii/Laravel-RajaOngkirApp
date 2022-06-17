@extends('layouts.main')
@section('custom-head')
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
@endsection
@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cost</h1>
    </div>
    <form action="{{url('/cost')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <label for="origin" class="text-dark">Origin</label>
                <select name="origin" class="selectpicker" data-live-search="true" data-style="btn btn-outline-info"
                        data-width="100%" title="Choose one of the following..." data-size="5" required>
                    @foreach($cities as $city)
                        <option data-tokens="{{$city->postal_code ?? ''}}"
                                value="{{$city->city_id ?? ''}}">{{$city->type ?? ''}} {{$city->city_name ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <label for="destination" class="text-dark">Destination</label>
                <select name="destination" class="selectpicker" data-live-search="true"
                        data-style="btn btn-outline-info" data-width="100%" title="Choose one of the following..."
                        data-size="5" required>
                    @foreach($cities as $city)
                        <option data-tokens="{{$city->postal_code ?? ''}}"
                                value="{{$city->city_id ?? ''}}">{{$city->type ?? ''}} {{$city->city_name ?? ''}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 col-sm-12">
                <button type="submit" class="btn btn-primary" style="margin-top: 31px;">Submit</button>
            </div>
        </div>
    </form>
    <div class="row mt-5">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-gray-800 text-center mt-2">Top 3 by Cheapest Price</h4>
            <table class="table table-hover text-gray-700 mt-3 mr-2">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Courier</th>
                    <th scope="col">Service</th>
                    <th scope="col">Price</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>The Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-gray-800 text-center mt-2">Top 3 by Fastest</h4>
            <table class="table table-hover text-gray-700 mt-2">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Courier</th>
                    <th scope="col">Service</th>
                    <th scope="col">Day</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>The Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <h4 class="text-gray-800 text-center mt-2">Results</h4>
        </div>
        <div class="col-12">
            <table id="resultTable" class="table table-stripped text-grey">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Courier</th>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Est Day</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('custom-script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
    {{--    <script>--}}
    {{--        $('#resultTable').DataTable({--}}
    {{--            processing: true,--}}
    {{--            serverSide: true,--}}
    {{--            "scrollX": true,--}}
    {{--            ajax: '{{ route('cost.data.results') }}',--}}
    {{--            columns: [--}}
    {{--                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},--}}
    {{--                {data: 'courier', name: 'courier'},--}}
    {{--                {data: 'service', name: 'service'},--}}
    {{--                {data: 'price', name: 'price'},--}}
    {{--                {data: 'est_day', name: 'est_day'},--}}
    {{--            ]--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection
