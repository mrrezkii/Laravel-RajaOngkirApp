@extends('layouts.main')
@section('custom-head')
    <link rel="stylesheet" href="{{url('/vendor/dynamic-animated-timeline-slider/dist/jquery.roadmap.min.css')}}">
@endsection
@section('container')
    @if(session()->has('invalid'))
        <div class="position-fixed" style="right: 10px;bottom: 50px">
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                <div class="toast-header d-flex justify-content-between">
                    <img src="https://rajaongkir.com/assets/img/favicon/favicon.ico" class="rounded mr-2 img-fluid"
                         alt="..." width="20px">
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    {{ session('invalid') }}
                </div>
            </div>
        </div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Waybill - {{$courier_name}}</h1>
    </div>
    <form action="{{url("/waybill")}}" method="POST">
        <input type="hidden" name="courier" value="{{$courier_code}}">
        @csrf
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="form-group">
                    @if(session()->has('data'))
                        <input type="awb" name="awb" class="form-control" id="awb" aria-describedby="awb"
                               placeholder="Enter AWB Number" required autocomplete="off"
                               value="{{ session()->get('data')['rajaongkir']['query']['waybill'] }}">
                    @else
                        <input type="awb" name="awb" class="form-control" id="awb" aria-describedby="awb"
                               placeholder="Enter AWB Number" required autocomplete="off">
                    @endif
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
    @if(session()->has('data'))
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#detailModel">
                    Show Details
                </button>
            </div>
            <div class="col-12">
                <div id="my-roadmap"></div>
            </div>
        </div>
        <div class="modal fade" id="detailModel" tabindex="-1" role="dialog" aria-labelledby="detailLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-gray-800"
                            id="exampleModalLabel">{{ session()->get('data')['rajaongkir']['result']['summary']['courier_name'].' - '.session()->get('data')['rajaongkir']['result']['summary']['waybill_number']  }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-gray-900">Delivered
                                    = {{ session()->get('data')['rajaongkir']['result']['delivered'] == true ? 'Yes' : 'No' }}</h6>
                            </div>
                            <div class="col-12">
                                <div id="details">
                                    <h6 class="text-gray-900">Details</h6>
                                    <div class="ml-2">
                                        <table>
                                            <tr>
                                                <td class="text-gray-800">Waybill date</td>
                                                <td class="text-gray-800"> :</td>
                                                <td class="text-gray-800">{{ session()->get('data')['rajaongkir']['result']['summary']['waybill_date'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Waybill time</td>
                                                <td class="text-gray-800"> :</td>
                                                <td class="text-gray-800">{{ session()->get('data')['rajaongkir']['result']['details']['waybill_time'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Weight</td>
                                                <td class="text-gray-800"> :</td>
                                                <td class="text-gray-800">{{ session()->get('data')['rajaongkir']['result']['details']['weight'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Courier name</td>
                                                <td class="text-gray-800"> :</td>
                                                <td class="text-gray-800">{{ session()->get('data')['rajaongkir']['result']['summary']['courier_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Service</td>
                                                <td class="text-gray-800"> :</td>
                                                <td class="text-gray-800">{{ session()->get('data')['rajaongkir']['result']['summary']['service_code'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Shipper name</td>
                                                <td class="text-gray-800"> :</td>
                                                <td class="text-gray-800">{{ session()->get('data')['rajaongkir']['result']['summary']['shipper_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Receiver name</td>
                                                <td class="text-gray-800"> :</td>
                                                <td class="text-gray-800">{{ session()->get('data')['rajaongkir']['result']['summary']['receiver_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Origin</td>
                                                <td class="text-gray-800"> :</td>
                                                <td class="text-gray-800">{{ session()->get('data')['rajaongkir']['result']['summary']['origin'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Destination</td>
                                                <td class="text-gray-800"> :</td>
                                                <td class="text-gray-800">{{ session()->get('data')['rajaongkir']['result']['summary']['destination'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Status</td>
                                                <td class="text-gray-800"> :</td>
                                                <td class="text-gray-800">{{ session()->get('data')['rajaongkir']['result']['summary']['status'] }}</td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('custom-script')
    <script src="{{url('/vendor/dynamic-animated-timeline-slider/dist/jquery.roadmap.min.js')}}"
            type="text/javascript"></script>
    @if(session()->has('data'))
        <script type="text/javascript">
            $(document).ready(function () {
                const data = @json(session()->get('data'));
                const manifest = data['rajaongkir']['result']['manifest']
                const events = [];
                for (let i = 0; i < manifest.length; i++) {
                    events.push({
                        date: `${manifest[i]['manifest_date']} - ${manifest[i]['manifest_time']}`,
                        content: `${manifest[i]['manifest_code']} - ${manifest[i]['manifest_description']}`,
                    })
                }
                const eventsReversed = events.reverse();

                $('#my-roadmap').roadmap(eventsReversed, {
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
    @endif
    <script>
        $('.toast').toast('show');
    </script>
@endsection
