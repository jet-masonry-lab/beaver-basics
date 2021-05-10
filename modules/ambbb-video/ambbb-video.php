<?php

class ambbbVideoModule extends ambbbFLBuilderModule
{
  // extension => mime type
  private static $_valid_types = [
    'm3u8' => 'application/x-mpegURL',
    'mp4' => 'video/mp4',
    'ogg' => 'video/ogv',
    'webm' => 'video/webm',
  ];

  private $_valid_sources;

  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'Video', 'amb-beaver-basics' ),
      'description' => __( 'A video module that uses the video.js library.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Media', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );

    add_filter( 'ambbb__video__base_classes', [__CLASS__, 'addBaseClasses'], 10, 3 );

    $this->add_css(
      'video-js-css',
      $this->url . 'css/video-js.css'
    );

    $this->add_js(
      'video-js-js',
      $this->url . 'js/video-js.js'
    );
  }

  public function shouldAutoplayOnScroll()
  {
    return (
      isset( $this->settings->autoplay )
      && 'scroll' === $this->settings->autoplay
    );
  }

  public function enqueue_scripts()
  {
    if ( $this->shouldAutoplayOnScroll() ) {
      $this->add_js( 'jquery-waypoints' );
      $this->add_js(
        'ambbb-video-autoplay-scroll',
        $this->url . 'js/autoplay-scroll.js',
        [ 'jquery-waypoints' ],
        NULL,
        true
      );
    }
  }

  public function getAspectRatio()
  {
    $aspect_ratio = '';
    if (
      'custom' == $this->settings->aspect_ratio
      && $this->has( 'aspect_ratio_width' )
      && $this->has( 'aspect_ratio_height' )
    ) {
      $aspect_ratio = $this->settings->aspect_ratio_width . ':' . $this->settings->aspect_ratio_height;
    } else {
      $aspect_ratio = str_replace( 'x', ':', $this->settings->aspect_ratio );
    }
    return $aspect_ratio;
  }

  public function getSetup()
  {
    // handle special cases
    $autoplay = $this->shouldAutoplayOnScroll() ? false : $this->settings->autoplay;

    $settings = [];
    $settings['autoplay'] = $this->mayBeBoolean( $autoplay );
    $settings['controls'] = $this->mayBeBoolean( $this->settings->controls );
    $settings['loop'] = $this->mayBeBoolean( $this->settings->loop );
    $settings['muted'] = $this->mayBeBoolean( $this->settings->muted );
    $settings['preload'] = 'true' === $this->settings->preload ? 'auto' : '';

    // poster image
    if ( 'media' === $this->settings->poster_type && $this->has( 'poster_media' ) ) {
      $settings['poster'] = wp_get_attachment_image_url( $this->settings->poster_media, $this->settings->poster_media_size );
    } elseif ( 'url' == $this->settings->poster_type && $this->has( 'poster_url' ) ) {
      $settings['poster'] = esc_url( $this->settings->poster_url );
    }

    // aspect ratio
    if ( $this->has( 'aspect_ratio' ) ) {
      $settings['aspectRatio'] = $this->getAspectRatio();
    }

    // fluid mode
    if (
      $this->has( 'aspect_ratio' )
      || (
        $this->has( 'mode' )
        && 'fluid' === $this->settings->mode
      )
    ) {
      $settings['fluid'] = true;
    }

    // fill mode
    if (
      ! $this->has( 'aspect_ratio' )
      && (
        $this->has( 'mode' )
        && 'fill' === $this->settings->mode
      )
    ) {
      $settings['fill'] = true;
    }

    return wp_json_encode(
      array_filter(
        $settings
      )
    );
  }

  public function getValidSources()
  {
    if ( !isset( $this->_valid_sources ) ) {
      $this->_valid_sources =
        is_array( $this->settings->source )
          ? array_filter( $this->settings->source, [$this,'sourceIsValid'] )
          : [];
    }
    return $this->_valid_sources;
  }

  public function sourceIsValid( $source )
  {
    $source_extension = $this->getSourceExtension( $source );
    return (
      filter_var( $source, FILTER_VALIDATE_URL ) // valid URL
      && in_array( $source_extension, array_keys( self::$_valid_types ) ) // valid extension
    );
  }

  public function getSourceExtension( $source )
  {
    $source_path = wp_parse_url( $source, PHP_URL_PATH );
    $source_extension = pathinfo( $source_path, PATHINFO_EXTENSION );
    return $source_extension;
  }

  public function getSourceType( $source )
  {
    return self::$_valid_types[ $this->getSourceExtension( $source ) ];
  }

  public static function addBaseClasses( $classes, $module )
  {
    if ( $module->shouldAutoplayOnScroll() ) {
      $classes[] = $module->bemClass( NULL, 'play-on-scroll' );
    }
    return $classes;
  }

}

FLBuilder::register_module( 'ambbbVideoModule', [
  'general' => [
    'title' => __( 'General', 'amb-beaver-basics' ),
    'sections' => [
      'sources' => [
        'title' => __( 'Sources', 'amb-beaver-basics' ),
        'fields' => [

          'source' => [
            'type' => 'text',
            'label' => __( 'Source', 'amb-beaver-basics' ),
            'help' => __( 'Supported formats: m3u8, mp4, ogg, webm' ),
            'default' => '',
            'multiple' => true,
          ],

        ],
      ],
      'poster' => [
        'title' => __( 'Poster', 'amb-beaver-basics' ),
        'fields' => [

          'poster_type' => [
            'type' => 'select',
            'label' => __( 'Poster Type', 'amb-beaver-basics' ),
            'default' => 'fluid',
            'options' => [
              'none' => __( 'None', 'amb-beaver-basics' ),
              'media' => __( 'Media Library', 'amb-beaver-basics' ),
              'url' => __( 'URL', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              'media' => [
                'fields' => [ 'poster_media' ],
              ],
              'url' => [
                'fields' => [ 'poster_url' ],
              ],
            ],
          ],

          'poster_media' => [
            'type' => 'photo',
            'label' => __( 'Poster', 'amb-beaver-basics' ),
            'show_remove' => true,
          ],

          'poster_url' => [
            'type' => 'link',
            'label' => __( 'Poster URL', 'amb-beaver-basics' ),
            'default' => '',
            'show_target'   => false,
            'show_nofollow' => false,
          ],

        ],
      ],
      'display' => [
        'title' => __( 'Display', 'amb-beaver-basics' ),
        'fields' => [

          'aspect_ratio' => [
            'type' => 'select',
            'label' => __( 'Aspect Ratio', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'Intrinsic', 'amb-beaver-basics' ),
              '21x9' => __( 'Cinema (21:9)', 'amb-beaver-basics' ),
              '16x9' => __( 'HDTV (16:9)', 'amb-beaver-basics' ),
              '4x3' => __( 'Television (4:3)', 'amb-beaver-basics' ),
              '1x1' => __( 'Square (1:1)', 'amb-beaver-basics' ),
              '9x16' => __( 'Vertical (9:16)', 'amb-beaver-basics' ),
              'custom' => __( 'Custom', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              '' => [
                'fields' => [ 'mode' ],
              ],
              'custom' => [
                'fields' => [ 'aspect_ratio_width', 'aspect_ratio_height' ],
              ],
            ],
          ],

          'aspect_ratio_width' => [
            'type' => 'unit',
            'label' => __( 'Aspect Width', 'amb-beaver-basics' ),
          ],

          'aspect_ratio_height' => [
            'type' => 'unit',
            'label' => __( 'Aspect Height', 'amb-beaver-basics' ),
          ],

          'mode' => [
            'type' => 'select',
            'label' => __( 'Mode', 'amb-beaver-basics' ),
            'default' => 'fluid',
            'options' => [
              'fluid' => __( 'Fluid', 'amb-beaver-basics' ),
              'fill' => __( 'Fill', 'amb-beaver-basics' ),
            ],
          ],

          'object_fit' => [
            'type' => 'select',
            'label' => __( 'Object Fit', 'amb-beaver-basics' ),
            'default' => '',
            'options' => [
              '' => __( 'Default', 'amb-beaver-basics' ),
              'contain' => __( 'Contain', 'amb-beaver-basics' ),
              'cover' => __( 'Cover', 'amb-beaver-basics' ),
              'fill' => __( 'Fill', 'amb-beaver-basics' ),
              'scale-down' => __( 'Scale Down', 'amb-beaver-basics' ),
            ],
          ],
        ],
      ],
      'player' => [
        'title' => __( 'Player', 'amb-beaver-basics' ),
        'fields' => [

          'autoplay' => [
            'type' => 'select',
            'label' => __( 'Autoplay', 'amb-beaver-basics' ),
            'default' => 'false',
            'options' => [
              'true' => __( 'True', 'amb-beaver-basics' ),
              'false' => __( 'False', 'amb-beaver-basics' ),
              'muted' => __( 'Muted', 'amb-beaver-basics' ),
              'play' => __( 'Play', 'amb-beaver-basics' ),
              'any' => __( 'Any', 'amb-beaver-basics' ),
              'scroll' => __( 'Scroll', 'amb-beaver-basics' ),
            ],
          ],

          'controls' => [
            'type' => 'select',
            'label' => __( 'Controls', 'amb-beaver-basics' ),
            'default' => 'true',
            'options' => [
              'true' => __( 'True', 'amb-beaver-basics' ),
              'false' => __( 'False', 'amb-beaver-basics' ),
            ],
          ],

          'loop' => [
            'type' => 'select',
            'label' => __( 'Loop', 'amb-beaver-basics' ),
            'default' => 'true',
            'options' => [
              'true' => __( 'True', 'amb-beaver-basics' ),
              'false' => __( 'False', 'amb-beaver-basics' ),
            ],
          ],

          'muted' => [
            'type' => 'select',
            'label' => __( 'Muted', 'amb-beaver-basics' ),
            'default' => 'false',
            'options' => [
              'true' => __( 'True', 'amb-beaver-basics' ),
              'false' => __( 'False', 'amb-beaver-basics' ),
            ],
          ],

          'preload' => [
            'type' => 'select',
            'label' => __( 'Preload', 'amb-beaver-basics' ),
            'default' => 'false',
            'options' => [
              'true' => __( 'True', 'amb-beaver-basics' ),
              'false' => __( 'False', 'amb-beaver-basics' ),
            ],
          ],


        ],
      ],
    ],
  ],

] );
