<?php
namespace OnlineSurvey;

final class Ajax{
    
    /**
	 * Add hooks when module is loaded.
	 */
	public function __construct() {        
		$this->init();
	}

   

    private function init(){
        
        add_action('wp_ajax_online_survey_form_submit', [$this, 'online_survey_form_submit']);
        add_action('wp_ajax_nopriv_online_survey_form_submit', [$this, 'online_survey_form_submit']);
      
    }

    
    public function online_survey_form_submit(){
        check_ajax_referer( 'submit-online-survey-form' );
        global $wpdb;
        $result = array();	
        
        parse_str($_POST['form_data'], $form_data);
        
        $msg = '';	
        
        $msg .= "<table cellpadding='5' border='1'><tr><th>Questions</th><th>Answer</th></tr>";
        foreach( $form_data['answers'] as $data ){
            $msg .= "<tr><td>{$data['question']}</td><td>{$data['answer']}</td></tr>";
        }
        $msg .= "</table><br />\n";
        
        $defaults = [
            'fullname' => '',
            'email' => '',
            'phone' => '',
            'website' => '',
            'position' => '',
            'status' => 'pending',
            'survey_id' => '',
            'answers' => [],
            'message' => $msg,
            'created_at' => date('Y-m-d H:i'),
        ];
        
        $table_name = $wpdb->prefix.'online_survey';
        $table_data = shortcode_atts($defaults, $form_data); 
        
        //$to = 	$form_data['email'];
        $to = 	get_option('admin_email');
        $subject = "Online Survey";
        $body = "===========================================================<br />";
        $body .= !empty($table_data['fullname'])? "<strong>Name:</strong> {$table_data['fullname']}\n" : '';
        $body .= !empty($table_data['position'])? "<strong>Position:</strong> {$table_data['position']}\n" : '';
        $body .= !empty($table_data['email'])? "<strong>Email:</strong> {$table_data['email']}\n" : '';
        $body .= !empty($table_data['website'])? "<strong>Website:</strong> {$table_data['website']}\n" : '';	
        $body .= "===================Survey==================================\n";
        $body .= "{$msg}\n";
        $body .= "===========================================================<br />";
        
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.$table_data['fullname'].' <'.$table_data['email'].'>' . "\r\n";
        
        

        CustomTable\API::add( null, $table_name, $table_data );
       
        if(isset($wpdb->insert_id)){
                    
            if(wp_mail( $to, $subject, $body, $headers )){
                $result = array('id' => 1, 'msg' => 'Thank You. Message is sent successfully.' );
            } else{
                $result = array('id' => 1, 'msg' => 'Thank You. Data inserted but Message Sending Failed.' );
            }
                
        }else{
            $result = array('id' => 0, 'msg' => 'Data inserting error??' );	
        }
            
        
        echo json_encode($result);
        exit;	
    }
    
    
    function online_survey_admin_dahboard(){
        ?>
        <div class="wrap online-survey-reports">
            <h2>Survey Reports</h2>
        </div>
        <?php
        
    }

    
}