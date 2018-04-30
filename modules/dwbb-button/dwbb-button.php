<?php

/**
 * @class DWBBButtonModule
 */
class DWBBButtonModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'            => __( 'Button', 'dw-beaver-basics' ),
      'description'     => __( 'A simple button, no style options.', 'dw-beaver-basics' ),
      'group'           => __( 'Beaver Basics', 'dw-beaver-basics' ),
      'category'        => __( 'Basic', 'dw-beaver-basics' ),
      'dir'             => plugin_dir_path( __FILE__ ),
      'url'             => plugins_url( '/', __FILE__ )
    ));
  }
}

// Register the module
FLBuilder::register_module( 'DWBBButtonModule', array(
  'general'       => array(
    'title'         => __( 'General', 'fl-builder' ),
    'sections'      => array(
      'general'       => array(
        'title'         => '',
        'fields'        => array(
          'text'          => array(
            'type'          => 'text',
            'label'         => __( 'Text', 'fl-builder' ),
            'default'       => __( 'Click Here', 'fl-builder' ),
            'preview'         => array(
              'type'            => 'text',
              'selector'        => '.fl-button-text',
            ),
            'connections'         => array( 'string' ),
          ),
          'link'          => array(
            'type'          => 'link',
            'label'         => __( 'Link', 'fl-builder' ),
            'placeholder'   => __( 'http://www.example.com', 'fl-builder' ),
            'preview'       => array(
              'type'          => 'none',
            ),
            'connections'         => array( 'url' ),
          ),
          'link_target'   => array(
            'type'          => 'select',
            'label'         => __( 'Link Target', 'fl-builder' ),
            'default'       => '_self',
            'options'       => array(
              '_self'         => __( 'Same Window', 'fl-builder' ),
              '_blank'        => __( 'New Window', 'fl-builder' ),
            ),
            'preview'       => array(
              'type'          => 'none',
            ),
          )
        )
      )
    )
  )
) );