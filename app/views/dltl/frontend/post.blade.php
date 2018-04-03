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
                            <h1 class="title">{{ $category->name }}</h1>
                            <div class="tour-content">
                                <div class="data">
                                    @foreach($posts as $post)
                                        <a class="item item-post clearfix" href="{{ $post->getUrl() }}">
                                            <div class="img pull-left">
                                                <img src="{{ $post->getPicture('sm_') }}" alt="{{ $post->pos_title }}" />
                                            </div>
                                            <div class="content pull-left">
                                                <h2 class="header">{{ $post->pos_title }}</h2>
                                                <div>{{ $post->pos_teaser }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                    <div class="paginate">{{ $posts->appends(Input::all())->links() }}</div>
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