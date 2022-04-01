<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Error 404 - Not Found</title>
	<meta name="viewport" content="width=device-width">
	<style type="text/css">
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans);
		hr { display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; }
		body
		{
			font-family:'Droid Sans', sans-serif;
			font-size:10pt;
			color:#555;
			line-height: 25px;
		}

		.wrapper
		{
			width:760px;
			margin:0 auto 5em auto;
		}

		.main
		{
			overflow:hidden;
		}

		.error-spacer
		{
			height:4em;
		}

		a, a:visited
		{
			color:#2972A3;
		}

		a:hover
		{
			color:#72ADD4;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="error-spacer"></div>
		<div role="main" class="main">
			<?php $messages = array('We need a map.', 'I think we\'re lost.', 'We took a wrong turn.'); ?>

			<h1>404 - page not defined.</h1>

			<h2>Điều này có nghĩa là</h2>
			<hr>
			<p>
				Chúng tôi không tìm thấy trang bạn yêu cầu. Chúng tôi rất tiếc về điều này. Nếu đây là lỗi của chúng tôi, chúng tôi sẽ nỗ lực đưa trang này online trở lại ngay khi có thể.
			</p>

			<p>
				Có lẽ bạn sẽ muốn quay trở về <a href="/">trang chủ</a>?
			</p>
		</div>
	</div>
</body>
</html>
