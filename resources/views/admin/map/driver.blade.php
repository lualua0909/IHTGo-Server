@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="bh-sl-container">
                    <div id="page-header">

                    </div>
                    <div id="bh-sl-map-container" class="bh-sl-map-container">
                        <div id="bh-sl-map" class="bh-sl-map"></div>
                        <div class="bh-sl-loc-list">
                            <div class="bh-sl-form-container searchLocation">
                                <form id="bh-sl-user-location" method="post" action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="bh-sl-address" id="bh-sl-address" placeholder="Search for ...">
                                        <span class="input-group-btn">
            <button class="btn btn-default" id="bh-sl-submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
            </span>

                                    </div>
                                </form>
                            </div>
                            <ul class="list"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('publicStore-Locator/dist/assets/css/storelocator.css') }}" />
    <style>
        .searchLocation {
            background-color: #808080;
            padding: 10px;
            left: 0;
            position: relative;
            top: -20px;
            width: 100%;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('publicStore-Locator') }}/dist/assets/js/libs/handlebars.min.js"></script>
    <script src="//maps.google.com/maps/api/js?key=AIzaSyDiNhC5BRZeGaHoPvfAwZVW6G0EGkY-qvI"></script>
    <script src="{{ asset('publicStore-Locator') }}/dist/assets/js/plugins/storeLocator/jquery.storelocator.js"></script>
    <script>
        $(function() {
            $('#bh-sl-map-container').storeLocator({
                'slideMap' : false,
                'defaultLoc': true,
                'defaultLat': '10.955580',
                'defaultLng' : '106.849762',
                'mapSettings' : {
                    zoom : 12,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    disableDoubleClickZoom: false,
                    scrollwheel: true,
                    navigationControl: true,
                    draggable: true
                },
                'dataType' : 'json',
                'dataRaw' : '{!! $result !!}'
            });
        });
    </script>
@endsection

