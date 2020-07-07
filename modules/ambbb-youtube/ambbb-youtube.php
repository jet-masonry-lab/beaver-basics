<?php

class ambbbYouTubeModule extends ambbbFLBuilderModule
{
  private $_valid_sources;

  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'YouTube', 'amb-beaver-basics' ),
      'description' => __( 'A simple responsive YouTube embed.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Media', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );

    add_filter( 'ambbb__youtube__base_classes', [__CLASS__, 'addBaseClasses'], 10, 3 );
  }

  public function getAspectRatioPercentage()
  {
    $aspect_ratio = '';
    if (
      'custom' == $this->settings->aspect_ratio
      && $this->has( 'aspect_ratio_width' )
      && $this->has( 'aspect_ratio_height' )
    ) {
      $aspect_ratio = 100 * $this->settings->aspect_ratio_height / $this->settings->aspect_ratio_width;
    } else {
      $aspect_ratio = $this->settings->aspect_ratio;
    }
    return $aspect_ratio;
  }

  public static function addBaseClasses( $classes, $module )
  {
    $classes[] = $module->bemClass( NULL, 'fluid' );
    return $classes;
  }
}

FLBuilder::register_module( 'ambbbYouTubeModule', [
  'general' => [
    'title' => __( 'General', 'amb-beaver-basics' ),
    'sections' => [
      'content' => [
        'title' => __( 'Content', 'amb-beaver-basics' ),
        'fields' => [

          'youtube_id' => [
            'type' => 'text',
            'label' => __( 'YouTube ID', 'amb-beaver-basics' ),
            'default' => '',
          ],

          'aspect_ratio' => [
            'type' => 'select',
            'label' => __( 'Aspect Ratio', 'amb-beaver-basics' ),
            'default' => '56.25',
            'options' => [
              '42.8571429' => __( 'Cinema (21:9)', 'amb-beaver-basics' ),
              '56.25' => __( 'HDTV (16:9)', 'amb-beaver-basics' ),
              '75' => __( 'Television (4:3)', 'amb-beaver-basics' ),
              '100' => __( 'Square (1:1)', 'amb-beaver-basics' ),
              '177.7777778' => __( 'Vertical (9:16)', 'amb-beaver-basics' ),
              'custom' => __( 'Custom', 'amb-beaver-basics' ),
            ],
            'toggle' => [
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


        ],
      ],
    ],
  ],
] );

