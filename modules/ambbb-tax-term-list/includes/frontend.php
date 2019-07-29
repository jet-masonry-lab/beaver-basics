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
  <ul class="c-tax-term-list">
    <?php foreach ( $terms as $term ) : ?>
      <li class="c-tax-term-list__term c-tax-term-list__term--<?= $term->slug; ?> <?= ( $settings->link ? 'c-tax-term-list__term--linked' : '' ); ?>">
        <?php if ( $settings->link ) : ?>
          <a href="<?= get_term_link( $term, $settings->taxonomy ); ?>">
        <?php endif; ?>
        <span class="c-tax-term-list__term__name"><?= $term->name; ?></span>
        <?php if ( $settings->description ) : ?>
          <span class="c-tax-term-list__term__decription"><?= $term->description; ?></span>
        <?php endif; ?>
        <?php if ( $settings->count ) : ?>
          <span class="c-tax-term-list__term__count"><?= $term->count; ?></span>
        <?php endif; ?>
        <?php if ( $settings->link ) : ?>
          </a>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>