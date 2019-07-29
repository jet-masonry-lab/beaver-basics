<?php

/**
 * @class ambbbPostModule
 */
class ambbbPostModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Post', 'amb-beaver-basics' ),
      'description' => __( 'A simple post, no style options.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }

  public static function get_public_post_types()
  {
    return array_keys(
      get_post_types(
        [
          'public' => true,
          'publicly_queryable' => true,
          'exclude_from_search' => false
        ]
      )
    );
  }
}

// Register the module
FLBuilder::register_module( 'ambbbPostModule', [
  'content' => [
    'title' => __( 'Content', 'amb-beaver-basics' ),
    'sections' => [
      'content' => [
        'title' => '',
        'fields' => [

          'post' => [
            'type' => 'suggest',
            'label' => __( 'Post', 'amb-beaver-basics' ),
            'action' => 'fl_as_posts',
            'data' => ambbbPostModule::get_public_post_types(),
            'limit' => 1
          ],

        ],
      ],
      'display' => [
        'title' => __( 'Display', 'amb-beaver-basics' ),
        'fields' => [

          'include_meta' => [
            'type' => 'button-group',
            'label' => __( 'Include Meta', 'amb-beaver-basics' ),
            'default' => 'no',
            'options' => [
              'yes' => 'Yes',
              'no' => 'No',
            ],
            'toggle' => [
              'yes' => [ 'fields' => [ 'include_meta_date', 'include_meta_author' ], ],
              'no' => [ 'fields' => [], ],
            ],
          ],

          'include_meta_date' => [
            'type' => 'button-group',
            'label' => __( 'Include Date', 'amb-beaver-basics' ),
            'default' => 'no',
            'options' => [
              'yes' => 'Yes',
              'no' => 'No',
            ],
          ],

          'include_meta_author' => [
            'type' => 'button-group',
            'label' => __( 'Include Author', 'amb-beaver-basics' ),
            'default' => 'no',
            'options' => [
              'yes' => 'Yes',
              'no' => 'No',
            ],
          ],

          'include_excerpt' => [
            'type' => 'button-group',
            'label' => __( 'Include Excerpt', 'amb-beaver-basics' ),
            'default' => 'yes',
            'options' => [
              'yes' => 'Yes',
              'no' => 'No',
            ],
          ],

        ],
      ],
      'link' => [
        'title' => __( 'Link', 'amb-beaver-basics' ),
        'fields' => [

          'more_text' => [
            'type' => 'text',
            'label' => __( 'More Text', 'amb-beaver-basics' ),
            'default' => '',
            'placeholder' => __( 'Read More', 'amb-beaver-basics' ),
            'connections' => [ 'string' ],
          ],

        ],
      ],
    ],
  ],

  'structure' => [
    'title' => __( 'Structure', 'amb-beaver-basics' ),
    'sections' => [
      'structure' => [
        'title' => '',
        'fields' => [

          'thumbnail_size' => [
            'type' => 'photo-sizes',
            'label' => __( 'Thumbnail Size', 'amb-beaver-basics' ),
            'default' => 'medium',
          ],

          'post_title_tag' => [
            'type' => 'select',
            'label' => __( 'Post Title Tag', 'amb-beaver-basics' ),
            'default' => 'h3',
            'options' => [
              'h1' => 'h1',
              'h2' => 'h2',
              'h3' => 'h3',
              'h4' => 'h4',
              'h5' => 'h5',
              'h6' => 'h6',
            ],
          ],

          'link_type' => [
            'type' => 'button-group',
            'label' => __( 'Link Type', 'amb-beaver-basics' ),
            'default' => 'block',
            'options' => [
              'block' => 'Block',
              'parts' => 'Parts',
            ],
            'description' => __( 'Choosing "Parts" will make the thumbnail, title and optional "More Text" into links.', 'amb-beaver-basics' ),
          ],

        ],
      ],
    ],
  ],
] );
