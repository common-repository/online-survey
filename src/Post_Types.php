<?php
namespace OnlineSurvey;

final class Post_Types{
    
    /**
	 * Add hooks when module is loaded.
	 */
	public function __construct() {        
        add_action( 'init', [$this, 'register_post_types']);
	}

   

    public function register_post_types(){       
        
        
        $post_types = [
            'survey' => include __DIR__ ."/post-types/survey.php",
        ];

        foreach ($post_types as $post_type => $args) {
            register_post_type( $post_type, $args );
        }
      
    }

    
}