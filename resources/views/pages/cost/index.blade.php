@extends('layouts.main')
@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cost</h1>
    </div>
    <form action="{{url('/cost')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="origin" class="text-dark">Origin</label>
                <input type="origin" name="origin" class="form-control" id="origin" aria-describedby="origin"
                       placeholder="City">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="destination" class="text-dark">Destination</label>
                <input type="destination" name="destination" class="form-control" id="origin"
                       aria-describedby="destination" placeholder="City">
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
            <h4 class="text-gray-800 text-center mt-2">Result</h4>
        </div>
    </div>
@endsection
