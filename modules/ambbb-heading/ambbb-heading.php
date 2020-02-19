<?php

/**
 * @class ambbbHeadingModule
 */
class ambbbHeadingModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Heading', 'amb-beaver-basics' ),
      'description' => __( 'A simple heading, no style options.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }
}

// Register the module
FLBuilder::register_module( 'ambbbHeadingModule', [
  'general' => [
    'title' => __( 'General', 'amb-beaver-basics' ),
    'sections' => [
      'general' => [
        'title' => '',
        'fields' => [
          'content' => [
            'type' => 'text',
            'label' => __( 'Content', 'amb-beaver-basics' ),
            'default' => '',
            'preview' => [
              'type' => 'text',
              'selector' => '.c-heading',
            ],
            'connections' => [ 'string' ],
          ],
          'tag' => [
            'type' => 'select',
            'label' => __( 'HTML Tag', 'amb-beaver-basics' ),
            'default' => 'h2',
            'options' => [
              'h1' => 'h1',
              'h2' => 'h2',
              'h3' => 'h3',
              'h4' => 'h4',
              'h5' => 'h5',
              'h6' => 'h6',
            ],
          ],
        ],
      ],
    ],
  ],
] );

