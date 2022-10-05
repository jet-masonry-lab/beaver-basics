<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->classes() ); ?>">


  <?php if (
    // eyebrow outside heading
    !empty( $settings->eyebrow )
    && 'sibling' === $settings->eyebrow_rel
  ) : ?>
    <<?= tag_escape( $settings->eyebrow_tag ); ?> class="<?= esc_attr( $module->classes( 'eyebrow' ) ); ?>">
      <?= $module->escInlineHtml( $settings->eyebrow ); ?>
    </<?= tag_escape( $settings->eyebrow_tag ); ?>>
  <?php endif; ?>


  <?php if (
    !empty( $settings->heading )
    || ( !empty( $settings->eyebrow ) && 'child' === $settings->eyebrow_rel )
    || ( !empty( $settings->subhead ) && 'child' === $settings->subhead_rel )
  ) : ?>
    <<?= tag_escape( $settings->heading_tag ); ?> class="<?= esc_attr( $module->classes( 'heading' ) ); ?>">

      <?php if (
        // eyebrow inside heading
        !empty( $settings->eyebrow )
        && 'child' === $settings->eyebrow_rel
      ) : ?>
        <div class="<?= esc_attr( $module->classes( 'eyebrow' ) ); ?>">
          <?= $module->escInlineHtml( $settings->eyebrow ); ?>
        </div>
      <?php endif; ?>

      <div class="<?= esc_attr( $module->classes( 'heading-text' ) ); ?>">
        <?= $module->escInlineHtml( $settings->heading ); ?>
      </div>

      <?php if (
        // subhead inside heading
        !empty( $settings->subhead )
        && 'child' === $settings->subhead_rel
      ) : ?>
        <div class="<?= esc_attr( $module->classes( 'subhead' ) ); ?>">
          <?= $module->escInlineHtml( $settings->subhead ); ?>
        </div>
      <?php endif; ?>

    </<?= tag_escape( $settings->heading_tag ); ?>>
  <?php endif; ?>


  <?php if (
    // subhead outside heading
    !empty( $settings->subhead )
    && 'sibling' === $settings->subhead_rel
  ) : ?>
    <<?= tag_escape( $settings->subhead_tag ); ?> class="<?= esc_attr( $module->classes( 'subhead' ) ); ?>">
      <?= $module->escInlineHtml( $settings->subhead ); ?>
    </<?= tag_escape( $settings->subhead_tag ); ?>>
  <?php endif; ?>


  <?php if (
    !empty( $settings->body )
  ) : ?>
    <<?= tag_escape( $settings->body_tag ); ?> class="<?= esc_attr( $module->classes( 'body' ) ); ?>">
      <?= wp_kses_post( $settings->body ); ?>
    </<?= tag_escape( $settings->body_tag ); ?>>
  <?php endif; ?>


</div>
