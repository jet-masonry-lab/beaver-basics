<?php

/**
 * @class ambbbSearchFormModule
 */
class ambbbSearchFormModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Search Form', 'amb-beaver-basics' ),
      'description' => __( 'WordPress built-in search form from function `get_search_form()`.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Input', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }
}

// Register the module
FLBuilder::register_module( 'ambbbSearchFormModule', [] );