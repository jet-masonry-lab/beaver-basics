<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->classes() ); ?>">
  <?php if ( $module->hasImages() ) : ?>
    <?php foreach ( $module->getImages() as $image ) : ?>
      <figure class="<?= esc_attr( $module->classes( 'figure', $image ) ); ?>">
        <?php if ( $module->imgIsLinked( $image['id'] ) ) : ?>
          <a class="<?= esc_attr( $module->classes( 'link', $image ) ); ?>" href="<?= esc_attr( $module->imgLinkHref( $image['id'] ) ); ?>">
        <?php endif; ?>
        <div class="<?= esc_attr( $module->classes( 'image-area', $image ) ); ?>">
          <?= wp_get_attachment_image( $image['id'], $settings->image_size, false, [ 'class' => esc_attr( $module->classes( 'image', $image ) ) ] ); ?>
        </div>
        <?php if ( $module->isTrue( 'output_caption' ) ) : ?>
          <figcaption class="<?= esc_attr( $module->classes( 'caption', $image ) ); ?>">
            <?= $module->escInlineHtml( $image['caption'] ); ?>
          </figcaption>
        <?php endif; ?>
        <?php if ( $module->imgIsLinked( $image['id'] ) ) : ?>
          </a>
        <?php endif; ?>
      </figure>
    <?php endforeach; ?>
  <?php else : ?>
    <p><?= __( 'No images found.', 'amb-beaver-basics' ); ?></p>
  <?php endif; ?>
</div>