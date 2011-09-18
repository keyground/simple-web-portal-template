<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Key Ground Web TV Template</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php 
	require 'libs/functions.php';
	/*
	 * Use with your own api key
	 */
	
	$api_key = 'YOUR_API_KEY';
?>
<div class="header">
	<div class="content">
		<div class="logo">
			Web TV 
		</div>
	</div>
</div>
<div class="content">
	<div class="middle">
		<div class="middle_title">Last Videos</div>
		<? 
			$params = array(
				'all'=> true,	
				'order' => 'upload_time DESC',
			);	
		
			$data=sendRequest($api_key, 'getVideos',$params);
			$videos = $data->videos->video;
		?>
		<?foreach($videos as $video):?>
		
		<?//var_dump($video);?>
		<div class="video_box">
			<div class="thumb"><a href="<?='video.php?vid='.$video->id?>"><img src="<?=$video->thumb_m?>"/></a></div>
			<div class="video-title"><a href='<?='video.php?vid='.$video->id?>'><?=limitStr($video->title, 30)?></a></div>
		</div>
		<?endforeach;?>
	</div>
	<div class="right">
		<div class="right_title">Channels</div>
		<?php
			$data=sendRequest($api_key, 'getChannels');
			$channels=$data->channels->channel;
		?>
		<ul>
			<?foreach($channels as $channel):?>
			<li class="cat-item">
				<a href="<?='video.php?ch='.$channel->id?>"><?=$channel->name?></a>
			</li>
			<?endforeach;?>
		</ul>
	</div>
</div>
<div class="footer">
	Copyright (c) 2011 myWebTV
</div>
</body>
</html>
