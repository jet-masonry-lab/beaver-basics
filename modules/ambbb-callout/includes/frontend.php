<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->classes() ); ?>">

  <?php if (
    'block' === $settings->link_type
    && !empty( $settings->link )
  ) : ?>
    <a class="<?= esc_attr( $module->classes( 'link' ) ); ?>" href="<?= esc_url( $settings->link ); ?>" <?= $module->linkAttrs( 'link' ); ?>>
  <?php endif; ?>

  <?php if ( !empty( $settings->image ) ) : ?>
    <div class="<?= esc_attr( $module->classes( 'image-area' ) ); ?>">
      <?= wp_get_attachment_image( $settings->image, $settings->image_size, false, [ 'class' => esc_attr( $module->classes( 'image' ) ) ] ); ?>
    </div>
  <?php endif; ?>

  <div class="<?= esc_attr( $module->classes( 'text-area' ) ); ?>">
    <?php if ( !empty( $settings->eyebrow ) ) : ?>
      <<?= tag_escape( $settings->eyebrow_tag ); ?> class="<?= esc_attr( $module->classes( 'eyebrow' ) ); ?>">
        <?= $module->escInlineHtml( $settings->eyebrow ); ?>
      </<?= tag_escape( $settings->eyebrow_tag ); ?>>
    <?php endif; ?>

    <?php if ( !empty( $settings->heading ) ) : ?>
      <<?= tag_escape( $settings->heading_tag ); ?> class="<?= esc_attr( $module->classes( 'heading' ) ); ?>">
        <?= $module->escInlineHtml( $settings->heading ); ?>
      </<?= tag_escape( $settings->heading_tag ); ?>>
    <?php endif; ?>

    <?php if ( !empty( $settings->body ) ) : ?>
      <<?= tag_escape( $settings->body_tag ); ?> class="<?= esc_attr( $module->classes( 'body' ) ); ?>">
        <?= wp_kses_post( $settings->body ); ?>
      </<?= tag_escape( $settings->body_tag ); ?>>
    <?php endif; ?>

    <?php if (
      'buttons' === $settings->link_type
      && !empty( $settings->buttons )
      && !empty( $settings->buttons[0]->link )
      && !empty( $settings->buttons[0]->text )
    ) : ?>
      <div class="<?= esc_attr( $module->classes( 'buttons' ) ); ?>">
        <?php foreach( $settings->buttons as $button ) : ?>
          <?php  if (
            !empty( $button->link )
            && !empty( $button->text )
          ) : ?>
            <a class="<?= esc_attr( $module->classes( 'button', $button ) ); ?>" href="<?= esc_url( $button->link ); ?>" <?= $module->linkAttrs( 'link', $button ); ?>>
              <span class="<?= esc_attr( $module->classes( 'text', $button ) ); ?>"><?= $module->escInlineHtml( $button->text, $button ); ?></span>
            </a>
          <?php endif;  ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php if (
    'block' === $settings->link_type
    && !empty( $settings->link )
  ) : ?>
    </a>
  <?php endif; ?>

</div>
