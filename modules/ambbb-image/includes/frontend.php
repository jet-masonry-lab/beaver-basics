<?php
// receives:
// - $module
// - $id
// - $settings
?>
<?php if ( $module->has( 'image' ) ) : ?>
  <figure class="<?= esc_attr( $module->classes() ); ?>">
    <div class="<?= esc_attr( $module->classes( 'image-area' ) ); ?>">
      <?= wp_get_attachment_image( $settings->image, $settings->image_size, false, [ 'class' => esc_attr( $module->classes( 'image' ) ) ] ); ?>
    </div>
    <?php if ( $module->isTrue( 'output_caption' ) ) : ?>
      <figcaption class="<?= esc_attr( $module->classes( 'caption' ) ); ?>">
        <?= $module->escInlineHtml( $image['caption'] ); ?>
      </figcaption>
    <?php endif; ?>
  </figure>
<?php else : ?>
  <p><?= __( 'No image set.', 'amb-beaver-basics' ); ?></p>
<?php endif; ?>