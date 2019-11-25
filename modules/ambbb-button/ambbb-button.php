<?php

/**
 * @class ambbbButtonModule
 */
class ambbbButtonModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Button', 'amb-beaver-basics' ),
      'description' => __( 'A simple button, no style options.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'Input', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }

  public function buttonClasses()
  {
    return $this->classesString( ['button'] );
  }

  public function textClasses()
  {
    return $this->classesString( ['button__text'] );
  }
}

// Register the module
FLBuilder::register_module( 'ambbbButtonModule', [
  'general' => [
    'title' => __( 'General', 'amb-beaver-basics' ),
    'sections' => [
      'general' => [
        'title' => '',
        'fields' => [
          'text' => [
            'type' => 'text',
            'label' => __( 'Text', 'amb-beaver-basics' ),
            'default' => __( 'Click Here', 'amb-beaver-basics' ),
            'preview' => [
              'type' => 'text',
              'selector' => '.fl-button-text',
            ],
            'connections' => [ 'string' ],
          ],
          'link' => [
            'type' => 'link',
            'label' => __( 'Link', 'amb-beaver-basics' ),
            'placeholder' => __( 'http://www.example.com', 'amb-beaver-basics' ),
            'preview' => [
              'type' => 'none',
            ],
            'connections' => [ 'url' ],
          ],
          'link_target' => [
            'type' => 'select',
            'label' => __( 'Link Target', 'amb-beaver-basics' ),
            'default' => '_self',
            'options' => [
              '_self' => __( 'Same Window', 'amb-beaver-basics' ),
              '_blank' => __( 'New Window', 'amb-beaver-basics' ),
            ],
            'preview' => [
              'type' => 'none',
            ],
          ],
        ],
      ],
    ],
  ],
] );