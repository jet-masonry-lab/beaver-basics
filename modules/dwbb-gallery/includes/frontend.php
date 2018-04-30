<?php
// receives:
// - $module
// - $id
// - $settings

$gallery_attributes = array(
  'ids' => ''
);
if ( ! empty( $settings->photos ) ) {
  $gallery_attributes['ids'] = implode( ',', $settings->photos );
};
if ( ! empty( $settings->columns ) ) {
  $gallery_attributes['columns'] = $settings->columns;
}
if ( ! empty( $settings->size ) ) {
  $gallery_attributes['size'] = $settings->size;
}
if ( ! empty( $settings->link ) ) {
  $gallery_attributes['link'] = $settings->link;
}

$gallery_attributes_inline = array_map( function( $key, $value ) {
  return sprintf(
    '%s="%s"',
    $key,
    $value
  );
}, array_keys( $gallery_attributes ), $gallery_attributes );

$gallery_shortcode = sprintf(
  '[gallery %s]',
  implode( ' ', $gallery_attributes_inline )
);
?>

<?= apply_filters( 'the_content', $gallery_shortcode ); ?>
