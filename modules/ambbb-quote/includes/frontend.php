<?php
// receives:
// - $module
// - $id
// - $settings
?>

<figure class="<?= esc_attr( $module->classes() ); ?>">
  <blockquote
    class="<?= esc_attr( $module->classes( 'body' ) ); ?>"
    <?= $module->citeAttribute(); ?>
  >
    <?= $module->escInlineHtml( $settings->quote ); ?>
  </blockquote>
  <figcaption class="<?= esc_attr( $module->classes( 'attribution' ) ); ?>">
    <?= $module->linkOpen(); ?>
      <?= $module->escInlineHtml( $settings->attribution ); ?>
    <?= $module->linkClose(); ?>
  </figcaption>
</figure>
