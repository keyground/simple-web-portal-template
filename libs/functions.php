<?php
function sendRequest($api_key,$cmd,$params = null)
{
			
	$api_url = 'http://api.keyground.net/0.3.2/api.php';	
	
		$post_data = array (
			'api_key'	=> $api_key,
			'cmd'		=> $cmd
		);
		
		if(is_array($params)){
			$post_data=array_merge($post_data, $params);
		}
		
		//var_dump($post_data);
		
		$ch = @curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$response       = curl_exec($ch);	
		$errno          = curl_errno($ch);
		$error          = curl_error($ch);
		
		if($error!=''){
			return $error;
		} else {
			//echo $response;	
			return xmlToObject($response);	
		}	
	}
	
function xmlToObject($xml){
	$obj=simplexml_load_string($xml,'SimpleXMLElement', LIBXML_NOCDATA);
	return $obj;
}

function limitStr($str,$lmt)
{
	if(strlen($str)>$lmt){
		$str=substr($str, 0,$lmt);
		return $str.="...";
	} else 
		return $str;
}
?>