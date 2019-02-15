<?php
// receives:
// - $module
// - $id
// - $settings
?>

<?php
  $quote_citation = $settings->cite ? sprintf( 'cite="%s"', esc_url( $settings->cite ) ) : '';
  $attribution_link_open = '';
  $attribution_link_close = '';
  if ( $settings->cite ) {
    $attribution_link_open = sprintf( '<a href="%s">', esc_url( $settings->cite ) );
    $attribution_link_close = '</a>';
  }
?>

<figure class="c-quote">
  <blockquote class="c-quote__body" <?php echo $quote_citation; ?>>
    <?php echo $settings->quote; ?>
  </blockquote>
  <figcaption class="c-quote__attribution">
    <?php echo $attribution_link_open; ?>
      <?php echo esc_html( $settings->attribution ); ?>
    <?php echo $attribution_link_close; ?>
  </figcaption>
</figure>
