<?php

class ambbbButtonGroupModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Button Group', 'amb-beaver-basics' ),
      'description' => __( 'A group of one or more buttons, no style options.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }

  public function variation_classes( $base, $object )
  {
    $variation_classes = [];
    if ( !empty( $object->variations ) ) {
      foreach( $object->variations as $variation ) {
        if ( !empty( $variation ) ) {
          $variation_classes[] = "$base--$variation";
        }
      }
    }
    return implode( ' ', $variation_classes );
  }
}

FLBuilder::register_module( 'ambbbButtonGroupModule', [
  'content' => [
    'title' => __( 'Content', 'amb-beaver-basics' ),
    'sections' => [
      'content' => [
        'title' => '',
        'fields' => [

          'buttons' => [
            'type' => 'form',
            'label' => __( 'Button', 'amb-beaver-basics' ),
            'form' => 'ambbb-button-form',
            'preview_text' => 'link_text',
            'multiple' => true,
          ],

        ]
      ]
    ]
  ]
] );
