@extends('dltl/layouts/master')

@section('content')
    <div class="">
        <div class="container" id="body-content">
            {{-- main content --}}
            <div class="box-wapper row">
                <div class="col-sm-9" id="main-content">
                    <div class="box-inside clearfix" id="tour-detail">
                        @include ('frontend/breadcrumbs')
                        <div class="box" id="domestic">
                            <h1 class="title">{{ $post->pos_title }}</h1>
                            <div class="tour-content">
                                <div class="tour-header clearfix">
                                    <div class="img pull-left">
                                        <img src="{{ $post->getPicture('md_') }}" alt="{{ $post->pos_title }}">
                                    </div>
                                    <div class="content pull-left">
                                        {{ $post->pos_teaser }}
                                    </div>
                                </div>

                                <div class="schedule data-content">
                                    <div class="data">{{ $post->pos_content }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3" id="aside">
                    @include('dltl/includes/post/post-right')
                </div>
            </div>
        </div>
    </div>
@stop