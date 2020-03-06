<?php

/**
 * @class ambbbSliderModule
 */
class ambbbSliderModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Slider', 'amb-beaver-basics' ),
      'description' => __( 'A simple slider, structure only.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Media', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }
}

// Register the module
FLBuilder::register_module( 'ambbbSliderModule', [
  'content' => [
    'title' => __( 'Content', 'amb-beaver-basics' ),
    'sections' => [
      'content' => [
        'title' => '',
        'fields' => [

          'slides' => [
            'type' => 'form',
            'label' => __( 'Slide', 'amb-beaver-basics' ),
            'form' => 'ambbbSlideForm',
            'preview_text' => 'slide_name',
            'multiple' => true,
          ],

        ],
      ],
    ],
  ],
] );


FLBuilder::register_settings_form('ambbbSlideForm', [

  'title' => __( 'Add Slide', 'amb-beaver-basics' ),
  'tabs' => [

    'content' => [
      'title'=> '',
      'sections' => [

        'content' => [
          'title'  => '',
          'fields' => [

            'html' => [
              'type' => 'code',
              'label' => __( 'Slide Content', 'amb-beaver-basics' ),
              'editor' => 'html',
              'rows' => 8,
              'default' => '',
              'connections' => [ 'html' ],
              'preview' => [
                'type' => 'none'
              ],
            ],

          ],
        ],

      ],
    ],

  ],

] );
