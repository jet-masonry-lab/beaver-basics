<?php
// receives:
// - $module
// - $id
// - $settings
?>

<?php if ( $module->has( 'aspect_ratio' ) ) : ?>
.fl-node-<?= $id; ?> {
  --ambbb-youtube__aspect-ratio: <?= $module->getAspectRatioPercentage(); ?>%;
}
<?php endif; ?>