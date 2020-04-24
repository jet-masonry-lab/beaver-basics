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

            'link_text' => [
              'type' => 'text',
              'label' => __( 'Link Text', 'amb-beaver-basics' ),
              'default' => '',
              'connections' => [ 'string' ],
              'preview' => [
                'type' => 'none'
              ],
            ],

            'link_url' => [
              'type' => 'link',
              'label' => __( 'Link URL', 'amb-beaver-basics' ),
              'show_target' => true,
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
