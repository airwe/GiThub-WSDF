<?php
class Advanced_Twitter_Feed_Integration_Search_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'atfi_search_widget', 
			'Twitter Feed Search',
			array( 'description' => __( 'Search and show latest tweets', 'text_domain' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		
		$twitter = new Creare_Twitter();
		$twitter->screen_name = $instance['username'];
		$twitter->searchterm = $instance['searchterm'];
		$twitter->not = $instance['not'];

		$twitter->consumerkey = get_option('atfi_consumer_key');
		$twitter->consumersecret = get_option('atfi_consumer_secret');
		$twitter->accesstoken = get_option('atfi_access_token');
		$twitter->accesstokensecret = get_option('atfi_access_token_secret');

		$twitter->cachename = "atfi_searchcache";
		$twitter->errorname = "atfi_searcherror";

		if($instance['links'] && $instance['links'] != ""){
			$twitter->tags = true; // show all html tags? FALSE = remove all tags
		}
		if($instance['nofollow'] && $instance['nofollow'] != ""){
			$twitter->nofollow = true; // all links to be no-follow?
		}
		if($instance['newwindow'] && $instance['newwindow'] != ""){
			$twitter->newwindow = true; // all links to open in new window?
		}
		if($instance['showimage'] && $instance['showimage'] != ""){
			$twitter->showimage = true; // all links to open in new window?
		}

		if(!empty($instance['username']) && $instance['username'] != "" && !empty($instance['not']) && $instance['not'] != ""):

		$tweets = $twitter->getSearchTweets();
		
		if($tweets):

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		echo "<ul>";
		foreach($tweets as $tweet){ ?>
		<li>
			<?php echo $tweet['tweet'] ?>
			<p>
				<a class="atfi_link reply" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet['id'] ?>"><span></span> Reply</a>
				<a class="atfi_link retweet" href="https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet['id'] ?>"><span></span> Retweet</a>
				<a class="atfi_link favorite" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet['id'] ?>"><span></span> Favorite</a>
				<span class="atfi_timestamp">
					<a href="https://twitter.com/<?php echo $instance['username'] ?>/statuses/<?php echo $tweet['id'] ?>">
						<?php echo date("g:ia - j M 'y",strtotime($tweet['timestamp'])) ?>
					</a>
					- <?php echo $tweet['time'] ?>
				</span>
			</p>
			
		</li>
		<?php
		}
		echo "</ul>";

?>
<a href="https://twitter.com/<?php echo $instance['username'] ?>" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @<?php echo $instance['username'] ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
<?php

		echo $args['after_widget'];

		endif;

		endif;
	}

 	public function form( $instance ) {

 		if(get_option('atfi_consumer_key') && get_option('atfi_consumer_secret') && get_option('atfi_access_token') && get_option('atfi_access_token_secret')){

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'Our Recent Tweets', 'text_domain' );
		}
		if ( isset( $instance[ 'not' ] ) ) {
			$not = $instance[ 'not' ];
		} else {
			$not = __( '5', 'text_domain' );
		}
		if ( isset( $instance[ 'username' ] ) ) {
			$username = $instance[ 'username' ];
		} else {
			$username = __( '', 'text_domain' );
		}
		if ( isset( $instance[ 'searchterm' ] ) ) {
			$searchterm = $instance[ 'searchterm' ];
		} else {
			$searchterm = __( '', 'text_domain' );
		}
		if ( isset( $instance[ 'links' ] ) && !empty($instance[ 'links' ]) ) {
			$links = true;
		} else {
			$links = false;
		}
		if ( isset( $instance[ 'nofollow' ] ) && !empty($instance[ 'nofollow' ]) ) {
			$nofollow = true;
		} else {
			$nofollow = false;
		}
		if ( isset( $instance[ 'newwindow' ] ) && !empty($instance[ 'newwindow' ]) ) {
			$newwindow = true;
		} else {
			$newwindow = false;
		}
		if ( isset( $instance[ 'showimage' ] ) && !empty($instance[ 'showimage' ]) ) {
			$showimage = true;
		} else {
			$showimage = false;
		}


		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_name( 'username' ); ?>"><?php _e( 'Twitter Username:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" placeholder="e.g. @crearegroup" type="text" value="<?php echo esc_attr( $username ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_name( 'searchterm' ); ?>"><?php _e( 'Your Search Term (e.g. #WordPress)' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'searchterm' ); ?>" name="<?php echo $this->get_field_name( 'searchterm' ); ?>" placeholder="e.g. #wordpress" type="text" value="<?php echo esc_attr( $searchterm ); ?>" />
		</p>
		<p>
		<p><label for="<?php echo $this->get_field_id( 'not' ); ?>">Number of tweets to show:</label>
		<input id="<?php echo $this->get_field_id( 'not' ); ?>" name="<?php echo $this->get_field_name( 'not' ); ?>" type="text" value="<?php echo esc_attr( $not ); ?>" size="3"></p>
		</p>
		<p>
		<input class="checkbox" <?php if($links){ ?>checked="checked"<?php } ?> type="checkbox" id="<?php echo $this->get_field_id( 'links' ); ?>" name="<?php echo $this->get_field_name( 'links' ); ?>">
		<label for="<?php echo $this->get_field_id( 'links' ); ?>">Display links (@ / # / URL)?</label>
		</p>
		<p>
		<input class="checkbox" <?php if($nofollow){ ?>checked="checked"<?php } ?> type="checkbox" id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>">
		<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Use 'nofollow' for links?</label>
		</p>
		<p>
		<input class="checkbox" <?php if($newwindow){ ?>checked="checked"<?php } ?> type="checkbox" id="<?php echo $this->get_field_id( 'newwindow' ); ?>" name="<?php echo $this->get_field_name( 'newwindow' ); ?>">
		<label for="<?php echo $this->get_field_id( 'newwindow' ); ?>">Open links in new window?</label>
		</p>
		<p>
		<input class="checkbox" <?php if($showimage){ ?>checked="checked"<?php } ?> type="checkbox" id="<?php echo $this->get_field_id( 'showimage' ); ?>" name="<?php echo $this->get_field_name( 'showimage' ); ?>">
		<label for="<?php echo $this->get_field_id( 'showimage' ); ?>">Show Avatar?</label>
		</p>
		<?php 

		} else { ?>
		<p>
			Please make sure that you have entered your API details into Settings > Advanced Twitter Feed Integration
		</p>
		<?php }
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['not'] = ( ! empty( $new_instance['not'] ) ) ? strip_tags( $new_instance['not'] ) : '';
		$instance['username'] = ( ! empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
		$username = $instance['username'];
		if(substr($username,0,1) == "@"){
			$instance['username'] = substr($username,1);
		}
		$instance['searchterm'] = ( ! empty( $new_instance['searchterm'] ) ) ? strip_tags( $new_instance['searchterm'] ) : '';
		$instance['links'] = ( ! empty( $new_instance['links'] ) ) ? strip_tags( $new_instance['links'] ) : '';
		$instance['nofollow'] = ( ! empty( $new_instance['nofollow'] ) ) ? strip_tags( $new_instance['nofollow'] ) : '';
		$instance['newwindow'] = ( ! empty( $new_instance['newwindow'] ) ) ? strip_tags( $new_instance['newwindow'] ) : '';
		$instance['showimage'] = ( ! empty( $new_instance['showimage'] ) ) ? strip_tags( $new_instance['showimage'] ) : '';

		return $instance;
	}
}