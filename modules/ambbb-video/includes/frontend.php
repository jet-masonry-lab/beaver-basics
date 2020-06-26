<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->classes() ); ?>">

  <?php if ( ! $module->getValidSources() ) : ?>

    <p>No valid video sources defined.</p>

  <?php else: ?>

    <video
      id="ambbb-video--<?= esc_attr( $id ); ?>"
      class="ambbb-video__video video-js"
      data-setup='<?= $module->getSetup(); ?>'
    >
      <?php if ( !isset( $_GET['fl_builder'] ) ): ?>
        <?php foreach ( $module->getValidSources() as $source ) : ?>
          <source
            src="<?= esc_url( $source ); ?>"
            type="<?= esc_attr( $module->getSourceType( $source ) ); ?>"
          >
        <?php endforeach; ?>
      <?php endif; ?>
    </video>

  <?php endif; ?>

</div>
