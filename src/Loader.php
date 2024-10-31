<?php
namespace OnlineSurvey;

final class Loader{
    
    /**
	 * Add hooks when module is loaded.
	 */
	public function __construct() {        
		$this->init();        
        add_action( 'init', [$this, 'settings_page_load'], 5 );
        add_action( 'admin_init', [$this, 'admin_columns_load'] );
	}

   

    private function init(){
        
        // Fields
        if(!defined('CTRL_LISTINGS_VER')){
            new Fields\Tabs;
            new Fields\Group;
            new Fields\Conditional_Logic;
        }
        

        new Post_Types;
        new Meta_Boxes;
        
        new Admin;
        new Ajax;
        new Templates;
        new Shortcode;
      
    }

    function settings_page_load(){
        if(!defined('CTRL_LISTINGS_VER')){
            new SettingsPage\Loader;        
            new SettingsPage\Customizer\Manager;
        }

        new CustomTable\Loader;
        new CustomTable\Model\Ajax;
    }

    function admin_columns_load() {
		if ( ! defined( 'RWMB_VER' ) ) {
			return;
		}

		$loader = new AdminColumns\Loader;
		$loader->posts();
		$loader->taxonomies();
		$loader->users();
		$loader->models();
	}

    
}