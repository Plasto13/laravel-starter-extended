<?php
/**
 * Add Social_Profile_Widget widget.
 */
class Social_Profile_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     *
     **/
    function __construct() {
        parent::__construct(
			'social_profile', // Base ID
			__('Social Profiles', 'themecore'), // Name
			array( 'description' => __( 'Add your socail links to adding this widgets.', 'themecore' ), ) // Args
		);
    }

    /**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title           = apply_filters( 'widget_title', $instance['title'] );
		$facebook_url    = $instance['facebook_url'];
		$twitter_url     = $instance['twitter_url'];
		$google_plus_url = $instance['google_plus_url'];
		$pinterest_url   = $instance['pinterest_url'];
		$instagram_url   = $instance['instagram_url'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>


		<?php if( !empty( $title || $facebook_url || $twitter_url || $google_plus_url || $pinterest_url || $instagram_url ) ): ?>
		<ul class="social_widget">
			<?php if( !empty( $facebook_url ) ): ?>
			<li><a class="facebook" href="<?php echo esc_url( $facebook_url ); ?>"><i class="ti ti-facebook"></i></a></li>
			<?php endif; ?>
			<?php if( !empty( $twitter_url ) ): ?>
			<li><a class="twitter" href="<?php echo esc_url( $twitter_url ); ?>"><i class="ti ti-twitter"></i></a></li>
			<?php endif; ?>
			<?php if( !empty( $google_plus_url ) ): ?>
			<li><a class="google-plus" href="<?php echo esc_url( $google_plus_url ); ?>"><i class="ti ti-google"></i></a></li>
			<?php endif; ?>
			<?php if( !empty( $pinterest_url ) ): ?>
			<li><a class="pinterest" href="<?php echo esc_url( $pinterest_url ); ?>"><i class="ti ti-pinterest"></i></a></li>
			<?php endif; ?>
			<?php if( !empty( $instagram_url ) ): ?>
			<li><a class="instagram" href="<?php echo esc_url( $instagram_url ); ?>"><i class="ti ti-instagram"></i></a></li>
			<?php endif; ?>
		</ul>
		<?php endif; ?>

		<?php
		echo $args['after_widget'];
	}

    /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Follow Us On', 'themecore' );
		}
		
		if ( isset($instance['facebook_url']) ) {
			$facebook_url = $instance['facebook_url'];
		}else{
			$facebook_url = 'facebook.com';
		}

		if ( isset($instance['twitter_url']) ) {
			$twitter_url = $instance['twitter_url'];
		}else{
			$twitter_url = 'twitter.com';
		}

		if ( isset($instance['google_plus_url']) ) {
			$google_plus_url = $instance['google_plus_url'];
		}else{
			$google_plus_url = 'plus.google.com';
		}

		if ( isset($instance['pinterest_url']) ) {
			$pinterest_url = $instance['pinterest_url'];
		}else{
			$pinterest_url = 'pinterest.com';
		}

		if ( isset($instance['instagram_url']) ) {
			$instagram_url = $instance['instagram_url'];
		}else{
			$instagram_url = 'instagram.com';
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','themecore' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			<br>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook_url' ); ?>"><?php _e( 'Facebook Url:','themecore' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" type="text" value="<?php echo esc_attr( $facebook_url ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_url' ); ?>"><?php _e( 'Twitter Url:','themecore' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter_url' ); ?>" name="<?php echo $this->get_field_name( 'twitter_url' ); ?>" type="text" value="<?php echo esc_attr( $twitter_url ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'google_plus_url' ); ?>"><?php _e( 'Google Plus Url:','themecore' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'google_plus_url' ); ?>" name="<?php echo $this->get_field_name( 'google_plus_url' ); ?>" type="text" value="<?php echo esc_attr( $google_plus_url ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest_url' ); ?>"><?php _e( 'Pinterest Url:','themecore' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'pinterest_url' ); ?>" name="<?php echo $this->get_field_name( 'pinterest_url' ); ?>" type="text" value="<?php echo esc_attr( $pinterest_url ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram_url' ); ?>"><?php _e( 'Instagram Url:','themecore' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'instagram_url' ); ?>" name="<?php echo $this->get_field_name( 'instagram_url' ); ?>" type="text" value="<?php echo esc_attr( $instagram_url ); ?>">
		</p>
		<?php 
	}

    /**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                    = array();
		$instance['title']           = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook_url']    = ( ! empty( $new_instance['facebook_url'] ) ) ? strip_tags( $new_instance['facebook_url'] ) : '';
		$instance['twitter_url']     = ( ! empty( $new_instance['twitter_url'] ) ) ? strip_tags( $new_instance['twitter_url'] ) : '';
		$instance['pinterest_url']   = ( ! empty( $new_instance['pinterest_url'] ) ) ? strip_tags( $new_instance['pinterest_url'] ) : '';
		$instance['instagram_url']   = ( ! empty( $new_instance['instagram_url'] ) ) ? strip_tags( $new_instance['instagram_url'] ) : '';
		$instance['google_plus_url'] = ( ! empty( $new_instance['google_plus_url'] ) ) ? strip_tags( $new_instance['google_plus_url'] ) : '';

		return $instance;
	}
}

function themecore_social(){
	register_widget( 'Social_Profile_Widget' );
}
add_action( 'widgets_init', 'themecore_social' );