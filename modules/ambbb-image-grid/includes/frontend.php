<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->gridClasses() ); ?>">
  <?php if ( $module->hasImages() ) : ?>
    <?php foreach ( $module->getImages() as $image ) : ?>
      <figure class="<?= esc_attr( $module->figureClasses( $image['id'] ) ); ?>">
        <?php if ( $module->imgIsLinked( $image['id'] ) ) : ?>
          <a href="<?= esc_attr( $module->imgLinkHref( $image['id'] ) ); ?>">
        <?php endif; ?>
        <div class="<?= esc_attr( $module->imgWrapClasses( $image['id'] ) ); ?>">
          <?= wp_get_attachment_image( $image['id'], $settings->image_size, false, [ 'class' => $module->imgClasses( $image['id'] ) ] ); ?>
        </div>
        <?php if ( $module->isTrue( 'output_caption' ) ) : ?>
          <figcaption class="<?= esc_attr( $module->figcaptionClasses( $image['id'] ) ); ?>">
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