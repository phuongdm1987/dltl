@extends('dltl/layouts/master')

@section('content')
    @include('/dltl/includes/box-silder')

    <div class="">
        <div class="container" id="body-content">
            @include('/dltl/includes/box-tour-featured')
            {{-- main content --}}
            <div class="box-wapper row">
                <div class="col-sm-9" id="main-content">
                    @include('/dltl/includes/home/home-left')
                </div>
                <div class="col-sm-3" id="aside">
                    @include('/dltl/includes/home/home-right')
                </div>
            </div>
            {{--@include('/dltl/includes/box-partner')--}}
        </div>
    </div>
    @include('/dltl/includes/box-customer-review')
@stop