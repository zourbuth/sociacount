<?php
/*
Socialcount 0.0.1

Copyright 2013  zourbuth.com  (email : zourbuth@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
**/

// Fill your Twitter API credential below
// Read how to get your Twitter API http://goo.gl/kQWyX
$consumer_key        = 'putYourConsumerKeyHere';  
$consumer_secret     = 'putYourConsumerSecretHere';  
$access_token        = 'putYourAccessTokenHere';  
$access_token_secret = 'putYourAccessTokenSecretHere';

require( 'library/twitteroauth/twitteroauth.php' );

$data = array();

if ( isset( $_POST['twitter'] ) ) {
	$auth = new TwitterOAuth( $consumer_key, $consumer_secret, $access_token, $access_token_secret );
	$get = $auth->get( 'users/show', array('screen_name' => $_POST['twitter'] ) );
	
	if( ! isset( $get->errors ) )
		echo $get->followers_count;
}

if ( isset( $_POST['facebook'] ) ) {
	$url = 'http://graph.facebook.com/' . $_POST['facebook'];
	$feed = sociacount_curl($url);		

	$json = json_decode($feed);
	if ( FALSE !== $feed )
		echo $json->likes;
}

if ( isset( $_POST['youtube'] ) ) {
	$url = 'http://gdata.youtube.com/feeds/api/users/' . $_POST['youtube'] . '?alt=json';
	$feed = sociacount_curl($url);		
	$json = str_replace('yt$statistics', 'ytstatistics', $feed);
	$json = json_decode($json);

	if ( FALSE !== $feed )
		echo $json->entry->ytstatistics->subscriberCount;
}

if ( isset( $_POST['dribbble'] ) ) {
	$url = 'http://api.dribbble.com/players/' . $_POST['dribbble'];
	$feed = sociacount_curl($url);
	$json = json_decode($feed);
	
	if ( FALSE !== $feed )
		echo $json->followers_count;
}

if ( isset( $_POST['forrst'] ) ) {
	$url = 'http://forrst.com/api/v2/users/info?username=' . $_POST['forrst'];
	$feed = sociacount_curl($url);
	$json = json_decode($feed);
	
	if ( FALSE !== $feed )
		echo $json->resp->followers;
}

if ( isset( $_POST['github'] ) ) {
	$url = 'https://api.github.com/users/' . $_POST['github'];
	$feed = sociacount_curl($url);
	$json = json_decode($feed);
	
	if ( FALSE !== $feed )
		echo $json->followers;
}	

if ( isset( $_POST['vimeo'] ) ) {
	$url = 'http://vimeo.com/api/v2/' . $_POST['vimeo'] . '/info.json';
	$feed = sociacount_curl($url);		
	$json = json_decode($feed);

	if ( FALSE !== $feed )
		echo $json->total_videos_liked; 
}


/*
 * Retrieve data with cURL
 * @since 0.0.1
 */
function sociacount_curl( $url ) {
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 2 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	return curl_exec($ch);
	curl_close($ch);
}

exit();
?>