<?php
// receives:
// - $module
// - $id
// - $settings

// allowed object-fit values (applied to both the video and the poster image)
$ambbb_video_fits = [ 'contain', 'cover', 'fill', 'scale-down' ];
$ambbb_video_fit = $module->has( 'object_fit' ) ? $module->settings->object_fit : '';
?>

<?php if ( in_array( $ambbb_video_fit, $ambbb_video_fits, true ) ) : ?>
  .fl-node-<?= $id; ?> {
    --ambbb-video__object-fit: <?= $ambbb_video_fit; ?>;
  }
<?php endif; ?>
