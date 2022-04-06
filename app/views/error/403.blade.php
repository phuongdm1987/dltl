<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Error 403 - Forbidden</title>
	<meta name="viewport" content="width=device-width">
	<style type="text/css">
		@import url(https://fonts.googleapis.com/css?family=Droid+Sans);
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
			<h1>Access Forbidden</h1>

			<h2>Server Error: 403 (Forbidden)</h2>

			<hr>

			<h3>What does this mean?</h3>

			<p>
				You don't have the necessary permissions to access to this page.
			</p>

			<p>
				Perhaps you would like to go to our <a href="{{ URL::route('home'); }}">home page</a>?
			</p>
		</div>
	</div>
</body>
</html>
