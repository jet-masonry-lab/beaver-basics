<?php

class ambbbVideoModule extends ambbbFLBuilderModule
{
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
      $this->url . 'css/video-js.min.css'
    );

    $this->add_js(
      'video-js-js',
      $this->url . 'js/video.min.js'
    );
  }

  public function shouldAutoplayOnScroll()
  {
    return ( 'scroll' === $this->settings->autoplay );
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
      'custom' == $this->settings->aspectRatio
      && $this->has( 'aspectRatio_width' )
      && $this->has( 'aspectRatio_height' )
    ) {
      $aspect_ratio = $this->settings->aspectRatio_width . ':' . $this->settings->aspectRatio_height;
    } else {
      $aspect_ratio = str_replace( 'x', ':', $this->settings->aspectRatio );
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
    if ( $this->settings->poster ) {
      $settings['poster'] = wp_get_attachment_image_url( $this->settings->poster, $this->settings->poster_size );
    }
    $settings['preload'] = 'true' === $this->settings->preload ? 'auto' : '';
    switch ( $this->settings->mode ) {
      case 'fill':
        $settings['fill'] = true;
      break;
      case 'fluid':
        $settings['fluid'] = true;
        $settings['aspectRatio'] = $this->getAspectRatio();
      break;
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
      && in_array( $source_extension, ['mp4','webm'] ) // valid extension
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
    return sprintf(
      'video/%s',
      $this->getSourceExtension( $source )
    );
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
      'content' => [
        'title' => __( 'Content', 'amb-beaver-basics' ),
        'fields' => [

          'source' => [
            'type' => 'text',
            'label' => __( 'Source', 'amb-beaver-basics' ),
            'default' => '',
            'multiple' => true,
          ],

          'poster' => [
            'type' => 'photo',
            'label' => __( 'Poster', 'amb-beaver-basics' ),
            'show_remove' => true,
          ],

          'mode' => [
            'type' => 'select',
            'label' => __( 'Mode', 'amb-beaver-basics' ),
            'default' => 'fluid',
            'options' => [
              'fluid' => __( 'Fluid', 'amb-beaver-basics' ),
              'fill' => __( 'Fill', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              'fluid' => [
                'fields' => [ 'aspectRatio' ],
              ],
            ],
          ],

          'aspectRatio' => [
            'type' => 'select',
            'label' => __( 'Aspect Ratio', 'amb-beaver-basics' ),
            'default' => 'auto',
            'options' => [
              'auto' => __( 'Auto', 'amb-beaver-basics' ),
              '21x9' => __( 'Cinema (12:9)', 'amb-beaver-basics' ),
              '16x9' => __( 'HDTV (16:9)', 'amb-beaver-basics' ),
              '4x3' => __( 'Television (4:3)', 'amb-beaver-basics' ),
              '1x1' => __( 'Square (1:1)', 'amb-beaver-basics' ),
              '9x16' => __( 'Vertical (9:16)', 'amb-beaver-basics' ),
              'custom' => __( 'Custom', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              'custom' => [
                'fields' => [ 'aspectRatio_width', 'aspectRatio_height' ],
              ],
            ],
          ],

          'aspectRatio_width' => [
            'type' => 'unit',
            'label' => __( 'Aspect Width', 'amb-beaver-basics' ),
          ],

          'aspectRatio_height' => [
            'type' => 'unit',
            'label' => __( 'Aspect Height', 'amb-beaver-basics' ),
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
