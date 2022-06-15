@extends('layouts.main')
@section('custom-head')
    <link rel="stylesheet" href="{{url('/vendor/dynamic-animated-timeline-slider/dist/jquery.roadmap.min.css')}}">
@endsection
@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Waybill - {{$courier_name}}</h1>
    </div>
    <form action="{{url("/waybill")}}" method="POST">
        <input type="hidden" name="courier" value="{{$courier_code}}">
        @csrf
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    <input type="awb" name="awb" class="form-control" id="awb" aria-describedby="awb"
                           placeholder="Enter AWB Number">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your AWB number with anyone
                        else.</small>
                    <input type="hidden" name="courier" value="{{request()->get('courier')}}">
                </div>

            </div>
            <div class="col-md-3 col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div id="my-roadmap"></div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script src="{{url('/vendor/dynamic-animated-timeline-slider/dist/jquery.roadmap.min.js')}}"
            type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var events = [
                {
                    date: 'Q1 - 2018',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q2 - 2018',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q3 - 2018',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q4 - 2018',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q1 - 2019',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q2 - 2019',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q3 - 2019',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small><small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q4 - 2019',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q1 - 2020',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q2 - 2020',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q3 - 2020',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q4 - 2020',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q1 - 2021',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q2 - 2021',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q3 - 2021',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                },
                {
                    date: 'Q4 - 2021',
                    content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
                }
            ];

            $('#my-roadmap').roadmap(events, {
                orientation: 'auto',
                eventsPerSlide: 6,
                slide: 1,
                prevArrow: '<i class="far fa-arrow-alt-circle-left text-gray-300"></i>',
                nextArrow: '<i class="far fa-arrow-alt-circle-right text-gray-300"></i>',
                onBuild: function () {
                    console.log('onBuild event')
                }
            });
        });
    </script>
@endsection
