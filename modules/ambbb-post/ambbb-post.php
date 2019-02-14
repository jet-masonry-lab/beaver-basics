<?php

/**
 * @class ambbbPostModule
 */
class ambbbPostModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'            => __( 'Post', 'amb-beaver-basics' ),
      'description'     => __( 'A simple post, no style options.', 'amb-beaver-basics' ),
      'group'           => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'        => __( 'Basic', 'amb-beaver-basics' ),
      'dir'             => plugin_dir_path( __FILE__ ),
      'url'             => plugins_url( '/', __FILE__ )
    ));
  }
}

// Register the module
FLBuilder::register_module( 'ambbbPostModule', array() );