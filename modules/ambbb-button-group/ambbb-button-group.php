<?php

class ambbbButtonGroupModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Button Group', 'amb-beaver-basics' ),
      'description' => __( 'A group of one or more buttons, no style options.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Input', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );

    add_filter( 'ambbb__button-group__button_classes', [__CLASS__, 'addButtonClasses'], 10, 3 );
  }

  public static function addButtonClasses( $classes, $module, $button )
  {
    if ( !empty( $button->style ) ) {
      $classes[] = $module->bemClass( 'button', $button->style );
    }
    if ( !empty( $button->variations ) ) {
      foreach( $button->variations as $variation ) {
        if ( !empty( $variation ) ) {
          $classes[] = $module->bemClass( 'button', $variation );
        }
      }
    }
    return $classes;
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

        ],
      ],
    ],
  ],
] );
