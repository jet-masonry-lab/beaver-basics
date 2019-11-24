<?php
// receives:
// - $module
// - $id
// - $settings
?>

<?php if ( !empty( $settings->buttons ) ) : ?>
  <div class="o-button-group">
    <?php foreach( $settings->buttons as $button ) : ?>
      <?php  if (
        !empty( $button->link_url )
        && !empty( $button->link_text )
      ) : ?>
        <a href="<?= esc_attr( $button->link_url ); ?>" target="<?= esc_attr( $button->link_url_target ); ?>" class="o-button <?= esc_attr( $module->variation_classes( 'o-button', $button ) ); ?>">
          <?= $module->escInlineHtml( $button->link_text ); ?>
        </a>
      <?php endif;  ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>