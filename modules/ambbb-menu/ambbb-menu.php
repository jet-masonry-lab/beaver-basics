<?php

/**
 * @class ambbbMenuModule
 */
class ambbbMenuModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Menu', 'amb-beaver-basics' ),
      'description' => __( 'WordPress built-in nav menu from function `wp_nav_menu()`.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Input', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }

  public static function _get_menu_options() {
    $found_menus = wp_get_nav_menus( [
      'hide_empty' => true,
    ] );
    $menu_options = [];
    if ( $found_menus ) {
      foreach ( $found_menus as $key => $menu ) {
        $menu_options[ $menu->slug ] = $menu->name;
      }
      return $menu_options;
    } else {
      return [
        '' => __( 'No Menus Found', 'amb-beaver-basics' ),
      ];
    }
  }
}

// Register the module
FLBuilder::register_module( 'ambbbMenuModule', [
  'general' => [
    'title' => __( 'General', 'amb-beaver-basics' ),
    'sections' => [
      'general' => [
        'title' => '',
        'fields' => [
          'menu' => [
            'type' => 'select',
            'label' => __( 'Menu', 'amb-beaver-basics' ),
            'helper' => __( 'Select a WordPress menu that you created in the admin under Appearance > Menus.', 'amb-beaver-basics' ),
            'options' => ambbbMenuModule::_get_menu_options(),
          ],
        ],
      ],
    ],
  ],
] );

