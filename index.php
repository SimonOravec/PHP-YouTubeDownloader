<?php
require('./app/autoload.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>YouTube Downloader</title>
	<link rel="stylesheet" href="./assets/universal.min.css">
	<link rel="stylesheet" href="./assets/style.css">
</head>
<body>
<div class="background-gradient1">
<div class="container mg-auto" style="width:35em;padding-top:100px;">
<div class="panel panel-default">
	<div class="panel-heading bg-blue text-white"><b>YouTube Downloader</b></div>
	<div class="panel-body bg-white">
		<noscript><div class="alert alert-red mg-auto width500 text-center">You must enable JavaScript to use this application</div><br></noscript>
		<form class="text-center" role="form" id="form" method="post" enctype="multipart/form-data">
				<input hidden name="upload" value="1">
				<input hidden id="otk" name="otk" value="0">
				<input class="input" style="margin-bottom:10px;width:75%;text-align:center;" type="text" name="yt_uri" id="yt_uri" placeholder="https://www.youtube.com/watch?v=dQw4w9WgXcQ" required disabled><br>
				<button type="button" id="btn_download" class="btn btn-blue mg-auto" disabled>Download MP3</button>
			<small class="display-block" style="margin-top:5px;">*Maximum video length is 30 minutes</small>
		</form>
	</div>
</div>
<?php if ($cfg['ENABLE-RECAPTCHA'] == true) { ?><div class="g-recaptcha" data-sitekey="<?= $cfg['RECAPTCHA-SITEKEY']; ?>" data-callback="downloadSubmit" data-size="invisible"></div><?php echo PHP_EOL; } ?>
</div>
</div>
<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./assets/jquery.form.min.js"></script>
<script src="./assets/ytdl.js"></script>

<?php if ($cfg['ENABLE-RECAPTCHA'] == true) { ?><script src="https://www.google.com/recaptcha/api.js" async defer></script><?php echo PHP_EOL; } ?>
</body>
</html>
