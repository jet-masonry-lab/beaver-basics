<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->introClasses() ); ?>">


  <?php if (
    // eyebrow outside heading
    !empty( $settings->eyebrow )
    && 'sibling' === $settings->eyebrow_rel
  ) : ?>
    <<?= $settings->eyebrow_tag; ?> class="<?= esc_attr( $module->eyebrowClasses() ); ?>">
      <?= $module->escInlineHtml( $settings->eyebrow ); ?>
    </<?= $settings->eyebrow_tag; ?>>
  <?php endif; ?>


  <?php if (
    !empty( $settings->heading )
    || ( !empty( $settings->eyebrow ) && 'child' === $settings->eyebrow_rel )
    || ( !empty( $settings->subhead ) && 'child' === $settings->subhead_rel )
  ) : ?>
    <<?= $settings->heading_tag; ?> class="<?= esc_attr( $module->headingClasses() ); ?>">

      <?php if (
        // eyebrow inside heading
        !empty( $settings->eyebrow )
        && 'child' === $settings->eyebrow_rel
      ) : ?>
        <div class="<?= esc_attr( $module->eyebrowClasses() ); ?>">
          <?= $module->escInlineHtml( $settings->eyebrow ); ?>
        </div>
      <?php endif; ?>

      <div class="<?= esc_attr( $module->headingTextClasses() ); ?>">
        <?= $module->escInlineHtml( $settings->heading ); ?>
      </div>

      <?php if (
        // subhead inside heading
        !empty( $settings->subhead )
        && 'child' === $settings->subhead_rel
      ) : ?>
        <div class="<?= esc_attr( $module->subheadClasses() ); ?>">
          <?= $module->escInlineHtml( $settings->subhead ); ?>
        </div>
      <?php endif; ?>

    </<?= $settings->heading_tag; ?>>
  <?php endif; ?>


  <?php if (
    // subhead outside heading
    !empty( $settings->subhead )
    && 'sibling' === $settings->subhead_rel
  ) : ?>
    <<?= $settings->subhead_tag; ?> class="<?= esc_attr( $module->subheadClasses() ); ?>">
      <?= $module->escInlineHtml( $settings->subhead ); ?>
    </<?= $settings->subhead_tag; ?>>
  <?php endif; ?>


  <?php if (
    // body outside heading
    !empty( $settings->body )
    && 'sibling' === $settings->body_rel
  ) : ?>
    <<?= $settings->body_tag; ?> class="<?= esc_attr( $module->bodyClasses() ); ?>">
      <?= wp_kses_post( $settings->body ); ?>
    </<?= $settings->body_tag; ?>>
  <?php endif; ?>


</div>
