<?php
// receives:
// - $module
// - $id
// - $settings

// Columns
FLBuilderCSS::responsive_rule( array(
  'settings'     => $settings,
  'setting_name' => 'columns',
  'selector'     => ".fl-node-$id",
  'prop'         => '--ambbb-passthru-value-cols',  // can't use "image" in property name due to a bug in builder responsive rule generator
  'unit'         => '',
) );
?>

.ambbb-image-grid {
  --ambbb-image-grid-cols: var( --ambbb-passthru-value-cols, 1 );
}