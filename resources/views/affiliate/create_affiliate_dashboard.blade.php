<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		body {
		    margin: 0px;
		}
		.fullW {
	    width: 100%;
	    text-align: center;
	    margin-top: 220px;
		}
		.textW {
		    font-size: 60px;
		    line-height: 2px;
		}
		.backgrnd{
			background: url({{URL('resources/assets/loader/success.gif')}});
		}
	</style>
</head>
<body id="body">

	<div class="fullW" id="fullW">
		<div class="fullW2">

			<div class="gifW" id="gif1">
				<img src="{{asset('resources/assets/loader/setting.gif')}}" class="gifimg">
			</div>

			<div class="gifW" id="gif2" style="display:none;">
				<img src="{{asset('resources/assets/loader/success.gif')}}" class="gifimg gifimg_suc">
			</div>

			<div class="textW">

				<div id="text1" class="texti">
					<p class="texti_p">Please wait...</p>
					<p class="texti_p">
						Creating your Affiliate Dashboard
					</p>
				</div>

				<div id="text2" class="texti" style="display: none;">
					<p class="texti_p">Hold On...</p>
				</div>


				<div id="text3" class="texti" style="display: none;">
					<p class="texti_p">Almost There...</p>
				</div>


			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
	  $("#text1").show().delay(4500).fadeOut();

	  $("#text2").delay(5000).fadeIn();
	  $("#text2").delay(2000).fadeOut();

	  // 7 second
	  $("#text3").delay(8000).fadeIn();
	  $("#text3").delay(2000).fadeOut();

	  // 10 Second
	  $("#gif1").show().delay(10000).fadeOut();
	});

	setTimeout('Redirect()', 10000);
	function Redirect() 
	{  
	    window.location="{{URL('affiliate-dashboard')}}"; 
	} 
	</script>
</body>
</html>