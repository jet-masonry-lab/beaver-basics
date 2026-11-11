<?php
// receives:
// - $module
// - $id
// - $settings

// allowed object-fit values => poster background-size equivalent
$ambbb_video_fits = [
  'contain'    => 'contain',
  'cover'      => 'cover',
  'fill'       => '100% 100%',
  'scale-down' => 'contain',
];
$ambbb_video_fit = $module->has( 'object_fit' ) ? $module->settings->object_fit : '';
?>

<?php if ( isset( $ambbb_video_fits[ $ambbb_video_fit ] ) ) : ?>
  .fl-node-<?= $id; ?> {
    --ambbb-video__object-fit: <?= $ambbb_video_fit; ?>;
    --ambbb-video__poster-size: <?= $ambbb_video_fits[ $ambbb_video_fit ]; ?>;
  }
<?php endif; ?>
