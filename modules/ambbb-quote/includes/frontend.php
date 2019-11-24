<?php
// receives:
// - $module
// - $id
// - $settings
?>

<figure class="<?= esc_attr( $module->quoteClasses() ); ?>">
  <blockquote
    class="<?= esc_attr( $module->bodyClasses() ); ?>"
    <?= $module->citeAttribute(); ?>
  >
    <?= $module->escInlineHtml( $settings->quote ); ?>
  </blockquote>
  <figcaption class="<?= esc_attr( $module->attributionClasses() ); ?>">
    <?= $module->linkOpen(); ?>
      <?= $module->escInlineHtml( $settings->attribution ); ?>
    <?= $module->linkClose(); ?>
  </figcaption>
</figure>
