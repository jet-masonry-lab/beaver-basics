<?php

// Strip " !important" from Beaver Builder's generated layout CSS, so theme styles can override builder settings
// Off by default. A theme opts in with:
//   add_filter( 'ambbb__strip_builder_important', '__return_true' );
function ambbb__maybe_strip_builder_important( $css )
{
  if ( ! apply_filters( 'ambbb__strip_builder_important', false ) ) {
    return $css;
  }
  return str_ireplace( ' !important', '', $css );
}
// Last priority so it runs after Themer, PowerPack and others append their CSS to the layout
add_filter( 'fl_builder_render_css', 'ambbb__maybe_strip_builder_important', PHP_INT_MAX );
