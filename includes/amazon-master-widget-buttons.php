<?php
//Hook Widget
add_action( 'widgets_init', 'amazon_master_widget_buttons' );
//Register Widget
function amazon_master_widget_buttons() {
register_widget( 'amazon_master_widget_buttons' );
}

class amazon_master_widget_buttons extends WP_Widget {
	function __construct() {
	$widget_ops = array( 'classname' => 'Amazon Master Button', 'description' => __('Sell even more by linking your wordpress to your Amazon Profile via cool button. ', 'amazon_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'amazon_master_widget_buttons' );
	parent::__construct( 'amazon_master_widget_buttons', __('Amazon Master Button', 'amazon_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Our variables from the widget settings.
		$amazon_title = isset( $instance['amazon_title'] ) ? $instance['amazon_title'] :false;
		$amazon_title_new = isset( $instance['amazon_title_new'] ) ? $instance['amazon_title_new'] :false;
		$amazonspacer ="'";
		$url_loc = plugins_url();
		$show_amazonbutton = isset( $instance['show_amazonbutton'] ) ? $instance['show_amazonbutton'] :false;
		$show_amazonbutton_original = isset( $instance['show_amazonbutton_original'] ) ? $instance['show_amazonbutton_original'] :false;
		$amazonbutton_page = $instance['amazonbutton_page'];
		echo $before_widget;
		
		// Display the widget title
		if ( $amazon_title ){
			if (empty ($amazon_title_new)){
				$amazon_title_new = constant('AMAZON_MASTER_NAME');
				echo $before_title . $amazon_title_new . $after_title;
			}
			else{
				echo $before_title . $amazon_title_new . $after_title;
			}
		}
		else{
		}
	//Display Amazon Profile Button
	if($show_amazonbutton){
		if($show_amazonbutton_original){
			$amazon_button_create = 'techgasp-amazon-button-original';
		}	
		else{
			$amazon_button_create = 'techgasp-amazon-button';
		}
		echo '<a href="'.$amazonbutton_page.'" target="_blank"><img src="'.$url_loc.'/amazon-master/images/'.$amazon_button_create.'.png"></a>';
	}
		else{
	}
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['amazon_title'] = strip_tags( $new_instance['amazon_title'] );
		$instance['amazon_title_new'] = $new_instance['amazon_title_new'];
		$instance['show_amazonbutton'] = $new_instance['show_amazonbutton'];
		$instance['show_amazonbutton_original'] = $new_instance['show_amazonbutton_original'];
		$instance['amazonbutton_page'] = $new_instance['amazonbutton_page'];
		return $instance;
	}
	function form( $instance ) {
	$plugin_master_name = constant('AMAZON_MASTER_NAME');
	//Set up some default widget settings.
	$defaults = array( 'amazon_title_new' => __('Amazon Master', 'amazon_master'), 'amazon_title' => true, 'amazon_title_new' => false, 'show_amazonbutton' => false, 'show_amazonbutton_original' => false, 'amazonbutton_page' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<br>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['amazon_title'], true ); ?> id="<?php echo $this->get_field_id( 'amazon_title' ); ?>" name="<?php echo $this->get_field_name( 'amazon_title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'amazon_title' ); ?>"><b><?php _e('Display Widget Title', 'amazon_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'amazon_title_new' ); ?>"><?php _e('Change Title:', 'amazon_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'amazon_title_new' ); ?>" name="<?php echo $this->get_field_name( 'amazon_title_new' ); ?>" value="<?php echo $instance['amazon_title_new']; ?>" style="width:auto;" />
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_amazonbutton'], true ); ?> id="<?php echo $this->get_field_id( 'show_amazonbutton' ); ?>" name="<?php echo $this->get_field_name( 'show_amazonbutton' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_amazonbutton' ); ?>"><b><?php _e('Display Amazon Profile Button', 'amazon_master'); ?></b></label><br>
	</p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_amazonbutton_original'], true ); ?> id="<?php echo $this->get_field_id( 'show_amazonbutton_original' ); ?>" name="<?php echo $this->get_field_name( 'show_amazonbutton_original' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_amazonbutton_original' ); ?>"><b><?php _e('Activate White Original Button', 'amazon_master'); ?></b></label><br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'amazonbutton_page' ); ?>"><?php _e('insert your Amazon Profile Link:', 'amazon_master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'amazonbutton_page' ); ?>" name="<?php echo $this->get_field_name( 'amazonbutton_page' ); ?>" value="<?php echo $instance['amazonbutton_page']; ?>" style="width:auto;" />
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<b><?php echo $plugin_master_name; ?> Website</b>
	</p>
	<p><a class="button-secondary" href="https://wordpress.techgasp.com/amazon-master/" target="_blank" title="<?php echo $plugin_master_name; ?> Info Page">Info Page</a> <a class="button-secondary" href="https://wordpress.techgasp.com/amazon-master-documentation/" target="_blank" title="<?php echo $plugin_master_name; ?> Documentation">Documentation</a> <a class="button-primary" href="https://wordpress.techgasp.com/amazon-master/" target="_blank" title="Get Add-ons">Get Add-ons</a></p>
	<?php
	}
 }
?>
