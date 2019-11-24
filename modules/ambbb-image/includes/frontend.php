<?php
// receives:
// - $module
// - $id
// - $settings
?>
<?php if ( $module->has( 'image' ) ) : ?>
  <figure class="<?= esc_attr( $module->figureClasses() ); ?>">
    <div class="<?= esc_attr( $module->imgWrapClasses() ); ?>">
      <?= wp_get_attachment_image( $settings->image, $settings->image_size, false, [ 'class' => $module->imgClasses() ] ); ?>
    </div>
    <?php if ( $module->isTrue( 'output_caption' ) ) : ?>
      <figcaption class="<?= esc_attr( $module->figcaptionClasses() ); ?>">
        <?= $module->escInlineHtml( $image['caption'] ); ?>
      </figcaption>
    <?php endif; ?>
  </figure>
<?php else : ?>
  <p><?= __( 'No image set.', 'amb-beaver-basics' ); ?></p>
<?php endif; ?>