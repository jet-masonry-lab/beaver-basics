<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="c-intro">


  <?php if (
    // eyebrow outside heading
    !empty( $settings->eyebrow )
    && 'sibling' === $settings->eyebrow_rel
  ) : ?>
    <<?= $settings->eyebrow_tag; ?> class="c-intro__eyebrow">
      <?= $settings->eyebrow; ?>
    </<?= $settings->eyebrow_tag; ?>>
  <?php endif; ?>


  <?php if ( !empty( $settings->heading ) ) : ?>
    <<?= $settings->heading_tag; ?> class="c-intro__heading">

      <?php if (
        // eyebrow inside heading
        !empty( $settings->eyebrow )
        && 'child' === $settings->eyebrow_rel
      ) : ?>
        <div class="c-intro__eyebrow"><?= $settings->eyebrow; ?></div>
      <?php endif; ?>

      <div class="c-intro__heading__text">
        <?= $settings->heading; ?>
      </div>

      <?php if (
        // body inside heading
        !empty( $settings->body )
        && 'child' === $settings->body_rel
      ) : ?>
        <div class="c-intro__body"><?= $settings->body; ?></div>
      <?php endif; ?>

    </<?= $settings->heading_tag; ?>>
  <?php endif; ?>


  <?php if (
    // body outside heading
    !empty( $settings->body )
    && 'sibling' === $settings->body_rel
  ) : ?>
    <<?= $settings->body_tag; ?> class="c-intro__body">
      <?= $settings->body; ?>
    </<?= $settings->body_tag; ?>>
  <?php endif; ?>


</div>
