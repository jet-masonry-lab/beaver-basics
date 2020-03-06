<?php
// receives:
// - $module
// - $id
// - $settings
?>

<div class="<?= esc_attr( $module->classes() ); ?>">
  <div class="<?= esc_attr( $module->classes( 'viewport' ) ); ?>">

    <?php if ( $module->has( 'slides' ) ) : ?>

      <?php foreach ( $settings->slides as $slide ) : ?>
        <div class="<?= esc_attr( $module->classes( 'slide', $slide ) ); ?>">
          <?= wp_kses_post( $slide->html ); ?>
        </div>
      <?php endforeach; ?>

    <?php endif; ?>

  </div>

  <?php if ( $module->has( 'slides' ) && count( $settings->slides ) > 1 ) : ?>

    <div class="<?= esc_attr( $module->classes( 'pagination' ) ); ?>">
      <?php foreach ( $settings->slides as $i => $slide ) : ?>
        <span class="<?= esc_attr( $module->classes( 'goto' ) ); ?>" data-goto="<?= $i; ?>"><?= $i; ?></span>
      <?php endforeach; ?>
    </div>

    <div class="<?= esc_attr( $module->classes( 'shift' ) ); ?>">
      <span class="<?= esc_attr( $module->classes( 'prev' ) ); ?>">Prev</span>
      <span class="<?= esc_attr( $module->classes( 'next' ) ); ?>">Next</span>
    </div>

  <?php endif; ?>

</div>