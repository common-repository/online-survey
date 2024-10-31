<?php
include __DIR__ .'/shortcode.php';

if(!function_exists('online_survey_setting')):
	/**
	 * 
	 * @param 	string	$setting_id		(required)
	 * @param 	mixed	$default 		NULL
	 * 
	 * @return	mixed	
	*/ 
	function online_survey_setting($setting_id, $default=NULL){
		$output = $default;
		$options = get_option('online_survey');
		if( isset($options[$setting_id]) ){
			$output = $options[$setting_id];
		}
		return $output;
	}
endif;
	
if(!function_exists('online_survey_option')):
	/**
	 * 
	 * @param 	string	$option_id		(required)
	 * @param 	mixed	$default 		NULL
	 * 
	 * @return	mixed	
	*/ 
	function online_survey_option($option_id, $default=NULL){
		$output = $default;
		$options = get_option('online_survey_options');
		if( isset($options[$option_id]) ){
			$output = $options[$option_id];
		}
		return $output;
	}
endif;

if(!function_exists('online_survey_meta')):
	/**
	 * 
	 * @param 	string	$meta_key		(required)
	 * @param 	array	$args 			
	 * @param 	int		$post_id 		
	 * 
	 * @return	mixed	
	*/ 
	function online_survey_meta($key, $args = [], $post_id = null){			
		return rwmb_get_value($key, $args, $post_id);
	}
endif;
	
if(!function_exists('online_survey_formated_content')):
	/**
	 * 
	 * @param 	string		$content		(required)
	 * @param 	string		$before			empty
	 * @param 	string		$after			empty
	 * @param 	boolean		$echo 			true
	 * 
	 * @return	string	
	*/ 
	function online_survey_formated_content( $content, $before = '', $after = '', $echo = true ) {
	
		$content = wp_kses_post($content);
	
		if ( strlen( $content ) == 0 ) {
			return;
		}
	
		$content = $before . $content . $after;
	
		if ( $echo ) {
			echo wp_kses_post($content);
		} else {
			return $content;
		}
	}
endif;
	
if(!function_exists('online_survey_locate_template')):
	/**
	 * Retrieve the name of the highest priority template file that exists.
	 *
	 * Searches in the stylesheet_directory before TEMPLATEPATH and ONLINE_SURVEY_TEMPLATEPATH
	 * so that themes which inherit from a parent theme can just overload one file.
	 *
	 * @param 	string|array 	$template_names Template file(s) to search for, in order.
	 * @param 	array        	$args           Optional. Additional arguments passed to the template.
	 *                                     		Default empty array.
	 * @return 	string The template filename if one is located.
	 */
	function online_survey_locate_template( $template_name, $args = array() ) {
		$located = '';
		$templates_dir = apply_filters( 'online_survey/template_directory', '/online-survey/' );
		
		
		if ( file_exists( get_stylesheet_directory() . $templates_dir . $template_name ) ) {
			$located = get_stylesheet_directory() . $templates_dir . $template_name;
		} elseif ( file_exists( TEMPLATEPATH . $templates_dir . $template_name ) ) {
			$located = TEMPLATEPATH . $templates_dir . $template_name;
		} elseif ( file_exists( ONLINE_SURVEY_TEMPLATEPATH . $template_name ) ) {
			$located = ONLINE_SURVEY_TEMPLATEPATH . $template_name;
		}
	
	
		if ( '' !== $located ) {
			if(!is_array($args)) $args = (array)$args;
			extract($args);
			include( $located );
		}
	}
endif;


if(!function_exists('online_survey_template')):
	/**
	 * Retrieve the name of the highest priority template file that exists.
	 *
	 * Searches in the STYLESHEETPATH before TEMPLATEPATH and ONLINE_SURVEY_TEMPLATEPATH
	 * so that themes which inherit from a parent theme can just overload one file.
	 *
	
	 *
	 * @param 	string|array $template_names 	Template file(s) to search for, in order.
	 * @param 	bool         $load           	If true the template file will be loaded if it is found.
	 * @param 	bool         $require_once   	Whether to require_once or require. Has no effect if `$load` is false.
	 *                                     		Default true.
	 * @param 	array        $args          	Optional. Additional arguments passed to the template.
	 *                                     		Default empty array.
	 * @return 	string 	The template filename if one is located.
	 */
	function online_survey_template( $template_names, $load = false, $require_once = true, $args = array() ) {
		$located = '';
		$templates_dir = apply_filters( 'online_survey/template_directory', '/online-survey/' );
		foreach ( (array) $template_names as $template_name ) {
			if ( ! $template_name ) {
				continue;
			}
			if ( file_exists( get_stylesheet_directory() . $templates_dir . $template_name ) ) {
				$located = get_stylesheet_directory() . $templates_dir . $template_name;
				break;
			} elseif ( file_exists( TEMPLATEPATH . $templates_dir . $template_name ) ) {
				$located = TEMPLATEPATH . $templates_dir . $template_name;
				break;
			} elseif ( file_exists( ONLINE_SURVEY_TEMPLATEPATH . $template_name ) ) {
				$located = ONLINE_SURVEY_TEMPLATEPATH . $template_name;
				break;
			}
		}
	
	
		if ( $load && '' !== $located ) {
			load_template( $located, $require_once, $args );
		}
	
		return $located;
	}
	endif;

function online_survey_basic_field($args){	
	if(in_array($args['id'], ['status', 'created_at'])) return;
	$args = \RWMB_Field::call( 'normalize', $args ); 
	$field_type = $args['type'];
	if(!in_array($field_type, ['radio', 'checkbox', 'number', 'switch', 'textarea', 'datetime', 'select'])){
		$field_type = 'text';
	}

	
	online_survey_locate_template('fields/before.php', $args);
	
	online_survey_locate_template('fields/'.$field_type.'.php', $args);
	online_survey_locate_template('fields/after.php', $args);
}

function online_survey_question_field($args){	
	$args = \RWMB_Field::call( 'normalize', $args ); 
	online_survey_locate_template('fields/before.php', $args);
	echo '<input type="hidden" name="answers['.$args['key'].'][question]" value="'.$args['name'].'"/>';
	$field_type = $args['type'];
	if(!in_array($field_type, ['radio', 'checkbox', 'number', 'switch', 'textarea'])){
		$field_type = 'text';
	}
	online_survey_locate_template('fields/'.$field_type.'.php', $args);
	online_survey_locate_template('fields/after.php', $args);
}


add_action('online_survey_form_after', 'online_survey_form_after');
function online_survey_form_after(){
	?>
	<input type="hidden" name="survey_id" value="<?php echo get_the_ID(); ?>" />	
	<?php
	wp_nonce_field( 'online_survey_form' );
}

