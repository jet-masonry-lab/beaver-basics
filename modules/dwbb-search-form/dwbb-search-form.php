<?php

/**
 * @class DWBBSearchFormModule
 */
class DWBBSearchFormModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'            => 'Search Form',
      'description'     => 'WordPress built-in search form from function `get_search_form()`.',
      'group'           => 'Beaver Basics',
      'category'        => 'Basic',
      'dir'             => plugin_dir_path( __FILE__ ),
      'url'             => plugins_url( '/', __FILE__ )
    ));
  }
}

// Register the module
FLBuilder::register_module( 'DWBBSearchFormModule', array() );