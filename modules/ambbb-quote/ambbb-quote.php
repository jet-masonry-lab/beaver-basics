<?php

/**
 * @class ambbbQuoteModule
 */
class ambbbQuoteModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'            => __( 'Quote', 'amb-beaver-basics' ),
      'description'     => __( 'A simple quote, no style options.', 'amb-beaver-basics' ),
      'group'           => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'        => __( 'Basic', 'amb-beaver-basics' ),
      'dir'             => plugin_dir_path( __FILE__ ),
      'url'             => plugins_url( '/', __FILE__ )
    ));
  }
}

// Register the module
FLBuilder::register_module( 'ambbbQuoteModule', array(
  'general' => array(
    'title'     => __( 'General', 'amb-beaver-basics' ),
    'sections'  => array(
      'general'   => array(
        'title'         => '',
        'fields'        => array(
          'quote'        => array(
            'type'            => 'textarea',
            'label'           => __( 'Quote', 'amb-beaver-basics' ),
            'default'         => '',
            'rows'            => '6',
            'preview'       => array(
              'type'              => 'text',
              'selector'          => '.c-quote__body',
            ),
            'connections'         => array( 'html' ),
          ),
          'attribution'        => array(
            'type'            => 'text',
            'label'           => __( 'Atribution', 'amb-beaver-basics' ),
            'default'         => '',
            'preview'       => array(
              'type'              => 'text',
              'selector'          => '.c-quote__attribution',
            ),
            'connections'         => array( 'string' ),
          ),
          'cite'        => array(
            'type'            => 'link',
            'label'           => __( 'Citation', 'amb-beaver-basics' ),
            'default'         => '',
            'preview'       => array(
              'type'              => 'none',
            ),
            'connections'         => array( 'url' ),
          ),
          'markup'      => array(
            'type'            => 'raw',
            'label'           => __( 'Markup', 'amb-beaver-basics' ),
            'content'         => "<pre>" . esc_html( "<figure class=\"c-quote\">\n\t<blockquote class=\"c-quote__body\" cite=\"[citation]\">[quote]</blockquote>\n\t<figcaption class=\"c-quote__attribution\">[attribution]</figcaption>\n</figure></pre>" ) . "</pre>"
          ),
        )
      )
    )
  )
) );
