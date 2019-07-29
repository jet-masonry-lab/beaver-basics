<?php
// receives:
// - $module
// - $id
// - $settings
?>

<?php if ( !empty( $settings->post ) ) : ?>

  <div class="c-post">

    <?php if ( 'block' === $settings->link_type ) : ?>
      <a href="<?= get_the_permalink( $settings->post ); ?>" class="c-post__permalink">
    <?php endif; ?>

    <div class="c-post__thumbnail">
      <?php if ( 'parts' === $settings->link_type ) : ?><a href="<?= get_the_permalink( $settings->post ); ?>" class="c-post__permalink"><?php endif; ?>
      <?= get_the_post_thumbnail( $settings->post, $settings->thumbnail_size ); ?>
      <?php if ( 'parts' === $settings->link_type ) : ?></a><?php endif; ?>
    </div>

    <<?= $settings->post_title_tag; ?> class="c-post__title">
      <?php if ( 'parts' === $settings->link_type ) : ?><a href="<?= get_the_permalink( $settings->post ); ?>" class="c-post__permalink"><?php endif; ?>
      <?= get_the_title( $settings->post ); ?>
      <?php if ( 'parts' === $settings->link_type ) : ?></a><?php endif; ?>
    </<?= $settings->post_title_tag; ?>>

    <?php if ( 'yes' === $settings->include_meta ) : ?>
      <div class="c-post__meta">

        <?php if ( 'yes' === $settings->include_meta_date ) : ?>
          <div class="c-post__date">
            <?= get_the_date( '', $settings->post ); ?>
          </div>
        <?php endif; ?>

        <?php if ( 'yes' === $settings->include_meta_author ) : ?>
          <div class="c-post__author">
            <?= get_the_author_meta( 'display_name', $settings->post->post_author ); ?>
          </div>
        <?php endif; ?>

      </div>
    <?php endif; ?>

    <?php if ( 'yes' === $settings->include_excerpt ) : ?>
      <div class="c-post__excerpt">
        <?= get_the_excerpt( $settings->post ); ?>
      </div>
    <?php endif; ?>

    <?php if ( !empty( $settings->more_text ) ) : ?>
      <div class="c-post__more">
        <?php if ( 'parts' === $settings->link_type ) : ?><a href="<?= get_the_permalink( $settings->post ); ?>" class="c-post__permalink"><?php endif; ?>
        <?= $settings->more_text; ?>
        <?php if ( 'parts' === $settings->link_type ) : ?></a><?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if ( 'block' === $settings->link_type ) : ?>
      </a>
    <?php endif; ?>

  </div>

<?php endif; ?>