<?php

/**
 * @class ambbbImageGridModule
 */
class ambbbImageGridModule extends ambbbFLBuilderModule
{
  private $_images = NULL;

  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Image Grid', 'amb-beaver-basics' ),
      'description' => __( 'A simple image grid with minimal structural styling.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Media', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }

  private function getSelectedImages()
  {
    if ( $images = $this->settings->images ) {
      return array_map(
        function( $image_id ) {
          return [
            'id' => $image_id,
            'caption' => wp_get_attachment_caption( $image_id ),
          ];
        },
        $images
      );
    } else {
      return [];
    }
  }

  private function getAttachedImages()
  {
    $post_id = $this->has( 'post_id' ) ? $this->settings->post_id : get_the_ID();
    if ( $images = get_attached_media( 'image', $post_id ) ) {
      return array_map(
        function( $image ) {
          return [
            'id' => $image->ID,
            'caption' => wp_get_attachment_caption( $image->ID ),
          ];
        },
        $images
      );
    } else {
      return [];
    }
  }

  private function getACFImages( $from = NULL )
  {
    // TODO: handle different types of return values from ACF field ( Image Array, Image URL, Image ID )
    // Or indicate in settings what return types will work
    if ( $images = get_field( $this->settings->acf_field_name, $from ) ) {
      return array_map(
        function( $image ) {
          return [
            'id' => $image['ID'],
            'caption' => wp_get_attachment_caption( $image['ID'] ),
          ];
        },
        $images
      );
    } else {
      return [];
    }
  }

  private function getACFPostsImages( $from = NULL )
  {
    // TODO: handle different types of return values from ACF field ( Post Object, Post ID )
    // Or indicate in settings what return types will work
    if ( $posts = get_field( $this->settings->acf_field_name, $from ) ) {
      return array_map(
        function( $post ) {
          $image_id = $this->getACFPostImageID( $post->ID );
          $image_caption = $this->getACFPostCaption( $post->ID, $image_id );
          return [
            'id' => $image_id,
            'caption' => $image_caption,
          ];
        },
        $posts
      );
    } else {
      return [];
    }
  }

  private function getACFPostImageID( $post_id )
  {
    switch ( $this->settings->acf_posts_image_type ) {
      case 'featured':
        return get_post_thumbnail_id( $post_id );
        break;
      case 'acf_field':
        // TODO: handle different types of return values from ACF field ( Image Array, Image URL, Image ID )
        // Or indicate in settings what return types will work
        return get_field( $this->settings->acf_posts_image_field_name, $post_id )['ID'];
        break;
    }
  }

  private function getACFPostCaption( $post_id, $image_id )
  {
    switch ( $this->settings->acf_posts_caption_type ) {
      case 'post_title':
        return get_the_title( $post_id );
        break;
      case 'media_caption':
        return wp_get_attachment_caption( $image_id );
        break;
    }
  }

  // Return an array of image IDs
  public function getImages()
  {
    if ( is_null( $this->_images ) ) {
      switch ( $this->settings->source ) {
        case 'selected':
          $this->_images = $this->getSelectedImages();
          break;
        case 'attached':
          $this->_images = $this->getAttachedImages();
          break;
        case 'acf_gallery':
          $this->_images = $this->getACFImages();
          break;
        case 'acf_gallery_option':
          $this->_images = $this->getACFImages( 'option' );
          break;
        case 'acf_posts':
          $this->_images = $this->getACFPostsImages();
          break;
        case 'acf_posts_option':
          $this->_images = $this->getACFPostsImages( 'option' );
          break;
      }
    }
    return $this->_images;
  }

  public function hasImages()
  {
    return !empty( $this->getImages() );
  }

  // TODO: build classes with BEM functions
  // ... base / element / modifier

  public function gridClasses()
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

  public function imgIsLinked( $image_id )
  {
    switch ( $this->settings->link_type ) {
      case 'acf_field':
        return (
          $this->has( 'link_acf_field_name' )
          && !empty( $this->imgLinkHref( $image_id ) )
        );
        break;
      default:
        return false;
        break;
    }
  }

  public function imgLinkHref( $image_id )
  {
    return get_field( $this->settings->link_acf_field_name, $image_id );
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
            'label' => __( 'Which images?', 'amb-beaver-basics' ),
            'default' => 'selected',
            'options' => [
              'selected' => __( 'Selected images', 'amb-beaver-basics' ),
              'attached' => __( 'Images attached to a post', 'amb-beaver-basics' ),
              'acf_gallery' => __( 'ACF Gallery (Post Field)', 'amb-beaver-basics' ),
              'acf_gallery_option' => __( 'ACF Gallery (Option Field)', 'amb-beaver-basics' ),
              'acf_posts' => __( 'ACF Relationship (Post Field)', 'amb-beaver-basics' ),
              'acf_posts_option' => __( 'ACF Relationship (Option Field)', 'amb-beaver-basics' ),
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
              'acf_gallery_option' => [
                'fields' => [ 'acf_field_name' ],
              ],
              'acf_posts' => [
                'sections' => [ 'acf_posts' ],
                'fields' => [ 'acf_field_name' ],
              ],
              'acf_posts_option' => [
                'sections' => [ 'acf_posts' ],
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
          'link_type' => [
            'type' => 'select',
            'label' => __( 'Link Images', 'amb-beaver-basics' ),
            'default' => 'selected',
            'options' => [
              '' => __( 'None', 'amb-beaver-basics' ),
              'acf_field' => __( 'ACF Field', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              'acf_field' => [
                'fields' => [ 'link_acf_field_name' ],
              ],
            ],
          ],
          'link_acf_field_name' => [
            'type' => 'text',
            'label' => __( 'Link ACF Field Name', 'amb-beaver-basics' ),
            'connections' => [ 'text' ],
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
      'acf_posts' => [
        'title' => __( 'ACF Posts', 'amb-beaver-basics' ),
        'fields' => [
          'acf_posts_image_type' => [
            'type' => 'button-group',
            'label' => __( 'What type of post image?', 'amb-beaver-basics' ),
            'default' => 'featured',
            'options' => [
              'featured' => __( 'Featured', 'amb-beaver-basics' ),
              'acf_field' => __( 'ACF Field', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              'featured' => [
                'fields' => [],
              ],
              'acf_field' => [
                'fields' => [ 'acf_posts_image_field_name' ],
              ],
            ],
          ],
          'acf_posts_image_field_name' => [
            'type' => 'text',
            'label' => __( 'ACF Image Field Name', 'amb-beaver-basics' ),
            'connections' => [ 'text' ],
          ],
          'acf_posts_caption_type' => [
            'type' => 'button-group',
            'label' => __( 'What type of caption?', 'amb-beaver-basics' ),
            'default' => 'post_title',
            'options' => [
              'post_title' => __( 'Post Title', 'amb-beaver-basics' ),
              'media_caption' => __( 'Media Caption', 'amb-beaver-basics' ),
            ],
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
