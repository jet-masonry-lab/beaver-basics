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

            // TODO: maybe instead, make this a repeating text field called "variations" which gets appended to the component CSS class for styling purposes
            'style' => [
              'type' => 'button-group',
              'label' => __( 'Button Style', 'amb-beaver-basics' ),
              'default' => 'primary',
              'options' => [
                'primary' => __( 'Primary', 'amb-beaver-basics' ),
                'secondary' => __( 'Secondary', 'amb-beaver-basics' ),
                'link' => __( 'Link', 'amb-beaver-basics' ),
              ],
            ],

            'variations' => [
              'type' => 'text',
              'label' => __( 'Variation', 'amb-beaver-basics' ),
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
