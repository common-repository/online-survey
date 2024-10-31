<?php
namespace OnlineSurvey\SettingsPage\Customizer;

class Control extends \WP_Customize_Control {
	public $type = 'meta_box';
	public $meta_box;

	public function render_content() {
		$this->meta_box->show();
		?>
		<input type="hidden" <?php $this->link(); ?>>
		<?php
	}

	public function enqueue() {
		$this->meta_box->enqueue();

		wp_enqueue_style( 'mbsp-customizer', ONLINE_SURVEY_ASSETS . '/settings/customizer.css', [], '2.1.5' );

		wp_register_script( 'mb-jquery-serialize-object', ONLINE_SURVEY_ASSETS . '/settings/jquery.serialize-object.js', ['jquery'], '2.5.0', true );
		wp_enqueue_script( 'mbsp-customizer', ONLINE_SURVEY_ASSETS . '/settings/customizer.js', ['customize-controls', 'mb-jquery-serialize-object', 'rwmb', 'underscore'], '2.1.5', true );
	}
}