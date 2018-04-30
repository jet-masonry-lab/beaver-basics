<?php

/**
 * @class DWBBPostModule
 */
class DWBBPostModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'            => __( 'Post', 'dw-beaver-basics' ),
      'description'     => __( 'A simple post, no style options.', 'dw-beaver-basics' ),
      'group'           => __( 'Beaver Basics', 'dw-beaver-basics' ),
      'category'        => __( 'Basic', 'dw-beaver-basics' ),
      'dir'             => plugin_dir_path( __FILE__ ),
      'url'             => plugins_url( '/', __FILE__ )
    ));
  }
}

// Register the module
FLBuilder::register_module( 'DWBBPostModule', array() );