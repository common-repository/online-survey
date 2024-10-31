<?php
namespace OnlineSurvey;

final class Admin{
    
    /**
	 * Add hooks when module is loaded.
	 */
	public function __construct() {        
		$this->init();         
	}

   

    private function init(){
		
		add_action( 'init', [$this, 'make_models']);
		add_action( 'init', [$this, 'create_tables']);
        add_action('admin_menu', array($this,'admin_menu') );
        add_filter('rwmb_meta_boxes', array($this,'meta_boxes') );
		add_action('admin_enqueue_scripts', array($this,'admin_enqueue_scripts') );
      
    }

	public function admin_menu() {
		add_menu_page(__('Online Survey', 'online-survey'), __('Online Survey', 'online-survey'), 'manage_options', 'online-survey', 'online_survey_admin_dahboard', 'dashicons-feedback', '58');
			
		add_submenu_page( 'online-survey',	__('Settings', 'online_survey'), __('Settings', 'online-survey'), 'manage_options', 'online-survey-settings', array($this,'settings') );	

		add_submenu_page('online-survey', __('Surveys Reports', 'online-survey'), __('Reports', 'online-survey'), 'manage_options', 'online-survey-reports', array($this,'reports') );		

	}

	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'online-survey-admin', ONLINE_SURVEY_ASSETS . 'css/style.css');				
		
		wp_enqueue_script('online-survey-admin', ONLINE_SURVEY_ASSETS . 'js/js.js', array( 'jquery'));
	}

	public function make_models() {
		global $wpdb;
		CustomTable\Model\Factory::make( 'online-survey', [
			'table'  => $wpdb->prefix. 'online_survey',
			'labels' => [
				'name'          => 'Responses',
				'singular_name' => 'Response',
			],
			'menu_icon' => 'dashicons-money-alt',
			'parent' => 'online-survey'
		] );
	}

	public function create_tables() {
		global $wpdb;
		CustomTable\API::create(
			$wpdb->prefix. 'online_survey',                   // Table name.
			[                                 // Table columns (without ID).
				'survey_id'   => 'BIGINT',
				'fullname'     => 'VARCHAR(100)',				
				'phone'     => 'VARCHAR(100)',
				'position'     => 'VARCHAR(100)',
				'email'      => 'VARCHAR(100)',
				'website'      => 'VARCHAR(100)',
				'message'    => 'longtext',
				'answers'    => 'longtext',
				'status'     => 'VARCHAR(100)',
				'reply' => 'longtext',
				'screenshot' => 'TEXT',
				'created_at' => 'DATETIME',
				'updated_at' => 'timestamp',
			],
			['survey_id', 'status'],               // List of index keys.
			true                               // Must be true for models.
		);
	}

	public function meta_boxes( $meta_boxes ) {
		global $wpdb;
		$meta_boxes[] = [
			'title'        => 'User Details',
			'models'       => ['online-survey'], // Model name
			'storage_type' => 'custom_table',  // Must be 'custom_table'
			'table'        => $wpdb->prefix. 'online_survey',  // Custom table name
			'fields'       => include __DIR__.'/admin/user-info.php',
		];


		$meta_boxes[] = [
			'title'        => 'User responses',
			'models'       => ['online-survey'], // Model name
			'storage_type' => 'custom_table',  // Must be 'custom_table'
			'table'        => $wpdb->prefix. 'online_survey',  // Custom table name
			'fields'       => [
				[
					'id'          => 'survey_id',
					'type'        => 'post',
					'name'        => 'Survey ID',
					'post_type'   => 'survey',
					'field_type'  => 'select',
					'admin_columns' => [
						'title' => 'Survey',
						'sortable' => true,
						'filterable' => true
					]
				],
				[
					'id'       => 'answers',
					'type'              => 'group',
					'clone'             => true,
					'clone_default'     => true,
					'clone_as_multiple' => true,  
					'collapsible'   => false,
					'default_state'   => 'collapsed',
					'group_title'   => '{#}. {question}',      
					'add_button'        => __( 'Add Question', 'online-survey' ),
					'fields'    => [
						[
							'name'     => __( 'Question', 'online-survey' ),
							'id'       => 'question',
							'type'     => 'text',
							'placeholder'     => __( 'Enter Question here', 'online-survey' ),
						],
						[
							'name'     => __( 'Answer', 'online-survey' ),
							'id'       => 'answer',
							'type'     => 'textarea',
							'desc' => __( 'Enter short description for the question.', 'online-survey' ),
						],
					],
				],
			],
		];

		

		return $meta_boxes;
	}

	
	

    

    public function responses(){
		global $wpdb;		
		$table_name = $wpdb->prefix.'online_survey_responses';
		echo '<div class="wrap">';
		if( $_GET['action']== 'delete' ){
			$wpdb->query($wpdb->prepare( "DELETE FROM {$wpdb->prefix}{$table_name}  WHERE ID = %d",	$_GET['link_id'] ));
		}
		$wp_list_table = new List_Table();
		$wp_list_table->prepare_items();
		$wp_list_table->display();
		
		echo '</wrap>';
	}

	public function settings(){
		echo '<div class="wrap">';
	
		echo '</wrap>';
	}

	public function reports(){
		echo '<div class="wrap">';
	
		echo '</wrap>';
	}

	public function dashboard(){
		echo '<div class="wrap">';
	
		echo '</wrap>';
	}

}