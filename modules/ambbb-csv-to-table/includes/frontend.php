<?php
// receives:
// - $module
// - $id
// - $settings
?>

<?php if ( !empty( $settings->source ) ) : ?>
  <table class="<?= esc_attr( $module->classes() ); ?> o-table">
    <?php $rows = $module->rows( $settings->source ); ?>
    <?php foreach ( $rows as $ri => $row ) : ?>

      <?php if ( $module->isHeadRow( $ri ) ) : ?>
        <thead class="<?= esc_attr( $module->classes( 'head' ) ); ?>">
      <?php elseif ( $module->isFirstBodyRow( $ri ) ) : ?>
        <tbody class="<?= esc_attr( $module->classes( 'body' ) ); ?>">
      <?php endif; ?>

      <tr class="<?= esc_attr( $module->classes( 'row' ) ); ?>">
        <?php $cells = $module->cells( $row ); ?>
        <?php foreach ( $cells as $ci => $cell ) : ?>
          <?php
            if ( $module->isHeadRow( $ri ) ) {
              $th_scope = 'col';
              $module->setColClass( $ci, $cell );
            } else if ( $module->isHeadCol( $ci ) ) {
              $th_scope = 'row';
              $module->setRowClass( $ri, $cell );
            }
          ?>
          <?php if ( !empty( $th_scope ) ) : ?>
            <th scope="<?= $th_scope; ?>" class="<?= esc_attr( $module->classes( 'header' ) ); ?> o-table__<?= $module->getCellClasses( $ri, $ci ); ?>"><?= $cell; ?></th>
          <?php else : ?>
            <td class="<?= esc_attr( $module->classes( 'data' ) ); ?> o-table__<?= $module->getCellClasses( $ri, $ci ); ?>"><?= $module->formatCellContent( $cell ); ?></td>
          <?php endif; ?>
          <?php unset( $th_scope ); ?>
        <?php endforeach; ?>
      </tr>

      <?php if ( $module->isHeadRow( $ri ) ) : ?>
        </thead>
      <?php elseif ( $module->isLastBodyRow( $ri ) ) : ?>
        </tbody>
      <?php endif; ?>

    <?php endforeach; ?>
  </table>
<?php endif; ?>