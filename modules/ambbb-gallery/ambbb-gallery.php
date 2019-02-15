<?php

/**
 * @class ambbbGalleryModule
 */
class ambbbGalleryModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'            => __( 'Gallery', 'amb-beaver-basics' ),
      'description'     => __( 'A simple gallery, no style options.', 'amb-beaver-basics' ),
      'group'           => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'        => __( 'Basic', 'amb-beaver-basics' ),
      'dir'             => plugin_dir_path( __FILE__ ),
      'url'             => plugins_url( '/', __FILE__ )
    ));
  }
}

// TODO: toggle columns on / off (if columns set to 0, no row breaks are included)
// https://codex.wordpress.org/Gallery_Shortcode

// Register the module
FLBuilder::register_module( 'ambbbGalleryModule', array(
  'general'       => array(
    'title'         => __( 'General', 'amb-beaver-basics' ),
    'sections'      => array(
      'content'       => array(
        'title'         => __( 'Gallery Content', 'amb-beaver-basics' ),
        'fields'        => array(
          'source'        => array(
            'type'         => 'select',
            'label'        => __( 'Which Images', 'amb-beaver-basics' ),
            'default'      => 'post',
            'options'       => array(
              'post'          => __( 'All images attached to a post', 'amb-beaver-basics' ),
              'custom'        => __( 'Specific images', 'amb-beaver-basics' ),
            ),
            'toggle'    => array(
              'post'      => array(
                'fields'   => array( 'post_id' ),
              ),
              'custom'    => array(
                'fields'    => array( 'images' ),
              )
            )
          ),
          'post_id'        => array(
            'type'          => 'unit',
            'label'         => __( 'Source Post ID', 'amb-beaver-basics' ),
            'description'   => '(defaults to current post)',
          ),
          'images'        => array(
            'type'          => 'multiple-photos',
            'label'         => __( 'Images', 'amb-beaver-basics' ),
            'connections'   => array( 'multiple-photos' ),
          ),
        )
      ),
      'structure'       => array(
        'title'         => __( 'Gallery Structure', 'amb-beaver-basics' ),
        'fields'        => array(
          'orderby'        => array(
            'type'         => 'select',
            'label'        => __( 'Order By', 'amb-beaver-basics' ),
            'default'      => 'menu_order',
            'options'       => array(
              'menu_order'    => __( 'Menu Order', 'amb-beaver-basics' ),
              'title'         => __( 'Title', 'amb-beaver-basics' ),
              'post_date'     => __( 'Post Date', 'amb-beaver-basics' ),
              'rand'          => __( 'Random', 'amb-beaver-basics' ),
              'ID'            => __( 'ID', 'amb-beaver-basics' ),
            ),
          ),
          'order'        => array(
            'type'         => 'select',
            'label'        => __( 'Sort Order', 'amb-beaver-basics' ),
            'default'      => 'ASC',
            'options'       => array(
              'ASC'           => __( 'Ascending', 'amb-beaver-basics' ),
              'DESC'          => __( 'Descending', 'amb-beaver-basics' ),
            ),
          ),
          'columns'      => array(
            'type'        => 'unit',
            'label'       => __( 'Columns', 'amb-beaver-basics' ),
            'description' => 'columns',
          ),
          'size'          => array(
            'type'          => 'photo-sizes',
            'label'         => __( 'Size', 'amb-beaver-basics' ),
            'default'       => 'medium'
          ),
          'link'          => array(
            'type'          => 'select',
            'label'         => __( 'Link', 'amb-beaver-basics' ),
            'default'       => 'none',
            'options'       => array(
              'none'           => __( 'None', 'amb-beaver-basics' ),
              'permalink'      => __( 'Permalink', 'amb-beaver-basics' ),
              'file'           => __( 'File', 'amb-beaver-basics' )
            ),
          ),
        )
      )
    )
  )
) );