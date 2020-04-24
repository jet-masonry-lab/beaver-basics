<?php
// receives:
// - $module
// - $id
// - $settings
?>
<?php if ( $module->has( 'image' ) ) : ?>

  <figure class="<?= esc_attr( $module->classes() ); ?>">
    <?php if ( !empty( $settings->link_url ) ) : ?>
      <a href="<?= esc_url( $settings->link_url ); ?>" class="<?= esc_attr( $module->classes( 'link' ) ); ?>">
    <?php endif; ?>
    <div class="<?= esc_attr( $module->classes( 'image-area' ) ); ?>">
      <?= wp_get_attachment_image( $settings->image, $settings->image_size, false, [ 'class' => esc_attr( $module->classes( 'image' ) ) ] ); ?>
    </div>
    <?php if ( $module->isTrue( 'output_caption' ) ) : ?>
      <figcaption class="<?= esc_attr( $module->classes( 'caption' ) ); ?>">
        <?= $module->escInlineHtml( $image['caption'] ); ?>
      </figcaption>
    <?php endif; ?>
    <?php if ( !empty( $settings->link_url ) ) : ?>
      </a>
    <?php endif; ?>
  </figure>

<?php else : ?>
  <p><?= __( 'No image set.', 'amb-beaver-basics' ); ?></p>
<?php endif; ?>