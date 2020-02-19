<?php
// receives:
// - $module
// - $id
// - $settings
?>

<a class="<?= esc_attr( $module->classes() ); ?>" href="<?= esc_url( $settings->link ); ?>" target="<?= esc_attr( $settings->link_target ); ?>" <?= $module->noopener( $settings->link_target ); ?> role="button">
  <span class="<?= esc_attr( $module->classes( 'text' ) ); ?>"><?= $module->escInlineHtml( $settings->text ); ?></span>
</a>