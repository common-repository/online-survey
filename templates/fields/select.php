<label class="fs-4" for="<?php echo esc_attr($id) ?>"><?php echo esc_attr( $name ) ?></label>
<select class="form-select" name="<?php echo esc_attr($input_name) ?>" id="<?php echo esc_attr($id) ?>">
<?php foreach ($options as $key => $value): ?>
    
    <option value="<?php echo esc_attr( $key ) ?>"><?php echo esc_attr( $value ) ?></option>
    
<?php endforeach; ?>  
</select>

