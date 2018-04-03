<ul class="breadcrumb">
	<li><a href="/" class="link-title">Trang chủ</a></li>
   @if (isset($country))
      <li><a href="{{ $country->getUrl() }}" class="link-title">{{ $country->cou_name }}</a></li>
   @endif
   @if (isset($city))
      <li><a href="{{ $city->getUrl() }}" class="link-title">{{ $city->cit_name }}</a></li>
   @endif
   @if (isset($place))
      <li><a href="{{ $place->getUrl() }}" class="link-title">{{ $place->pla_name }}</a></li>
   @endif
   @if (isset($category))
      <li><a href="{{ $category->getUrlBlog() }}" class="link-title">{{ $category->name }}</a></li>
   @endif
</ul>