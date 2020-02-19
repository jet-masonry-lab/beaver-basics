<?php

/**
 * @class ambbbQuoteModule
 */
class ambbbQuoteModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Quote', 'amb-beaver-basics' ),
      'description' => __( 'A simple quote, no style options.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }

  public function citeAttribute()
  {
    return empty( $settings->cite ) ? '' : sprintf( 'cite="%s"', esc_url( $settings->cite ) );
  }

  public function linkOpen()
  {
    return empty( $settings->cite ) ? '' : sprintf( '<a href="%s">', esc_url( $settings->cite ) );
  }

  public function linkClose()
  {
    return empty( $settings->cite ) ? '' : '</a>';
  }
}

// Register the module
FLBuilder::register_module( 'ambbbQuoteModule', [
  'general' => [
    'title' => __( 'General', 'amb-beaver-basics' ),
    'sections' => [
      'general' => [
        'title' => '',
        'fields' => [
          'quote' => [
            'type' => 'textarea',
            'label' => __( 'Quote', 'amb-beaver-basics' ),
            'default' => '',
            'rows' => '6',
            'preview' => [
              'type' => 'text',
              'selector' => '.ambbb-quote__body',
            ],
            'connections' => [ 'html' ],
          ],
          'attribution' => [
            'type' => 'text',
            'label' => __( 'Atribution', 'amb-beaver-basics' ),
            'default' => '',
            'preview' => [
              'type' => 'text',
              'selector' => '.ambbb-quote__attribution',
            ],
            'connections' => [ 'string' ],
          ],
          'cite' => [
            'type' => 'link',
            'label' => __( 'Citation', 'amb-beaver-basics' ),
            'default' => '',
            'preview' => [
              'type' => 'none',
            ],
            'connections' => [ 'url' ],
          ],
          'markup' => [
            'type' => 'raw',
            'label' => __( 'Markup', 'amb-beaver-basics' ),
            'content' => "<pre>" . esc_html( "<figure class=\"c-quote\">\n\t<blockquote class=\"c-quote__body\" cite=\"[citation]\">[quote]</blockquote>\n\t<figcaption class=\"c-quote__attribution\">[attribution]</figcaption>\n</figure></pre>" ) . "</pre>"
          ],
        ],
      ],
    ],
  ],
] );
