<?php
// receives:
// - $module
// - $id
// - $settings
?>

<?php if ( !empty( $settings->post ) ) : ?>

  <div class="<?= esc_attr( $module->classes( NULL ) ); ?>">

    <?php if ( 'block' === $settings->link_type ) : ?>
      <a href="<?= get_the_permalink( $settings->post ); ?>" class="<?= esc_attr( $module->classes( 'permalink' ) ); ?>">
    <?php endif; ?>

    <div class="<?= esc_attr( $module->classes( 'thumbnail' ) ); ?>">
      <?php if ( 'parts' === $settings->link_type ) : ?><a href="<?= get_the_permalink( $settings->post ); ?>" class="<?= esc_attr( $module->classes( 'permalink' ) ); ?>"><?php endif; ?>
      <?= get_the_post_thumbnail( $settings->post, $settings->thumbnail_size ); ?>
      <?php if ( 'parts' === $settings->link_type ) : ?></a><?php endif; ?>
    </div>

    <<?= tag_escape( $settings->post_title_tag ); ?> class="<?= esc_attr( $module->classes( 'title' ) ); ?>">
      <?php if ( 'parts' === $settings->link_type ) : ?><a href="<?= get_the_permalink( $settings->post ); ?>" class="<?= esc_attr( $module->classes( 'permalink' ) ); ?>"><?php endif; ?>
      <?= get_the_title( $settings->post ); ?>
      <?php if ( 'parts' === $settings->link_type ) : ?></a><?php endif; ?>
    </<?= tag_escape( $settings->post_title_tag ); ?>>

    <?php if ( 'yes' === $settings->include_meta ) : ?>
      <div class="<?= esc_attr( $module->classes( 'meta' ) ); ?>">

        <?php if ( 'yes' === $settings->include_meta_date ) : ?>
          <div class="<?= esc_attr( $module->classes( 'date' ) ); ?>">
            <?= get_the_date( '', $settings->post ); ?>
          </div>
        <?php endif; ?>

        <?php if ( 'yes' === $settings->include_meta_author ) : ?>
          <div class="<?= esc_attr( $module->classes( 'author' ) ); ?>">
            <?= get_the_author_meta( 'display_name', $settings->post->post_author ); ?>
          </div>
        <?php endif; ?>

      </div>
    <?php endif; ?>

    <?php if ( 'yes' === $settings->include_excerpt ) : ?>
      <div class="<?= esc_attr( $module->classes( 'excerpt' ) ); ?>">
        <?= get_the_excerpt( $settings->post ); ?>
      </div>
    <?php endif; ?>

    <?php if ( !empty( $settings->more_text ) ) : ?>
      <div class="<?= esc_attr( $module->classes( 'more' ) ); ?>">
        <?php if ( 'parts' === $settings->link_type ) : ?><a href="<?= get_the_permalink( $settings->post ); ?>" class="<?= esc_attr( $module->classes( 'permalink' ) ); ?>"><?php endif; ?>
        <?= $settings->more_text; ?>
        <?php if ( 'parts' === $settings->link_type ) : ?></a><?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if ( 'block' === $settings->link_type ) : ?>
      </a>
    <?php endif; ?>

  </div>

<?php endif; ?>