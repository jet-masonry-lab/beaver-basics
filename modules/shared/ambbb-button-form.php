<?php

FLBuilder::register_settings_form('ambbb-button-form', [

  'title' => __( 'Add Button', 'amb-beaver-basics' ),
  'tabs' => [

    'content' => [
      'title'=> '',
      'sections' => [

        'content' => [
          'title'  => '',
          'fields' => [

            'text' => [
              'type' => 'text',
              'label' => __( 'Text', 'amb-beaver-basics' ),
              'default' => __( 'Click Here', 'amb-beaver-basics' ),
              'preview' => [
                'type' => 'text',
                'selector' => '.fl-button-text',
              ],
              'connections' => [ 'string' ],
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

            'variations' => [
              'type' => 'text',
              'label' => __( 'CSS Variation', 'amb-beaver-basics' ),
              'default' => '',
              'placeholder' => __( 'primary', 'amb-beaver-basics' ),
              'multiple' => true,
            ],

          ],
        ],

      ],
    ],

  ],

] );
