<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= $module->mainClasses(); ?>">
  <?php if ( $module->has( 'images' ) ) : ?>
    <?php foreach ( $module->images() as $image_id ) : ?>
      <figure class="<?= $module->figureClasses( $image_id ); ?>">
        <div class="<?= $module->imgWrapClasses( $image_id ); ?>">
          <?= wp_get_attachment_image( $image_id, $settings->image_size, false, [ 'class' => $module->imgClasses( $image_id ) ] ); ?>
        </div>
        <?php if ( $module->isTrue( 'output_caption' ) ) : ?>
          <figcaption class="<?= $module->figcaptionClasses( $image_id ); ?>">
            <?= wp_get_attachment_caption( $image_id ); ?>
          </figcaption>
        <?php endif; ?>
      </figure>
    <?php endforeach; ?>
  <?php else : ?>
    <p>No images found.</p>
  <?php endif; ?>
</div>