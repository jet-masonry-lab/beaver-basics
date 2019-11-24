<?php

/**
 * @class ambbbImageModule
 */
class ambbbImageModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Image', 'amb-beaver-basics' ),
      'description' => __( 'A simple image with minimal styling.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'Media', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
    add_filter( 'fl_builder_module_attributes', [__CLASS__, 'addModuleClasses'], 10, 2 );
  }

  public static function addModuleClasses( $attrs, $module )
  {
    if (
      'ambbb-image' === $module->slug
      && !empty( $module->settings->image_fit )
    ) {
      $attrs['class'][] = 'fl-module-ambbb-image--has-image-fit';
    }
    return $attrs;
  }

  public function figureClasses()
  {
    return $this->classesString( ['image'] );
  }

  public function imgWrapClasses()
  {
    return $this->classesString( [ 'image__image-area' ] );
  }

  public function imgClasses()
  {
    $classes = [ 'image__image' ];
    if ( $this->has( 'image_fit' ) ) {
      $classes[] = 'image__image--object-fit:' . $this->settings->image_fit;
    }
    return $this->classesString( $classes );
  }

  public function figcaptionClasses()
  {
    return $this->classesString( [ 'image__caption' ] );
  }

}

// Register the module
FLBuilder::register_module( 'ambbbImageModule', [
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
          'image_fit' => [
            'type' => 'select',
            'label' => __( 'Image Fit', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'None', 'amb-beaver-basics' ),
              'contain' => __( 'Contain', 'amb-beaver-basics' ),
              'cover' => __( 'Cover', 'amb-beaver-basics' ),
            ],
          ],
          'output_caption' => [
            'type' => 'button-group',
            'label' => __( 'Output Caption?', 'amb-beaver-basics' ),
            'default' => 0,
            'options' => [
              1 => __( 'Yes', 'amb-beaver-basics' ),
              0 => __( 'No', 'amb-beaver-basics' ),
            ],
          ],
        ],
      ],
    ],
  ],
  // 'style' => [
  //   'title' => __( 'Style', 'amb-beaver-basics' ),
  //   'sections' => [
  //     'style' => [
  //       'title' => '',
  //       'fields' => [
  //         'image_fit' => [
  //           'type' => 'select',
  //           'label' => __( 'Image Fit', 'amb-beaver-basics' ),
  //           'default' => '',
  //           'options' => [
  //             '' => __( 'None', 'amb-beaver-basics' ),
  //             'contain' => __( 'Contain', 'amb-beaver-basics' ),
  //             'cover' => __( 'Cover', 'amb-beaver-basics' ),
  //           ],
  //         ],
  //       ],
  //     ],
  //   ],
  // ],
] );
