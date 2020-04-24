<?php

/**
 * @class ambbbSeparatorModule
 */
class ambbbSeparatorModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Separator', 'amb-beaver-basics' ),
      'description' => __( 'An empty module, with opitonal <hr> tag.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }
}

// Register the module
FLBuilder::register_module( 'ambbbSeparatorModule', [
  'general' => [
    'title' => __( 'General', 'amb-beaver-basics' ),
    'sections' => [
      'general' => [
        'title' => '',
        'fields' => [
          'hr' => [
            'type' => 'button-group',
            'label' => __( 'Include &lt;hr&gt; Tag?', 'amb-beaver-basics' ),
            'default' => 1,
            'options' => [
              0 => __( 'No', 'amb-beaver-basics' ),
              1 => __( 'Yes', 'amb-beaver-basics' ),
            ],
          ],
        ],
      ],
    ],
  ],
] );

