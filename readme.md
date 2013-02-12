Sociacount
==========
http://zourbuth.com/archives/788/get-social-bookmark-counts-with-sociacount/

Sociacount is a jQuery plugin + PHP for displaying the total of your social profile subscriber or follower on popular site 
including Facebook, Twitter, Github, Youtube, Dribbble, Forrst and Vimeo.

Fill the Twitter API key
----------
Open "sociacount.php" and fill the your Twitter API key. 
If you don’t have it, your can create a Twitter API key here:
http://goo.gl/kQWyX

$consumer_key        = 'putYourConsumerKeyHere';  
$consumer_secret     = 'putYourConsumerSecretHere';  
$access_token        = 'putYourAccessTokenHere';  
$access_token_secret = 'putYourAccessTokenSecretHere';  


Using script in HTML template
----------
&lt;script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"&gt;&lt;/script&gt;  
&lt;script type="text/javascript" src="jquery.sociacount.js"&gt;&lt;/script&gt;  
&lt;script type="text/javascript"&gt;   
	$(document).ready(function() {  
		$("#social").sociacount({  
			facebook: 'forbes',  
			twitter: 'forbes',  
			youtube: 'forbes',  
			dribbble: 'frogandcode',  
			forrst: 'kyle',  
			github: 'fat',  
			vimeo: 'soxiam',  
			ajaxurl: window.location.pathname+'sociacount.php'  
		});  
	});  
&lt;/script&gt;  
