<?php

/**
 * @class ambbbQueriedObjectModule
 */
class ambbbQueriedObjectModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Queried Object', 'amb-beaver-basics' ),
      'description' => __( 'A hookable action that passes only the queried object for the page.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Data', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }
}

// Register the module
FLBuilder::register_module( 'ambbbQueriedObjectModule', [
  'usage' => [
    'title' => __( 'Usage', 'amb-beaver-basics' ),
    'sections' => [
      'usage' => [
        'title' => '',
        'fields' => [
          'usage' => [
            'type' => 'raw',
            'label' => __( 'Usage', 'amb-beaver-basics' ),
            'content' => '<p>Hook into the action `ambbb_queried_object` to do something unique on the page.</p>',
          ],
        ],
      ],
    ],
  ],
] );

