<?php

/**
 * @class DWBBGalleryModule
 */
class DWBBGalleryModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'            => __( 'Gallery', 'dw-beaver-basics' ),
      'description'     => __( 'A simple gallery, no style options.', 'dw-beaver-basics' ),
      'group'           => __( 'Beaver Basics', 'dw-beaver-basics' ),
      'category'        => __( 'Basic', 'dw-beaver-basics' ),
      'dir'             => plugin_dir_path( __FILE__ ),
      'url'             => plugins_url( '/', __FILE__ )
    ));
  }
}

// TODO: toggle columns on / off (if columns set to 0, no row breaks are included)
// https://codex.wordpress.org/Gallery_Shortcode

// Register the module
FLBuilder::register_module( 'DWBBGalleryModule', array(
  'general'       => array(
    'title'         => __( 'General', 'dw-beaver-basics' ),
    'sections'      => array(
      'general'       => array(
        'title'         => '',
        'fields'        => array(
          'photos'        => array(
            'type'          => 'multiple-photos',
            'label'         => __( 'Photos', 'dw-beaver-basics' ),
            'connections'   => array( 'multiple-photos' ),
          ),
          'columns'       => array(
            'type'        => 'unit',
            'label'       => __( 'Columns', 'dw-beaver-basics' ),
            'description' => 'columns',
          ),
          'size'          => array(
            'type'          => 'photo-sizes',
            'label'         => __( 'Size', 'dw-beaver-basics' ),
            'default'       => 'medium'
          ),
          'link'          => array(
            'type'          => 'select',
            'label'         => __( 'Link', 'dw-beaver-basics' ),
            'default'       => 'none',
            'options'       => array(
              'none'           => __( 'None', 'dw-beaver-basics' ),
              'permalink'      => __( 'Permalink', 'dw-beaver-basics' ),
              'file'           => __( 'File', 'dw-beaver-basics' )
            ),
          ),
        )
      )
    )
  )
) );