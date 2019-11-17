<?php

/**
 * @class ambbbImageGridModule
 */
class ambbbImageGridModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Image Grid', 'amb-beaver-basics' ),
      'description' => __( 'A simple image grid with minimal structural styling.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }

  private function get_post_images()
  {
    $post_id = $this->has( 'post_id' ) ? $this->settings->post_id : get_the_ID();
    return array_map(
      function( $image ) {
        return $image->ID;
      },
      get_attached_media( 'image', $post_id )
    );
  }

  private function get_acf_images()
  {
    return array_map(
      function( $image ) {
        return $image['ID'];
      },
      get_field( $this->settings->acf_field_name )
    );
  }

  // Return an array of image IDs
  public function images()
  {
    switch ( $this->settings->source ) {
      case 'selected':
        return $this->settings->images;
        break;
      case 'post':
        return $this->get_post_images();
        break;
      case 'acf_gallery':
        return $this->get_acf_images();
        break;
    }
    return [];
  }

  // TODO: build classes with BEM functions
  // ... base / element / modifier

  public function mainClasses()
  {
    $classes = [ 'image-grid' ];
    if ( $this->has( 'layout' ) ) {
      $classes[] = 'image-grid--layout:' . $this->settings->layout;
    }
    return $this->classesString( $classes );
  }

  public function figureClasses( $image_id )
  {
    return $this->classesString( [ 'image-grid__figure' ] );
  }

  public function imgWrapClasses( $image_id )
  {
    $classes = [ 'image-grid__image-area' ];
    if ( $this->has( 'image_proportion' ) ) {
      $classes[] = 'image-grid__image-area--proportion:' . $this->settings->image_proportion;
    }
    return $this->classesString( $classes );
  }

  public function imgClasses( $image_id )
  {
    $classes = [ 'image-grid__image' ];
    if ( $this->has( 'image_fit' ) ) {
      $classes[] = 'image-grid__image--object-fit:' . $this->settings->image_fit;
    }
    return $this->classesString( $classes );
  }

  public function figcaptionClasses( $image_id )
  {
    return $this->classesString( [ 'image-grid__caption' ] );
  }

}

// Register the module
FLBuilder::register_module( 'ambbbImageGridModule', [
  'content' => [
    'title' => __( 'Content', 'amb-beaver-basics' ),
    'sections' => [
      'content' => [
        'title' => '',
        'fields' => [
          'source' => [
            'type' => 'select',
            'label' => __( 'Which Images', 'amb-beaver-basics' ),
            'default' => 'selected',
            'options' => [
              'selected' => __( 'Selected images', 'amb-beaver-basics' ),
              'post' => __( 'All images attached to a post', 'amb-beaver-basics' ),
              'acf_gallery' => __( 'ACF Gallery', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              'selected' => [
                'fields' => [ 'images' ],
              ],
              'post' => [
                'fields' => [ 'post_id' ],
              ],
              'acf_gallery' => [
                'fields' => [ 'acf_field_name' ],
              ],
            ],
          ],
          'images' => [
            'type' => 'multiple-photos',
            'label' => __( 'Images', 'amb-beaver-basics' ),
            'connections' => [ 'multiple-photos' ],
          ],
          'post_id' => [
            'type' => 'unit',
            'label' => __( 'Source Post ID', 'amb-beaver-basics' ),
            'description' => '(defaults to current post)',
          ],
          'acf_field_name' => [
            'type' => 'text',
            'label' => __( 'ACF Field Name', 'amb-beaver-basics' ),
            'connections' => [ 'text' ],
          ],
          'image_size' => [
            'type' => 'photo-sizes',
            'label' => __( 'Image Size', 'amb-beaver-basics' ),
            'default' => 'medium'
          ],
        ],
      ],
    ],
  ],
  'style' => [
    'title' => __( 'Style', 'amb-beaver-basics' ),
    'sections' => [
      'style' => [
        'title' => '',
        'fields' => [
          'layout' => [
            'type' => 'select',
            'label' => __( 'Layout Style', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'None', 'amb-beaver-basics' ),
              'flexbox' => __( 'Flexbox', 'amb-beaver-basics' ),
              'grid' => __( 'Grid', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              '' => [
                'fields' => [],
              ],
              'flexbox' => [
                'fields' => [],
              ],
              'grid' => [
                'fields' => [],
              ],
            ],
          ],
          'columns' => [
            'type' => 'unit',
            'label' => __( 'Columns', 'amb-beaver-basics' ),
            'default' => '3',
            'responsive' => true,
            'preview' => [
              'type' => 'css',
              'selector' => '.ambbb-image-grid',
              'property' => '--ambbb-image-grid-cols',
            ],
          ],
          'image_proportion' => [
            'type' => 'select',
            'label' => __( 'Image Proportion', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'None', 'amb-beaver-basics' ),
              'landscape' => __( 'Landscape', 'amb-beaver-basics' ),
              'square' => __( 'Square', 'amb-beaver-basics' ),
              'portrait' => __( 'Portrait', 'amb-beaver-basics' ),
            ],
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
        ],
      ],
    ],
  ],
] );
