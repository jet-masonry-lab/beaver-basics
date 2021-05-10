<?php
// receives:
// - $module
// - $id
// - $settings
?>

<?php if ( $module->has( 'object_fit' ) ) : ?>
.fl-node-<?= $id; ?> {
  --ambbb-video__object-fit: <?= $module->settings->object_fit; ?>;
}
<?php endif; ?>