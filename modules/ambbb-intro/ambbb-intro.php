<?php

class ambbbIntroModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Intro', 'amb-beaver-basics' ),
      'description' => __( 'A heading with optional eyebrow, subhead and body text.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }

  public function introClasses()
  {
    return $this->classesString( [ 'intro' ] );
  }

  public function eyebrowClasses()
  {
    return $this->classesString( [ 'intro__eyebrow' ] );
  }

  public function headingClasses()
  {
    return $this->classesString( [ 'intro__heading' ] );
  }

  public function headingTextClasses()
  {
    return $this->classesString( [ 'intro__heading_text' ] );
  }

  public function subheadClasses()
  {
    return $this->classesString( [ 'intro__subhead' ] );
  }

  public function bodyClasses()
  {
    return $this->classesString( [ 'intro__body' ] );
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

          'subhead' => [
            'type' => 'text',
            'label' => __( 'Subhead Text', 'amb-beaver-basics' ),
            'default' => '',
            'preview' => [
              'type' => 'text',
              'selector' => '.c-intro__subhead',
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

      'eyebrow' => [
        'title' => __( 'Eyebrow', 'amb-beaver-basics' ),
        'fields' => [

          'eyebrow_rel' => [
            'type' => 'button-group',
            'label' => __( 'Eyebrow Relationship', 'amb-beaver-basics' ),
            'default' => 'sibling',
            'options' => [
              'sibling' => __( 'Sibling', 'amb-beaver-basics' ),
              'child' => __( 'Child', 'amb-beaver-basics' ),
            ],
            'description' => __( 'Should the eyebrow text be a child of the heading tag or a sibling?'),
            'toggle' => [
              'sibling' => [ 'fields' => [ 'eyebrow_tag' ] ],
              'child' => [],
            ],
          ],

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

        ],
      ],

      'subhead' => [
        'title' => __( 'Subhead', 'amb-beaver-basics' ),
        'fields' => [

          'subhead_rel' => [
            'type' => 'button-group',
            'label' => __( 'Subhead Relationship', 'amb-beaver-basics' ),
            'default' => 'sibling',
            'options' => [
              'sibling' => __( 'Sibling', 'amb-beaver-basics' ),
              'child' => __( 'Child', 'amb-beaver-basics' ),
            ],
            'description' => __( 'Should the eyebrow text be a child of the heading tag or a sibling?'),
            'toggle' => [
              'sibling' => [ 'fields' => [ 'subhead_tag' ] ],
              'child' => [],
            ],
          ],

          'subhead_tag' => [
            'type' => 'select',
            'label' => __( 'Subhead Tag', 'amb-beaver-basics' ),
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

      'body' => [
        'title' => __( 'body', 'amb-beaver-basics' ),
        'fields' => [

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

