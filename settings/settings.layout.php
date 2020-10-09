<?php

class ambbbFlexSettings
{
  public static function is_flex_container( $node )
  {
    return 'flex' === $node->settings->display;
  }

  public static function is_flex_item( $node )
  {
    do {
      $node = FLBuilderModel::get_node( $node->parent );
    } while ( 'column-group' === $node->type );
    return 'flex' === $node->settings->display;
  }

  public static function add_flex_settings_tab( $tabs )
  {
    if ( !isset( $tabs['flex'] ) ) {
      if ( isset( $tabs['advanced'] ) ) {
        $advanced = $tabs['advanced'];
        unset( $tabs['advanced'] );
      }
      $tabs['flex'] = [
        'title' => __( 'Flexbox', 'amb-beaver-basics' ),
        'sections' => [],
      ];
      if ( isset( $advanced ) ) {
        $tabs['advanced'] = $advanced;
      }
    }
    return $tabs;
  }

  public static function add_flex_container_settings( $tabs )
  {
    if ( isset( $tabs['flex'] ) ) {
      $tabs['flex']['sections']['flex_container'] = [
        'title' => __( 'Flex Container', 'amb-beaver-basics' ),
        'fields' => [

          'display' => [
            'type' => 'button-group',
            'label' => __( 'Flex Container', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'No', 'amb-beaver-basics' ),
              'flex' => __( 'Yes', 'amb-beaver-basics' ),
            ],
            'toggle' => ['flex'=>['fields'=>['align-content', 'align-items', 'flex-direction', 'justify-content']]],
          ],

          'flex-direction' => [
            'type' => 'select',
            'label' => __( 'Flex Direction', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'Default', 'amb-beaver-basics' ),
              'row' => __( 'Row', 'amb-beaver-basics' ),
              'row-reverse' => __( 'Row Reverse', 'amb-beaver-basics' ),
              'column' => __( 'Column', 'amb-beaver-basics' ),
              'column-reverse' => __( 'Column Reverse', 'amb-beaver-basics' ),
            ],
            'responsive' => ['default'=>['default'=>'','medium'=>'','responsive'=>'']],
          ],

          'justify-content' => [
            'type' => 'select',
            'label' => __( 'Justify Content', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'Default', 'amb-beaver-basics' ),
              'flex-start' => __( 'Flex Start', 'amb-beaver-basics' ),
              'flex-end' => __( 'Flex End', 'amb-beaver-basics' ),
              'center' => __( 'Center', 'amb-beaver-basics' ),
              'space-between' => __( 'Space Between', 'amb-beaver-basics' ),
              'space-around' => __( 'Space Around', 'amb-beaver-basics' ),
            ],
            'responsive' => true,
          ],

          'align-items' => [
            'type' => 'select',
            'label' => __( 'Align Items', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'Default', 'amb-beaver-basics' ),
              'flex-start' => __( 'Flex Start', 'amb-beaver-basics' ),
              'flex-end' => __( 'Flex End', 'amb-beaver-basics' ),
              'center' => __( 'Center', 'amb-beaver-basics' ),
              'stretch' => __( 'Stretch', 'amb-beaver-basics' ),
              'baseline' => __( 'Baseline', 'amb-beaver-basics' ),
            ],
            'responsive' => true,
          ],

          'align-content' => [
            'type' => 'select',
            'label' => __( 'Align Content', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'Default', 'amb-beaver-basics' ),
              'flex-start' => __( 'Flex Start', 'amb-beaver-basics' ),
              'flex-end' => __( 'Flex End', 'amb-beaver-basics' ),
              'center' => __( 'Center', 'amb-beaver-basics' ),
              'stretch' => __( 'Stretch', 'amb-beaver-basics' ),
              'space-between' => __( 'Space Between', 'amb-beaver-basics' ),
              'space-around' => __( 'Space Around', 'amb-beaver-basics' ),
            ],
            'responsive' => true,
          ],

        ],
      ];
    }
    return $tabs;
  }

  public static function add_flex_item_settings( $tabs )
  {
    if ( isset( $tabs['flex'] ) ) {
      $tabs['flex']['sections']['flex_item'] = [
        'title' => __( 'Flex Item', 'amb-beaver-basics' ),
        'fields' => [

          'align-self' => [
            'type' => 'select',
            'label' => __( 'Align Self', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'Default', 'amb-beaver-basics' ),
              'stretch' => __( 'Stretch', 'amb-beaver-basics' ),
              'center' => __( 'Center', 'amb-beaver-basics' ),
              'flex-start' => __( 'Flex Start', 'amb-beaver-basics' ),
              'flex-end' => __( 'Flex End', 'amb-beaver-basics' ),
              'baseline' => __( 'Baseline', 'amb-beaver-basics' ),
              'none' => __( 'None', 'amb-beaver-basics' ),
              'auto' => __( 'Auto', 'amb-beaver-basics' ),
            ],
            'responsive' => true,
          ],

          'order' => [
            'type' => 'unit',
            'label' => __( 'Order', 'amb-beaver-basics' ),
            'responsive' => true,
          ],

          // TODO: provide guidance on how to emulate flex:none, flex:auto, etc

          'flex-grow' => [
            'type' => 'unit',
            'label' => __( 'Flex Grow', 'amb-beaver-basics' ),
            'responsive' => true,
          ],

          'flex-shrink' => [
            'type' => 'unit',
            'label' => __( 'Flex Shrink', 'amb-beaver-basics' ),
            'responsive' => true,
          ],

          // TODO: this should toggle the unit field below, but it's not working

          'flex-basis' => [
            'type' => 'select',
            'label' => __( 'Flex Basis', 'amb-beaver-basics' ),
            'default' => 'unit',
            'options' => [
              'unit' => __( 'Value…', 'amb-beaver-basics' ),
              'auto' => __( 'Auto', 'amb-beaver-basics' ),
              'fill' => __( 'Fill', 'amb-beaver-basics' ),
              'max-content' => __( 'Max Content', 'amb-beaver-basics' ),
              'min-content' => __( 'Min Content', 'amb-beaver-basics' ),
              'fit-content' => __( 'Fit Content', 'amb-beaver-basics' ),
              'content' => __( 'Content', 'amb-beaver-basics' ),
            ],
            'responsive' => true,
          ],

          'flex-basis_unit' => [
            'type' => 'unit',
            'label' => __( 'Flex Basis Value', 'amb-beaver-basics' ),
            'units' => [ '%', 'px', 'em', 'rem', 'vh', 'vw', 'vmin', 'vmax' ],
            'default_unit' => '%',
            'responsive' => true,
          ],

        ],
      ];

    }
    return $tabs;
  }

  public static function add_flex_row_info( $tabs )
  {
    if ( isset( $tabs['flex'] ) ) {
      $tabs['flex']['sections'] = array_merge(
        [
          'flex_info' => [
            'title' => '',
            'fields' => [
              'usage' => [
                'type' => 'raw',
                'label' => '',
                'content' => __( '<p><strong>Usage:</strong> Setting a row as a flex container makes each column (.fl-col) a flex child.</p>', 'amb-beaver-basics' ),
              ],
            ],
          ],
        ],
        $tabs['flex']['sections']
      );
    }
    return $tabs;
  }

  public static function add_flex_col_info( $tabs )
  {
    if ( isset( $tabs['flex'] ) ) {
      $tabs['flex']['sections'] = array_merge(
        [
          'flex_info' => [
            'title' => '',
            'fields' => [
              'usage' => [
                'type' => 'raw',
                'label' => '',
                'content' => __( '<p><strong>Usage:</strong> Setting a column as a flex container makes each module (.fl-module) a flex child.</p>', 'amb-beaver-basics' ),
              ],
            ],
          ],
        ],
        $tabs['flex']['sections']
      );
    }
    return $tabs;
  }

  public static function add_flex_module_info( $tabs )
  {
    if ( isset( $tabs['flex'] ) ) {
      $tabs['flex']['sections'] = array_merge(
        [
          'flex_info' => [
            'title' => '',
            'fields' => [
              'usage' => [
                'type' => 'raw',
                'label' => '',
                'content' => __( '<p><strong>Usage:</strong> Setting a module as flex container applies flexbox layout to .fl-module-content and its children.</p>', 'amb-beaver-basics' ),
              ],
            ],
          ],
        ],
        $tabs['flex']['sections']
      );
    }
    return $tabs;
  }

  public static function add_flex_settings( $form, $id )
  {
    // Modules don't have 'tabs' defined at the top level
    // The only forms we want to filter that DO have 'tabs'
    // Are the row and col forms...

    if (
      isset( $form['tabs'] )
    ) {
      // for rows and cols (and other misc forms), 'tabs' is a sub-array
      if ( 'row' === $id ) {
        $form['tabs'] = self::add_flex_settings_tab( $form['tabs'] );
        $form['tabs'] = self::add_flex_container_settings( $form['tabs'] );
        $form['tabs'] = self::add_flex_row_info( $form['tabs'] );
      } else if ( 'col' === $id ) {
        $form['tabs'] = self::add_flex_settings_tab( $form['tabs'] );
        $form['tabs'] = self::add_flex_container_settings( $form['tabs'] );
        // TODO: add item settings only if parent is a flex container
        $form['tabs'] = self::add_flex_item_settings( $form['tabs'] );
        $form['tabs'] = self::add_flex_col_info( $form['tabs'] );
      }

    } else if (
      !isset( $form['tabs'] )
      && 'module_advanced' !== $id
    ) {
      // for modules, the whole array is 'tabs'
      $form = self::add_flex_settings_tab( $form );
      $form = self::add_flex_container_settings( $form );
      // TODO: add item settings only if parent is a flex container
      $form = self::add_flex_item_settings( $form );
      $form = self::add_flex_module_info( $form );

    }

    return $form;
  }

  public static function get_custom_property_value( $node, $setting_name, $breakpoint )
  {
    $setting_suffix = $breakpoint === 'default' ? '' : "_$breakpoint";
    $value = $node->settings->{ $setting_name . $setting_suffix };
    if ( 'unit' === $value ) {
      $value = $node->settings->{ $setting_name . '_unit' . $setting_suffix };
    }
    return $value;
  }

  public static function get_responsive_css_custom_properties( $node, $properties )
  {
    $css_output = '';
    $selector = ".fl-node-{$node->node}";
    $property_prefix = "ambbb-fl-{$node->type}__";

    // START: BREAKPOINT LOOP
    foreach ( ['default','medium','responsive'] as $breakpoint ) {
      $css_ruleset = '';
      $media_query_value = FLBuilderCSS::media_value( $breakpoint );

      // START: PROPERTIES LOOP
      foreach( $properties as $property_name ) {

        $property_value = self::get_custom_property_value( $node, $property_name, $breakpoint );

        if ( !empty( $property_value ) ) {
          $css_ruleset .= sprintf(
            '--%s%s:%s;',
            $property_prefix,
            $property_name,
            $property_value
          );
        }
      }
      // END: PROPERTIES LOOP

      // wrap in selector (e.g. .fl-node-123 {} )
      if ( !empty( $css_ruleset ) ) {
        $css_ruleset = sprintf(
          '%s{%s}',
          $selector,
          $css_ruleset
        );
      }

      // optionally wrap in media query (e.g. @media() {} )
      if (
        !empty( $media_query_value )
        && !empty( $css_ruleset )
      ) {
        $css_ruleset = sprintf(
          "@media (%s) {%s}",
          $media_query_value,
          $css_ruleset
        );
      }

      $css_output .= $css_ruleset;
    }
    // END: BREAKPOINT LOOP

    return $css_output;
  }

  public static function get_flex_container_css( $node )
  {
    return self::get_responsive_css_custom_properties(
      $node,
      ['flex-direction', 'justify-content', 'align-items', 'align-content' ]
    );
  }

  public static function get_flex_item_css( $node )
  {
    return self::get_responsive_css_custom_properties(
      $node,
      ['align-self', 'order', 'flex-grow', 'flex-shrink', 'flex-basis']
    );
  }

  public static function add_row_flexbox_classes( $attrs, $row )
  {
    if ( self::is_flex_container( $row ) ) {
      $attrs['class'][] = 'ambbb-fl-row--flex-container';
    }
    return $attrs;
  }

  public static function add_column_flexbox_classes( $attrs, $column )
  {
    if ( self::is_flex_container( $column ) ) {
      $attrs['class'][] = 'ambbb-fl-col--flex-container';
    }
    if ( self::is_flex_item( $column ) ) {
      $attrs['class'][] = 'ambbb-fl-col--flex-item';
    }
    return $attrs;
  }

  public static function add_module_flexbox_classes( $attrs, $module )
  {
    if ( self::is_flex_container( $module ) ) {
      $attrs['class'][] = 'ambbb-fl-module--flex-container';
    }
    if ( self::is_flex_item( $module ) ) {
      $attrs['class'][] = 'ambbb-fl-module--flex-item';
    }
    return $attrs;
  }

  public static function add_flexbox_css( $css, $nodes, $global_settings, $include_global )
  {
    foreach ( $nodes['rows'] as $row ) {
      if ( self::is_flex_container( $row ) ) {
        $css .= self::get_flex_container_css( $row );
      }
    }
    foreach ( $nodes['columns'] as $column ) {
      if ( self::is_flex_container( $column ) ) {
        $css .= self::get_flex_container_css( $column );
      }
      if ( self::is_flex_item( $column ) ) {
        $css .= self::get_flex_item_css( $column );
      }
    }
    foreach ( $nodes['modules'] as $module ) {
      if ( self::is_flex_container( $module ) ) {
        $css .= self::get_flex_container_css( $module );
      }
      if ( self::is_flex_item( $module ) ) {
        $css .= self::get_flex_item_css( $module );
      }
    }
    return $css;
  }

  public static function init()
  {
    // Settings for rows, columns and modules
    // add_filter( 'fl_builder_register_settings_form', [__CLASS__, 'add_flex_settings'], 10, 2 );

    // Modify attributes for rows, columns and modules
    add_filter( 'fl_builder_row_attributes', [__CLASS__, 'add_row_flexbox_classes'], 10, 2 );
    add_filter( 'fl_builder_column_attributes', [__CLASS__, 'add_column_flexbox_classes'], 10, 2 );
    add_filter( 'fl_builder_module_attributes', [__CLASS__, 'add_module_flexbox_classes'], 10, 2 );

    // Add to the rendered CSS
    add_filter( 'fl_builder_render_css', [__CLASS__, 'add_flexbox_css'], 10, 4 );

  }
}
ambbbFlexSettings::init();

