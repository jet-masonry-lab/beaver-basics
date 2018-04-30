<?php

/**
 * @class DWBBSearchFormModule
 */
class DWBBSearchFormModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'            => __( 'Search Form', 'dw-beaver-basics' ),
      'description'     => __( 'WordPress built-in search form from function `get_search_form()`.', 'dw-beaver-basics' ),
      'group'           => __( 'Beaver Basics', 'dw-beaver-basics' ),
      'category'        => __( 'Basic', 'dw-beaver-basics' ),
      'dir'             => plugin_dir_path( __FILE__ ),
      'url'             => plugins_url( '/', __FILE__ )
    ));
  }
}

// Register the module
FLBuilder::register_module( 'DWBBSearchFormModule', array() );