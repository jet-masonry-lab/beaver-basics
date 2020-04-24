<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->classes() ); ?>">

  <?php if ( 'block' === $settings->link_type ) : ?>
    <a href="<?= esc_url( $settings->link_url ); ?>" class="<?= esc_attr( $module->classes( 'link' ) ); ?>">
  <?php endif; ?>

  <?php if ( !empty( $settings->image ) ) : ?>
    <div class="<?= esc_attr( $module->classes( 'image-area' ) ); ?>">
      <?= wp_get_attachment_image( $settings->image, $settings->image_size, false, [ 'class' => esc_attr( $module->classes( 'image' ) ) ] ); ?>
    </div>
  <?php endif; ?>

  <div class="<?= esc_attr( $module->classes( 'text-area' ) ); ?>">
    <?php if ( !empty( $settings->eyebrow ) ) : ?>
      <<?= $settings->eyebrow_tag; ?> class="<?= esc_attr( $module->classes( 'eyebrow' ) ); ?>">
        <?= $module->escInlineHtml( $settings->eyebrow ); ?>
      </<?= $settings->eyebrow_tag; ?>>
    <?php endif; ?>

    <?php if ( !empty( $settings->heading ) ) : ?>
      <<?= $settings->heading_tag; ?> class="<?= esc_attr( $module->classes( 'heading' ) ); ?>">
        <?= $module->escInlineHtml( $settings->heading ); ?>
      </<?= $settings->heading_tag; ?>>
    <?php endif; ?>

    <?php if ( !empty( $settings->body ) ) : ?>
      <<?= $settings->body_tag; ?> class="<?= esc_attr( $module->classes( 'body' ) ); ?>">
        <?= wp_kses_post( $settings->body ); ?>
      </<?= $settings->body_tag; ?>>
    <?php endif; ?>

    <?php if ( !empty( $settings->buttons ) ) : ?>
      <div class="<?= esc_attr( $module->classes( 'buttons' ) ); ?>">
        <?php foreach( $settings->buttons as $button ) : ?>
          <?php  if (
            !empty( $button->link_url )
            && !empty( $button->link_text )
          ) : ?>
            <a href="<?= esc_url( $button->link_url ); ?>" target="<?= esc_attr( $settings->link_url_target ); ?>" <?= $module->noopener( $settings->link_url_target ); ?> class="<?= esc_attr( $module->classes( 'button', $button ) ); ?>">
              <span class="<?= esc_attr( $module->classes( 'text', $button ) ); ?>"><?= $module->escInlineHtml( $button->link_text, $button ); ?></span>
            </a>
          <?php endif;  ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php if ( 'block' === $settings->link_type ) : ?>
    </a>
  <?php endif; ?>

</div>
