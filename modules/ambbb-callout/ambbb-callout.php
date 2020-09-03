<?php

class ambbbCalloutModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Callout', 'amb-beaver-basics' ),
      'description' => __( 'Image, eyebrow, heading and body text, buttons.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );

    add_filter( 'ambbb__callout__button_classes', [__CLASS__, 'addButtonClasses'], 10, 3 );
  }

  public static function addButtonClasses( $classes, $module, $button )
  {
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

FLBuilder::register_module( 'ambbbCalloutModule', [
  'content' => [
    'title' => __( 'Content', 'amb-beaver-basics' ),
    'sections' => [
      'content' => [
        'title' => '',
        'fields' => [

          'image' => [
            'type' => 'photo',
            'label' => __( 'Image', 'amb-beaver-basics' ),
            'show_remove' => true,
          ],

          'image_size' => [
            'type' => 'photo-sizes',
            'label' => __( 'Image Size', 'amb-beaver-basics' ),
            'default' => 'medium'
          ],

          'eyebrow' => [
            'type' => 'text',
            'label' => __( 'Eyebrow Text', 'amb-beaver-basics' ),
            'default' => '',
            'preview' => [
              'type' => 'text',
              'selector' => '.c-intro__eyebrow',
            ],
            'connections' => [ 'string' ],
          ],

          'heading' => [
            'type' => 'text',
            'label' => __( 'Heading Text', 'amb-beaver-basics' ),
            'default' => '',
            'preview' => [
              'type' => 'text',
              'selector' => '.c-intro__heading__text',
            ],
            'connections' => [ 'string' ],
          ],

          'body' => [
            'type' => 'editor',
            'label' => __( 'Body Text', 'amb-beaver-basics' ),
            'media_buttons' => false,
            'wpautop' => true,
            'preview' => [
              'type' => 'text',
              'selector' => '.c-intro__body',
            ],
            'connections' => [ 'html', 'string', 'url' ],
          ],

          'link_type' => [
            'type' => 'button-group',
            'label' => __( 'Link Type', 'amb-beaver-basics' ),
            'default' => 'block',
            'options' => [
              'block' => __( 'Block', 'amb-beaver-basics' ),
              'buttons' => __( 'Buttons', 'amb-beaver-basics' ),
              'none' => __( 'None', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              'block' => ['fields' => ['link']],
              'buttons' => ['fields' => ['buttons']],
              'none' => ['fields' => []],
            ],
          ],

          'link' => [
            'type' => 'link',
            'label' => __( 'Link', 'amb-beaver-basics' ),
            'placeholder' => __( 'http://www.example.com', 'amb-beaver-basics' ),
            'show_target' => true,
            'show_nofollow' => true,
            'preview' => [
              'type' => 'none'
            ],
            'connections' => [ 'url' ],
          ],

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

  'structure' => [
    'title' => __( 'Structure', 'amb-beaver-basics' ),
    'sections' => [

      'markup' => [
        'title' => '',
        'fields' => [

          'eyebrow_tag' => [
            'type' => 'select',
            'label' => __( 'Eyebrow Tag', 'amb-beaver-basics' ),
            'default' => 'div',
            'options' => [
              'div' => 'div',
              'span' => 'span',
              'h1' => 'h1',
              'h2' => 'h2',
              'h3' => 'h3',
              'h4' => 'h4',
              'h5' => 'h5',
              'h6' => 'h6',
            ],
          ],

          'heading_tag' => [
            'type' => 'select',
            'label' => __( 'Heading Tag', 'amb-beaver-basics' ),
            'default' => 'h3',
            'options' => [
              'div' => 'div',
              'span' => 'span',
              'h1' => 'h1',
              'h2' => 'h2',
              'h3' => 'h3',
              'h4' => 'h4',
              'h5' => 'h5',
              'h6' => 'h6',
            ],
          ],

          'body_tag' => [
            'type' => 'select',
            'label' => __( 'Body Tag', 'amb-beaver-basics' ),
            'default' => 'div',
            'options' => [
              'div' => 'div',
              'span' => 'span',
              'h1' => 'h1',
              'h2' => 'h2',
              'h3' => 'h3',
              'h4' => 'h4',
              'h5' => 'h5',
              'h6' => 'h6',
            ],
          ],

        ],
      ],

    ],
  ],
] );

