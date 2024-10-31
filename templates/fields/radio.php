<label class="fs-4" for="<?php echo esc_attr($id) ?>"><?php echo esc_attr( $name ) ?></label>
<div class="input-wrapper">
<?php foreach ($options as $key => $value): ?>
    <div class="form-check">
    <input class="form-check-input" type="radio" name="<?php echo esc_attr($input_name) ?>" id="<?php echo sanitize_key( $id.'_'.$key ) ?>" value="<?php echo esc_attr( $value[0] ) ?>">
    <label class="form-check-label" for="<?php echo sanitize_key( $id.'_'.$key ) ?>"><?php echo esc_attr( $value[1] ) ?></label>
    </div>
<?php endforeach; ?>  
</div>
