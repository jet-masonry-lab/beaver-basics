<?php

/**
 * @class ambbbMenuModule
 */
class ambbbMenuModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'            => __( 'Menu', 'amb-beaver-basics' ),
      'description'     => __( 'WordPress built-in nav menu from function `wp_nav_menu()`.', 'amb-beaver-basics' ),
      'group'           => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'        => __( 'Basic', 'amb-beaver-basics' ),
      'dir'             => plugin_dir_path( __FILE__ ),
      'url'             => plugins_url( '/', __FILE__ )
    ));
  }

  public static function _get_menu_options() {
    $found_menus = wp_get_nav_menus( array(
      'hide_empty' => true,
    ) );
    $menu_options = array();
    if ( $found_menus ) {
      foreach ( $found_menus as $key => $menu ) {
        $menu_options[ $menu->slug ] = $menu->name;
      }
      return $menu_options;
    } else {
      return array(
        '' => __( 'No Menus Found', 'fl-builder' ),
      );
    }
  }
}

// Register the module
FLBuilder::register_module( 'ambbbMenuModule', array(
  'general' => array(
    'title'     => __( 'General', 'amb-beaver-basics' ),
    'sections'  => array(
      'general'   => array(
        'title'         => '',
        'fields'        => array(
          'menu'          => array(
            'type'          => 'select',
            'label'         => __( 'Menu', 'amb-beaver-basics' ),
            'helper'        => __( 'Select a WordPress menu that you created in the admin under Appearance > Menus.', 'amb-beaver-basics' ),
            'options'       => ambbbMenuModule::_get_menu_options()
          )
        )
      )
    )
  )
) );

