<?php

/**
 * @class ambbbGalleryModule
 */
class ambbbGalleryModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Gallery', 'amb-beaver-basics' ),
      'description' => __( 'A simple gallery, no style options.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }
}

// TODO: toggle columns on / off (if columns set to 0, no row breaks are included)
// https://codex.wordpress.org/Gallery_Shortcode

// Register the module
FLBuilder::register_module( 'ambbbGalleryModule', [
  'general' => [
    'title' => __( 'General', 'amb-beaver-basics' ),
    'sections' => [
      'content' => [
        'title' => __( 'Gallery Content', 'amb-beaver-basics' ),
        'fields' => [
          'source' => [
            'type' => 'select',
            'label' => __( 'Which Images', 'amb-beaver-basics' ),
            'default' => 'post',
            'options' => [
              'post' => __( 'All images attached to a post', 'amb-beaver-basics' ),
              'custom' => __( 'Specific images', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              'post' => [
                'fields' => [ 'post_id' ],
              ],
              'custom' => [
                'fields' => [ 'images' ],
              ],
            ]
          ],
          'post_id' => [
            'type' => 'unit',
            'label' => __( 'Source Post ID', 'amb-beaver-basics' ),
            'description' => '(defaults to current post)',
          ],
          'images' => [
            'type' => 'multiple-photos',
            'label' => __( 'Images', 'amb-beaver-basics' ),
            'connections' => [ 'multiple-photos' ],
          ],
        ],
      ],
      'structure' => [
        'title' => __( 'Gallery Structure', 'amb-beaver-basics' ),
        'fields' => [
          'orderby' => [
            'type' => 'select',
            'label' => __( 'Order By', 'amb-beaver-basics' ),
            'default' => 'menu_order',
            'options' => [
              'menu_order' => __( 'Menu Order', 'amb-beaver-basics' ),
              'title' => __( 'Title', 'amb-beaver-basics' ),
              'post_date' => __( 'Post Date', 'amb-beaver-basics' ),
              'rand' => __( 'Random', 'amb-beaver-basics' ),
              'ID' => __( 'ID', 'amb-beaver-basics' ),
            ],
          ],
          'order' => [
            'type' => 'select',
            'label' => __( 'Sort Order', 'amb-beaver-basics' ),
            'default' => 'ASC',
            'options' => [
              'ASC' => __( 'Ascending', 'amb-beaver-basics' ),
              'DESC' => __( 'Descending', 'amb-beaver-basics' ),
            ],
          ],
          'columns' => [
            'type' => 'unit',
            'label' => __( 'Columns', 'amb-beaver-basics' ),
            'description' => 'columns',
          ],
          'size' => [
            'type' => 'photo-sizes',
            'label' => __( 'Size', 'amb-beaver-basics' ),
            'default' => 'medium'
          ],
          'link' => [
            'type' => 'select',
            'label' => __( 'Link', 'amb-beaver-basics' ),
            'default' => 'none',
            'options' => [
              'none' => __( 'None', 'amb-beaver-basics' ),
              'permalink' => __( 'Permalink', 'amb-beaver-basics' ),
              'file' => __( 'File', 'amb-beaver-basics' ),
            ],
          ],
        ],
      ],
    ],
  ],
] );