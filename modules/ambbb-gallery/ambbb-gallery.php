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
      'general'       => array(
        'title'         => '',
        'fields'        => array(
          'photos'        => array(
            'type'          => 'multiple-photos',
            'label'         => __( 'Photos', 'amb-beaver-basics' ),
            'connections'   => array( 'multiple-photos' ),
          ),
          'columns'       => array(
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