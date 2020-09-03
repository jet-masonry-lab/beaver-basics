<?php
// receives:
// - $module
// - $id
// - $settings
?>

<<?= $settings->tag; ?> class="<?= esc_attr( $module->classes() ); ?>">
  <?php if ( $module->has( 'link' ) ) : ?>
    <a class="<?= esc_attr( $module->classes( 'link' ) ); ?>" href="<?= esc_url( $settings->link ); ?>" <?= $module->linkAttrs( 'link' ); ?>>
  <?php endif; ?>
    <?= $module->escInlineHtml( $settings->content ); ?>
  <?php if ( $module->has( 'link' ) ) : ?>
    </a>
  <?php endif; ?>
</<?= $settings->tag; ?>>