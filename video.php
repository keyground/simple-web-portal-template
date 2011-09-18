<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Key Ground Web TV Template</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php 
	/*
	 * Use with your own api key
	 */
	$api_key = 'YOUR_API_KEY';
	
	if($_GET['ch']!=''){
			$params = array(
				'channelId' => $_GET['ch'],
				'order' => 'upload_time DESC',
			);
		$data=sendRequest($api_key, 'getVideos',$params);
		$videos=$data->videos->video;
		
		$params = array('videoId' => $videos[0]->id);
		$data=sendRequest($api_key, 'getVideoDetails',$params);
		$video=$data->video;
		
	
	} else if($_GET['vid']!='') {
		$params = array('videoId' => $_GET['vid']);
		$data=sendRequest($api_key, 'getVideoDetails',$params);
		$video=$data->video;

		$params = array(
				'channelId' => $video->channelId,
				'all'=> true,	
				'order' => 'upload_time DESC',
		);
		$data=sendRequest($api_key, 'getVideos',$params);
		$videos=$data->videos->video;
	}	
?>
<?//var_dump($videos)?>
<?//var_dump($video)?>
<div class="header">
	<div class="content">
		<div class="logo">
			Web TV 
		</div>
	</div>
</div>
<div class="content">
	<div class="middle">
		<div class="middle_title"><?=$video->title?></div>
		<div class="player">
			<?=$video->embed_code;?>
		</div>
		
		<div class="comment">
			<div class="comment_label">Name</div>
			<div class="comment_input"><input  type="text" name="comment_name" /></div>
			<div class="comment_label">E-Mail</div>
			<div class="comment_input"><input type="text" name="comment_email" /></div>
			<div class="comment_msg"><textarea name="comment_msg" ></textarea></div>
			<div class="comment_submit"><input type="button" name="submit" value="Send"/></div>
		</div>	
		
		<?foreach($videos as $video):?>
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
