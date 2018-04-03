@extends('frontend/layouts/default')

@section('content')
	<div id="heading-breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h1 class="heading-title">Trang tĩnh</h1>
				</div>
				<div class="col-md-8">
					<ul class="breadcrumb">
						<li><a href="/" class="link-title">Trang chủ</a></li>
						<li class="color-white">{{ $page->pag_title }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div id="content" class="page-main">
		<div class="container">
			<div class="row">
				<div class="col-sm-9 clearfix">
					<section>
						<div id="text-page">
							<h1>{{ $page->pag_title }}</h1>
							<div class="desc">
								{{ $page->pag_content }}
								<hr/>
								<div class="fb-like" data-href="{{ Request::url() }}" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
							</div>
						</div>
					</section>
				</div>

				<div class="col-sm-3">
					<div class="panel panel-default sidebar-menu">
					   <div class="panel-heading">
					      <h3 class="panel-title"> Bài viết liên quan</h3>
					   </div>
					   <div class="panel-body">
					      <ul class="nav nav-pills nav-stacked">
					         @foreach ($relatedPage as $p)
				               <li class="{{ $p->pag_id == $page->pag_id ? 'active' : '' }}"><a href="{{ $p->getUrl() }}">{{ $p->pag_title }}</a></li>
								@endforeach
					      </ul>
					   </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('scripts')
	<script type="text/javascript">
		// facebook
      (function(d, s, id) {
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
         fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
	</script>
@stop