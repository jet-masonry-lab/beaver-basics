<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->classes() ); ?>">
  <?php if ( !empty( $settings->hr ) ) : ?>
    <hr class="<?= esc_attr( $module->classes( 'hr' ) ); ?>">
  <?php endif; ?>
</div>
