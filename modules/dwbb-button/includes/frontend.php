<?php
// receives:
// - $module
// - $id
// - $settings
?>

<a href="<?php echo $settings->link; ?>" target="<?php echo $settings->link_target; ?>" class="fl-button" role="button">
  <span class="fl-button-text"><?php echo $settings->text; ?></span>
</a>