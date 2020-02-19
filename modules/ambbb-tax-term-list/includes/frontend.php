<?php
// receives:
// - $module
// - $id
// - $settings

$terms = get_terms( array(
  'taxonomy' => $settings->taxonomy,
  'hide_empty' => $settings->hide_empty,
  'link' => $settings->hide_empty,
  'orderby' => $settings->orderby,
  'order' => $settings->order
) );
?>

<?php if ( is_wp_error( $terms ) ) : ?>
  Taxonomy not found.
<?php elseif ( count( $terms ) ) : ?>
  <ul class="<?= esc_attr( $module->classes() ); ?>">
    <?php foreach ( $terms as $term ) : ?>
      <li class="<?= esc_attr( $module->classes( 'item', $term ) ); ?>">
        <?php if ( $settings->link ) : ?>
          <a class="<?= esc_attr( $module->classes( 'link', $term ) ); ?>" href="<?= get_term_link( $term, $settings->taxonomy ); ?>">
        <?php endif; ?>
        <span class="<?= esc_attr( $module->classes( 'name', $term ) ); ?>"><?= $term->name; ?></span>
        <?php if ( $settings->description ) : ?>
          <span class="<?= esc_attr( $module->classes( 'description', $term ) ); ?> c-tax-term-list__term__decription"><?= $term->description; ?></span>
        <?php endif; ?>
        <?php if ( $settings->count ) : ?>
          <span class="<?= esc_attr( $module->classes( 'count', $term ) ); ?> c-tax-term-list__term__count"><?= $term->count; ?></span>
        <?php endif; ?>
        <?php if ( $settings->link ) : ?>
          </a>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>