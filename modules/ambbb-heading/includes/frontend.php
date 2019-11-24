<?php
// receives:
// - $module
// - $id
// - $settings

$heading_format = '<%1$s class="%3$s">%2$s</%1$s>';

echo sprintf(
  $heading_format,
  $tag = $settings->tag,
  $content = $module->escInlineHtml( $settings->content ),
  $class = esc_attr( $module->headingClasses() )
);
