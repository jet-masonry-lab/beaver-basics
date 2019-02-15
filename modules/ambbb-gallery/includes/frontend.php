<?php
// receives:
// - $module
// - $id
// - $settings

// if sourcing from a post, WP will automatically default to current post
// but if a post is selected, use that as the "id" attribute
if (
  'post' == $settings->source
  && ! empty( $settings->post_id )
  && preg_match( '/^[0-9]+$/', $settings->post_id )
) {
  $gallery_attributes['id'] = esc_attr( $settings->post_id );
} else if (
  'custom' == $settings->source
  && ! empty( $settings->images )
) {
  $gallery_attributes['ids'] = esc_attr( implode( ',', $settings->images ) );
};

if ( ! empty( $settings->orderby ) ) {
  $gallery_attributes['orderby'] = esc_attr( $settings->orderby );
};

if ( ! empty( $settings->orderby ) ) {
  $gallery_attributes['order'] = esc_attr( $settings->order );
};

if ( isset( $settings->columns ) && preg_match( '/^[0-9]+$/', $settings->columns ) ) {
  $gallery_attributes['columns'] = esc_attr( $settings->columns );
}

if ( ! empty( $settings->size ) ) {
  $gallery_attributes['size'] = esc_attr( $settings->size );
}

if ( ! empty( $settings->link ) ) {
  $gallery_attributes['link'] = esc_attr( $settings->link );
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

<?= $gallery_shortcode ?>
