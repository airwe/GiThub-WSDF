<?php 
/**
 * Adds a frontpage widget for Project Status.
 */
class pjsp_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'pjsp_widget', 
			'Project Status Widget',
			array( 'description' => __( 'Fast overview of a Project Status', 'text_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$projectid = $instance['projectid'];
		$progress = get_post_meta($projectid, 'progress', true);
		if( !$progress )
			$progress = 100;

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		echo __( '<div class="pspin-meter-widget"><span class="pspin-progress-'.$progress.'"></span></div>', 'text_domain' );
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['projectid'] = strip_tags( $new_instance['projectid'] );

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		if ( isset( $instance[ 'projectid' ] ) ) {
			$projectid = $instance[ 'projectid' ];
		}
		else {
			$projectid = 0;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'projectid' ); ?>"><?php _e( 'Project:' ); ?></label>
		<select name="<?php echo $this->get_field_name('projectid'); ?>" id="<?php echo $this->get_field_id('projectid'); ?>" class="widefat" >  
			<?php
			$args = array('post_type' => 'client_projects');
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
				global $post; 
				?>
				<option value="<?php echo $post->ID ?>" <?php if ($post->ID == $instance['projectid']) echo "selected='selected' "; ?> ><?php the_title(); ?></option>
				<?php 
			endwhile;
			?>
		</select>
		</p>
		<?php 
	}

} // class prsp_widget

add_action( 'widgets_init', create_function( '', 'register_widget( "pjsp_widget" );' ) );
?>