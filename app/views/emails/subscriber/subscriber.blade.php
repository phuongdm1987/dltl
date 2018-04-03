@extends('emails/layouts/subscriber_layout')

@section('content')
	<tr>
 		<td>
	    	<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#fff" width="620" style="font-size:13px; color:#555; padding:10px 20px 20px 20px;line-height:2em;">
	    	<tr>
             <td style="padding:0px; vertical-align:top; text-align:center;">
                 Danh sách bài viết mới trên <a href="http://fsd14.com?utm_source=email_post_subs&utm_medium=cpc&utm_campaign=email_marketing">Fsd14.com</a>. Cập nhật lúc {{ date('H:i:s') }} ngày {{ date('d') }} tháng {{ date('m') }} năm {{ date('Y') }}
             </td>
         </tr>
			@foreach($posts as $post)
				<tr>
					<td colspan="2">
						<hr style="border:none;border-bottom:1px dashed #e3e3e3;margin:0px;min-height:2px">
					</td>
				</tr>
				<tr>
					<td>
						<p>
							<a href="{{ route('post.detail_new', [$post->id, $post->slug]) }}?utm_source=email_post_subs&utm_medium=cpc&utm_campaign=email_marketing" style="text-decoration:none;font-size:18px;color:#34495e;">{{ $post->title }}</a>
						</p>
						<p style="font-size: 11px;margin: 0px;">
							Đăng lúc {{ date('H:i:s', strtotime($post->created_at)) }} bởi <a href="{{ route('author.home', [$post->username]) }}?utm_source=email_post_subs&utm_medium=cpc&utm_campaign=email_marketing" style="text-decoration:none;">{{ $post->nickname }}</a>
						</p>
						<p>{{ Str::words(strip_tags($post->content), 20) }}</p>
					</td>
				</tr>
			@endforeach
	    	</table>
    	</td>
   </tr>
@stop