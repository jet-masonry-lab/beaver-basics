<?php

class ambbbIntroModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Intro', 'amb-beaver-basics' ),
      'description' => __( 'A heading with optional eyebrow, subtext and body text.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }
}

FLBuilder::register_module( 'ambbbIntroModule', [
  'content' => [
    'title' => __( 'Content', 'amb-beaver-basics' ),
    'sections' => [
      'content' => [
        'title' => '',
        'fields' => [

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

        ],
      ],
    ],
  ],

  'structure' => [
    'title' => __( 'Structure', 'amb-beaver-basics' ),
    'sections' => [

      'heading' => [
        'title' => __( 'Heading', 'amb-beaver-basics' ),
        'fields' => [

          'heading_tag' => [
            'type' => 'select',
            'label' => __( 'Heading Tag', 'amb-beaver-basics' ),
            'default' => 'h2',
            'options' => [
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

      'eyebrow' => [
        'title' => __( 'Eyebrow', 'amb-beaver-basics' ),
        'fields' => [

          'eyebrow_rel' => [
            'type' => 'button-group',
            'label' => __( 'Eyebrow Relationship', 'amb-beaver-basics' ),
            'default' => 'sibling',
            'options' => [
              'child' => 'Child',
              'sibling' => 'Sibling',
            ],
            'description' => __( 'Should the eyebrow text be a child of the heading tag or a sibling?'),
            'toggle' => [
              'child' => [],
              'sibling' => [ 'fields' => [ 'eyebrow_tag' ] ],
            ],
          ],

          'eyebrow_tag' => [
            'type' => 'select',
            'label' => __( 'Eyebrow Tag', 'amb-beaver-basics' ),
            'default' => 'div',
            'options' => [
              'span' => 'span',
              'div' => 'div',
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

      'body' => [
        'title' => __( 'body', 'amb-beaver-basics' ),
        'fields' => [

          'body_rel' => [
            'type' => 'button-group',
            'label' => __( 'Body Relationship', 'amb-beaver-basics' ),
            'default' => 'sibling',
            'options' => [
              'child' => 'Child',
              'sibling' => 'Sibling',
            ],
            'description' => __( 'Should the body text be a child of the heading tag or a sibling?'),
            'toggle' => [
              'child' => [],
              'sibling' => [ 'fields' => [ 'body_tag' ] ],
            ],
          ],

          'body_tag' => [
            'type' => 'select',
            'label' => __( 'Body Tag', 'amb-beaver-basics' ),
            'default' => 'div',
            'options' => [
              'span' => 'span',
              'div' => 'div',
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

