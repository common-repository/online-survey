<form class="form form-online-survey d-flex flex-column gap-4" method="post" action="#">
    <div class="online-survey-notice"></div>
    <?php
    do_action('online_survey_form_before');


    do_action('online_survey_form');
    

    do_action('online_survey_form_after');
    ?>
    <div class="btn-wrapper">
        <button type="submit" class="btn btn-dark btn-online-survey-submit"><?php echo esc_attr( online_survey_meta('button_text') ) ?></button>
    </div>
</form>