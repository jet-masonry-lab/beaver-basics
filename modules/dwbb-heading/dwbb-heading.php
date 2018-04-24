<?php

/**
 * @class DWBBHeadingModule
 */
class DWBBHeadingModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'            => 'Heading',
      'description'     => 'A simple heading, no style options.',
      'group'           => 'Beaver Basics',
      'category'        => 'Basic',
      'dir'             => plugin_dir_path( __FILE__ ),
      'url'             => plugins_url( '/', __FILE__ )
    ));
  }
}

// Register the module
FLBuilder::register_module( 'DWBBHeadingModule', array(
  'general' => array(
    'title'     => __( 'General', 'dw-beaver-basics' ),
    'sections'  => array(
      'general'   => array(
        'title'         => '',
        'fields'        => array(
          'content'        => array(
            'type'            => 'text',
            'label'           => __( 'Content', 'dw-beaver-basics' ),
            'default'         => ''
          ),
          'tag'           => array(
            'type'          => 'select',
            'label'         => __( 'HTML Tag', 'dw-beaver-basics' ),
            'default'       => 'h2',
            'options'       => array(
              'h1'            => 'h1',
              'h2'            => 'h2',
              'h3'            => 'h3',
              'h4'            => 'h4',
              'h5'            => 'h5',
              'h6'            => 'h6',
            )
          )
        )
      )
    )
  )
) );

