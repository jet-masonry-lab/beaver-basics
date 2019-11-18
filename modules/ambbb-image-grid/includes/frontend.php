<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->mainClasses() ); ?>">
  <?php if ( $module->hasImages() ) : ?>
    <?php foreach ( $module->getImages() as $image ) : ?>
      <figure class="<?= esc_attr( $module->figureClasses( $image['id'] ) ); ?>">
        <div class="<?= esc_attr( $module->imgWrapClasses( $image['id'] ) ); ?>">
          <?= wp_get_attachment_image( $image['id'], $settings->image_size, false, [ 'class' => $module->imgClasses( $image['id'] ) ] ); ?>
        </div>
        <?php if ( $module->isTrue( 'output_caption' ) ) : ?>
          <figcaption class="<?= esc_attr( $module->figcaptionClasses( $image['id'] ) ); ?>">
            <?= wp_kses( $image['caption'], ambbb__allowed_html__inline() ); ?>
          </figcaption>
        <?php endif; ?>
      </figure>
    <?php endforeach; ?>
  <?php else : ?>
    <p><?= __( 'No images found.', 'amb-beaver-basics' ); ?></p>
  <?php endif; ?>
</div>