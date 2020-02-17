<?php

class ambbbVariationSettings
{

  private static function add_variations_section( &$sections, $id )
  {
    // filter should receive an associative array
    // key = the part of css class that will be added after --
    // value = the label when choosing from the select field
    $variations = (array) apply_filters( "ambbb__{$id}_variations", [] );

    if ( is_array( $variations ) && !empty( $variations ) ) {

      $sections['variations'] = [
        'title' => __( 'Variations', 'amb-beaver-basics' ),
        'fields' => [
          'variations' => [
            'type' => 'select',
            'label' => __( 'CSS Class Variations', 'amb-beaver-basics' ),
            'options' => $variations,
            'multi-select' => true,
          ]
        ],
      ];

    }

  }


  public static function filter_form_settings( $form, $id )
  {
    // Modules don't have 'tabs' defined at the top level
    // The only forms we want to filter that DO have 'tabs'
    // Are the row and col forms...

    if (
      isset( $form['tabs'] )
      && in_array( $id, [ 'row', 'col'] )
    ) {
      // for rows and cols, 'tabs' is a sub-array
      $first_tab_key = array_keys( $form['tabs'] )[0];
      self::add_variations_section( $form['tabs'][$first_tab_key]['sections'], $id );

    } else if (
      !isset( $form['tabs'] )
      && 'module_advanced' !== $id
    ) {
      // for modules, the whole array is 'tabs'
      $first_tab_key = array_keys( $form )[0];
      self::add_variations_section( $form[$first_tab_key]['sections'], $id );

    }

    return $form;
  }


  // Isolate the valid and active variations
  private static function get_valid_variations( $filter, $obj )
  {
    $available_variations = (array) array_keys( apply_filters( $filter, [] ) );
    $selected_variations = (array) $obj->settings->variations;
    return array_intersect( $available_variations, $selected_variations );
  }


  // Add variation CSS classes to a provided array, using a provided pattern
  private static function add_variation_classes( $classes, $variations, $pattern )
  {
    foreach ( $variations as $v ) {
      $classes[] = sprintf(
        $pattern,
        esc_attr( $v )
      );
    }
    return $classes;
  }


  // Add selected variation classes to rows
  public static function add_row_variation_classes( $attrs, $row )
  {
    $active_variations = self::get_valid_variations( 'ambbb__row_variations', $row );
    $attrs['class'] = self::add_variation_classes( $attrs['class'], $active_variations, 'fl-row--%s' );
    return $attrs;
  }


  // Add selected variation classes to cols
  public static function add_col_variation_classes( $attrs, $col )
  {
    $active_variations = self::get_valid_variations( 'ambbb__col_variations', $col );
    $attrs['class'] = self::add_variation_classes( $attrs['class'], $active_variations, 'fl-col--%s' );
    return $attrs;
  }


  // Add selected variation classes to modules
  public static function add_module_variation_classes( $class, $module )
  {
    $active_variations = self::get_valid_variations( "ambbb__{$module->slug}_variations", $module );
    $pattern = sprintf(
      'fl-module-%s--%%s',
      esc_attr( $module->slug )
    );
    $classes = self::add_variation_classes( explode( ' ', $class ), $active_variations, $pattern );
    return implode( ' ', $classes );
  }


  public static function init()
  {
    // Filter form settings... either set context, or add UI to Advanced tab
    add_filter( 'fl_builder_register_settings_form', [__CLASS__, 'filter_form_settings'], 10, 2 );

    // Add row classes
    add_filter( 'fl_builder_row_attributes', [__CLASS__, 'add_row_variation_classes'], 10, 2 );

    // Add col classes
    add_filter( 'fl_builder_column_attributes', [__CLASS__, 'add_col_variation_classes'], 10, 2 );

    // Add module classes
    add_filter( 'fl_builder_module_custom_class', [__CLASS__, 'add_module_variation_classes'], 10, 2 );
  }

}
ambbbVariationSettings::init();


// add_filter( 'ambbb__row_variations', function( $variations ) {
//   return [
//     'row-var-1' => 'Row Var 1',
//     'row-var-2' => 'Row Var 2',
//     'row-var-3' => 'Row Var 3',
//   ];
// } );

// add_filter( 'ambbb__col_variations', function( $variations ) {
//   return [
//     'col-var-1' => 'Col Var 1',
//     'col-var-2' => 'Col Var 2',
//     'col-var-3' => 'Col Var 3',
//   ];
// } );

// add_filter( 'ambbb__html_variations', function( $variations ) {
//   return [
//     'html-var-1' => 'HTML Var 1',
//     'html-var-2' => 'HTML Var 2',
//     'html-var-3' => 'HTML Var 3',
//   ];
// } );
