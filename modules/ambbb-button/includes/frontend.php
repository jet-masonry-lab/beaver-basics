<?php
// receives:
// - $module
// - $id
// - $settings
?>

<a class="<?= $module->buttonClasses(); ?>" href="<?= esc_url( $settings->link ); ?>" target="<?= esc_attr( $settings->link_target ); ?>" <?= $module->noopener( $settings->link_target ); ?> role="button">
  <span class="<?= $module->textClasses(); ?>"><?= $module->escInlineHtml( $settings->text ); ?></span>
</a>