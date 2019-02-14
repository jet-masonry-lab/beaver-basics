<?php
// receives:
// - $module
// - $id
// - $settings
?>

<?php wp_nav_menu( array(
  'menu' => $settings->menu
) ); ?>