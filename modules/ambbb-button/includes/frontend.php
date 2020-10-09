<?php
// receives:
// - $module
// - $id
// - $settings
?>

<a class="<?= esc_attr( $module->classes() ); ?>" href="<?= esc_url( $settings->link ); ?>" <?= $module->linkAttrs( 'link' ); ?> role="button">
  <span class="<?= esc_attr( $module->classes( 'text' ) ); ?>"><?= $module->escInlineHtml( $settings->text ); ?></span>
</a>