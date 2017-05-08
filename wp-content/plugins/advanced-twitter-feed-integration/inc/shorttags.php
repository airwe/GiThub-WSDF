<?php
function get_tweet_timeline_func( $atts ) {
	extract( shortcode_atts( array(
		'username' => 'crearegroup',
		'number' => '1',
		'showlinks' => false,
		'newwindow' => false,
		'nofollow' => false,
		'avatar' => false
	), $atts ) );

	//return "showlinks = {$showlinks}";


	$twitter = new Creare_Twitter();
	$twitter->screen_name = $username;
	$twitter->not = $number;

	$twitter->consumerkey = get_option('atfi_consumer_key');
	$twitter->consumersecret = get_option('atfi_consumer_secret');
	$twitter->accesstoken = get_option('atfi_access_token');
	$twitter->accesstokensecret = get_option('atfi_access_token_secret');

	if($showlinks=="true" && $showlinks != ""){
		$twitter->tags = true; // show all html tags? FALSE = remove all tags
	}
	if($nofollow=="true" && $nofollow != ""){
		$twitter->nofollow = true; // all links to be no-follow?
	}
	if($newwindow=="true" && $newwindow != ""){
		$twitter->newwindow = true; // all links to open in new window?
	}
	if($avatar=="true" && $avatar != ""){
		$twitter->showimage = true; // all links to open in new window?
	}


	$tweets = $twitter->getLatestTweets();

	$html = '<ul class="afti-short-timeline">';
	foreach($tweets as $tweet){ 
	$html .= '
	<li>
		'.$tweet['tweet'].' - '.$tweet['time'].'
		<p>
			<a class="atfi_link reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id'].'"><span></span> Reply</a>
			<a class="atfi_link retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id'].'"><span></span> Retweet</a>
			<a class="atfi_link favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id'].'"><span></span> Favorite</a>
			<span class="atfi_timestamp">
				<a href="https://twitter.com/'.$instance['username'].'/statuses/'.$tweet['id'].'">
					'.date("g:ia - j M 'y",strtotime($tweet['timestamp'])).'
				</a>
				- '.$tweet['time'].'
			</span>
		</p>
	</li>';
	
	}
	$html .= "</ul>";

	return $html;

}
add_shortcode( 'get_tweet_timeline', 'get_tweet_timeline_func' );


function get_tweet_search_func( $atts ) {
	extract( shortcode_atts( array(
		'searchterm' => 'crearegroup',
		'number' => '1',
		'showlinks' => false,
		'newwindow' => false,
		'nofollow' => false,
		'avatar' => false
	), $atts ) );

	//return "showlinks = {$showlinks}";


	$twitter = new Creare_Twitter();
	$twitter->searchterm = $searchterm;
	$twitter->not = $number;

	$twitter->consumerkey = get_option('atfi_consumer_key');
	$twitter->consumersecret = get_option('atfi_consumer_secret');
	$twitter->accesstoken = get_option('atfi_access_token');
	$twitter->accesstokensecret = get_option('atfi_access_token_secret');

	$twitter->cachefile = WP_RECENT_TWEETS_DIR."inc/twitter.txt";
	$twitter->errorlog = WP_RECENT_TWEETS_DIR."inc/errors.txt";

	if($showlinks=="true" && $showlinks != ""){
		$twitter->tags = true; // show all html tags? FALSE = remove all tags
	}
	if($nofollow=="true" && $nofollow != ""){
		$twitter->nofollow = true; // all links to be no-follow?
	}
	if($newwindow=="true" && $newwindow != ""){
		$twitter->newwindow = true; // all links to open in new window?
	}
	if($avatar=="true" && $avatar != ""){
		$twitter->showimage = true; // all links to open in new window?
	}

	$tweets = $twitter->getSearchTweets();

	$html = '<ul class="afti-short-search">';
	foreach($tweets as $tweet){ 
	$html .= '
	<li>
		'.$tweet['tweet'].' - '.$tweet['time'].'
		<p>
			<a href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id'].'"><img src="https://si0.twimg.com/images/dev/cms/intents/icons/reply.png" alt="Reply" /> Reply</a>
			<a href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id'].'"><img src="https://si0.twimg.com/images/dev/cms/intents/icons/retweet.png" alt="Reply" /> Retweet</a>
			<a href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id'].'"><img src="https://si0.twimg.com/images/dev/cms/intents/icons/favorite.png" alt="Reply" /> Favorite</a>
			<span style="display:block; font-size: 10px;"><a href="https://twitter.com/'.$tweet['search_user'].'/statuses/'.$tweet['id'].'">'.date("g:ia - j M 'y",strtotime($tweet['timestamp'])).'</a></span>
		</p>
	</li>';
	
	}
	$html .= "</ul>";

	return $html;

}
add_shortcode( 'get_tweet_search', 'get_tweet_search_func' );

