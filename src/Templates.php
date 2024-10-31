<?php

namespace OnlineSurvey;

final class Templates
{

    /**
     * Add hooks when module is loaded.
     */
    public function __construct()
    {
        add_action('init', [$this, 'template_assets']);
        add_action('online_survey_form', [$this, 'online_survey_form']);        
        add_filter( 'the_content', [$this, 'the_content'] );
        add_filter('single_template', [$this, 'single_template']);
    }

    public function template_assets(){
        wp_register_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css', [], '5.3.0');
        wp_register_style( 'online-survey', ONLINE_SURVEY_ASSETS . 'templates/css/style.css', ['bootstrap'], ONLINE_SURVEY_VER);
		wp_register_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js', array( 'jquery'), '5.3.0' );
		wp_register_script('online-survey', ONLINE_SURVEY_ASSETS . 'templates/js/js.js', array( 'bootstrap-bundle'), ONLINE_SURVEY_VER);
		wp_localize_script( 'online-survey', 'OnlineSurvey', [
			'uri' => ONLINE_SURVEY_URI,
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonceSubmitForm' => wp_create_nonce('submit-online-survey-form'),
		] );
    }

    public function single_template($template){
        

        $post_type = get_post_type();
        switch ($post_type) {
            case 'survey':
                if (is_singular($post_type)) {
                    $template_file = online_survey_template('single-survey.php');
                }
                break;
            default:
                break;
        }


        if (!empty($template_file)) {
            $template = $template_file;
        }

        return $template;
    }


    public function the_content($content) {
        if (get_post_type() == 'survey') {
            wp_enqueue_style('online-survey');
            wp_enqueue_script('online-survey');

           
            ob_start();
            online_survey_locate_template('single/survey.php');
            $content .= ob_get_clean();
        }
        return $content;
    }

    public function online_survey_form() {

        

        echo '<div class="online-survey-title">';
        online_survey_formated_content(online_survey_meta('title'), '<h2>', '</h2>');
        online_survey_formated_content(online_survey_meta('subtitle'));
        echo '</div>';
        $questions_fields = online_survey_meta('questions');
        if (!empty($questions_fields)) {
            foreach ($questions_fields as $key => $field) {
                $field['id'] = 'question_' . $key;
                $field['key'] = $key;
                $field['input_name'] = 'answers[' . $key . '][answer]';
                online_survey_question_field($field);
            }
        }
        online_survey_formated_content(online_survey_meta('footer'));

        $basic_info_fields = include __DIR__ . '/admin/user-info.php';
        if (!empty($basic_info_fields)) {
            foreach ($basic_info_fields as $key => $field) {
                $field['input_name'] = $field['id'];
                online_survey_basic_field($field);
            }
        }
    }

    
}
