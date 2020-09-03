<?php
// receives:
// - $module
// - $id
// - $settings
?>

<?php if ( !empty( $settings->buttons ) ) : ?>
  <div class="<?= esc_attr( $module->classes() ); ?>">
    <?php foreach( $settings->buttons as $button ) : ?>
      <?php  if (
        !empty( $button->link )
        && !empty( $button->text )
      ) : ?>
        <a class="<?= esc_attr( $module->classes( 'button', $button ) ); ?>" href="<?= esc_url( $button->link ); ?>" <?= $module->linkAttrs( 'link' ); ?>>
          <span class="<?= esc_attr( $module->classes( 'text', $button ) ); ?>"><?= $module->escInlineHtml( $button->text ); ?></span>
        </a>
      <?php endif;  ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>