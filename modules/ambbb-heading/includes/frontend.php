<?php
// receives:
// - $module
// - $id
// - $settings

$heading_format = '<%1$s class="c-heading">%2$s</%1$s>';

echo sprintf(
  $heading_format,
  $tag = $settings->tag,
  $content = $settings->content
);
