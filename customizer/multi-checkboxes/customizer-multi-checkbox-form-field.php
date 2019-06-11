<?php namespace WSUWP\Code_Library;

?>
<div class="wsuwp-customizer-multi-checkbox">
	<?php foreach ( $choices as $value => $label ) : ?>
	<label>
		<input 
		type="checkbox" 
		value="<?php echo esc_attr( $value ); ?>" 
		<?php if ( in_array( $value, $selected_choices, true ) ) : ?>checked="checked"<?php endif; ?> />
		<span class="wsuwp-customizer-label-text"><?php echo esc_html( $label ); ?></span>
	</label><br /><?php endforeach; ?>
	<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $selected_choices ) ); ?>" />
</div>
