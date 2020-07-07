<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->classes() ); ?>">

  <?php if ( $module->has( 'youtube_id' ) ) : ?>
    <iframe
      class="<?= esc_attr( $module->classes( 'iframe' ) ); ?>"
      src='https://www.youtube.com/embed/<?= $settings->youtube_id ?>?rel=0&amp;showinfo=0&amp;playsinline=1'
      frameborder='0'
      allowfullscreen
    ></iframe>
  <?php endif; ?>

</div>