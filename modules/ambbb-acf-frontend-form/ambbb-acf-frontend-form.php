<?php

/**
 * @class ambbbButtonModule
 */
class ambbbAcfFrontendFormModule extends ambbbFLBuilderModule
{
  public function __construct()
  {
    parent::__construct( [
      'name' => __( 'Frontend Form', 'amb-beaver-basics' ),
      'description' => __( 'A frontend form.', 'amb-beaver-basics' ),
      'group' => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category' => __( 'BB - ACF', 'amb-beaver-basics' ),
      'dir' => plugin_dir_path( __FILE__ ),
      'url' => plugins_url( '/', __FILE__ )
    ] );

    // set up the ACF head
    add_action( 'wp', [ $this, 'add_acf_form_head' ] );
  }

  public function add_acf_form_head()
  {
    acf_form_head();
  }

  public function acf_form_settings()
  {
    /* (string) Unique identifier for the form. Defaults to 'acf-form' */
    // 'id' => 'acf-form',

                /* (int|string) The post ID to load data from and save data to. Defaults to the current post ID.
                Can also be set to 'new_post' to create a new post on submit */
                // 'post_id' => false,

                /* (array) An array of post data used to create a post. See wp_insert_post for available parameters.
                The above 'post_id' setting must contain a value of 'new_post' */
                // 'new_post' => array(),

    /* (array) An array of field group IDs/keys to override the fields displayed in this form */
    // 'field_groups' => false,

    /* (array) An array of field IDs/keys to override the fields displayed in this form */
    // 'fields' => false,

                /* (boolean) Whether or not to show the post title text field. Defaults to false */
                // 'post_title' => false,

                /* (boolean) Whether or not to show the post content editor field. Defaults to false */
                // 'post_content' => false,

                /* (boolean) Whether or not to create a form element. Useful when a adding to an existing form. Defaults to true */
                // 'form' => true,

    /* (array) An array or HTML attributes for the form element */
    // 'form_attributes' => array(),

                /* (string) The URL to be redirected to after the form is submit. Defaults to the current URL with a GET parameter '?updated=true'.
                A special placeholder '%post_url%' will be converted to post's permalink (handy if creating a new post)
                A special placeholder '%post_id%' will be converted to post's ID (handy if creating a new post) */
                // 'return' => '',

                /* (string) Extra HTML to add before the fields */
                // 'html_before_fields' => '',

                /* (string) Extra HTML to add after the fields */
                // 'html_after_fields' => '',

                /* (string) The text displayed on the submit button */
                // 'submit_value' => __("Update", 'acf'),

                /* (string) A message displayed above the form after being redirected. Can also be set to false for no message */
                // 'updated_message' => __("Post updated", 'acf'),

    /* (string) Determines where field labels are places in relation to fields. Defaults to 'top'.
    Choices of 'top' (Above fields) or 'left' (Beside fields) */
    // 'label_placement' => 'top',

    /* (string) Determines where field instructions are places in relation to fields. Defaults to 'label'.
    Choices of 'label' (Below labels) or 'field' (Below fields) */
    // 'instruction_placement' => 'label',

                /* (string) Determines element used to wrap a field. Defaults to 'div'
                Choices of 'div', 'tr', 'td', 'ul', 'ol', 'dl' */
                // 'field_el' => 'div',

    /* (string) Whether to use the WP uploader or a basic input for image and file fields. Defaults to 'wp'
    Choices of 'wp' or 'basic'. Added in v5.2.4 */
    // 'uploader' => 'wp',

    /* (boolean) Whether to include a hidden input field to capture non human form submission. Defaults to true. Added in v5.3.4 */
    // 'honeypot' => true,

    /* (string) HTML used to render the updated message. Added in v5.5.10 */
    // 'html_updated_message'  => '<div id="message" class="updated"><p>%s</p></div>',

    /* (string) HTML used to render the submit button. Added in v5.5.10 */
    // 'html_submit_button'  => '<input type="submit" class="acf-button button button-primary button-large" value="%s" />',

    /* (string) HTML used to render the submit button loading spinner. Added in v5.5.10 */
    // 'html_submit_spinner' => '<span class="acf-spinner"></span>',

    /* (boolean) Whether or not to sanitize all $_POST data with the wp_kses_post() function. Defaults to true. Added in v5.6.5 */
    // 'kses'  => true

    // Initialize settings array
    $acf_form_settings = [];

    // Form structure
    $acf_form_settings['post_title'] = !! $this->settings->post_title;
    $acf_form_settings['post_content'] = !! $this->settings->post_content;
    $acf_form_settings['field_el'] = $this->settings->field_el;
    if ( !empty( $this->settings->submit_value ) ) {
      $acf_form_settings['submit_value'] = $this->settings->submit_value;
    }

    // Form action
    switch ( $this->settings->action ) {
      case 'create':
        $acf_form_settings = array_merge( $acf_form_settings, $this->acf_create_post_settings() );
        break;
      case 'update':
        $acf_form_settings = array_merge( $acf_form_settings, $this->acf_update_post_settings() );
        break;
    }

    // Form redirect and return
    if ( !empty( $this->settings->return ) ) {
      $acf_form_settings['return'] = $this->settings->return;
    }
    if ( !empty( $this->settings->updated_message ) ) {
      $acf_form_settings['updated_message'] = $this->settings->updated_message;
    }

    return $acf_form_settings;

  }

  public function acf_create_post_settings()
  {
    $acf_create_post_settings = [];
    $acf_create_post_settings['post_id'] = 'new_post';
    $acf_create_post_settings['new_post'] = [
      'post_status' => $this->settings->post_status,
      'post_type' => $this->settings->post_type,
    ];
    return $acf_create_post_settings;
  }

  public function acf_update_post_settings()
  {
    $acf_update_post_settings = [];
    return $acf_update_post_settings;
  }

}

// Register the module
FLBuilder::register_module( 'ambbbAcfFrontendFormModule', [
  'general' => [
    'title' => __( 'General', 'amb-beaver-basics' ),
    'sections' => [

      'general' => [
        'title' => '',
        'fields' => [

          'action' => [
            'type' => 'button-group',
            'label' => __( 'Form Action', 'amb-beaver-basics' ),
            'default' => 'create',
            'options' => [
              'create' => __( 'Create Post', 'amb-beaver-basics' ),
              'update' => __( 'Edit Post', 'amb-beaver-basics' ),
            ],
            'toggle' => [
              'create' => [
                'sections' => [ 'new_post' ],
              ],
              'update' => [
                'sections' => [ 'edit_post' ],
              ],
            ],
          ],

          'post_title' => [
            'type' => 'button-group',
            'label' => __( 'Editable Title', 'amb-beaver-basics' ),
            'default' => 1,
            'options' => [
              0 => __( 'No', 'amb-beaver-basics' ),
              1 => __( 'Yes', 'amb-beaver-basics' ),
            ],
          ],

          'post_content' => [
            'type' => 'button-group',
            'label' => __( 'Editable Content', 'amb-beaver-basics' ),
            'default' => 0,
            'options' => [
              0 => __( 'No', 'amb-beaver-basics' ),
              1 => __( 'Yes', 'amb-beaver-basics' ),
            ],
          ],

        ],
      ],

      'new_post' => [
        'title' => __( 'New Post', 'amb-beaver-basics' ),
        'fields' => [

          'post_status' => [
            'type' => 'select',
            'label' => __( 'Post Status', 'amb-beaver-basics' ),
            'default' => 'draft',
            'options' => [
              'draft' => __( 'Draft', 'amb-beaver-basics' ),
              'pending' => __( 'Pending', 'amb-beaver-basics' ),
            ],
          ],

          'post_type' => [
            'type' => 'post-type',
            'label' => __( 'Post Type', 'amb-beaver-basics' ),
            'default' => 'post',
          ],

        ],
      ],

      'edit_post' => [
        'title' => __( 'Edit Post', 'amb-beaver-basics' ),
        'fields' => [

          'post_id' => [
            'type' => 'unit',
            'label' => __( 'Post ID', 'amb-beaver-basics' ),
            'description' => __( 'Leave blank to use the current post ID.', 'amb-beaver-basics' ),
            'connections' => [ 'custom_field' ],
          ],

        ],
      ],

    ],
  ],

  'form' => [
    'title' => __( 'Form', 'amb-beaver-basics' ),
    'sections' => [

      'structure' => [
        'title' => __( 'Structure', 'amb-beaver-basics' ),
        'fields' => [

          'field_el' => [
            'type' => 'select',
            'label' => __( 'Field Element', 'amb-beaver-basics' ),
            'description' => __( 'HTML element used to wrap each field.', 'amb-beaver-basics' ),
            'default' => 'div',
            'options' => [
              'div',
              'tr',
              'td',
              'ul',
              'ol',
              'dl',
            ],
          ],

          // 'html_before_fields' => [
          //   'type' => 'textarea',
          //   'label' => __( 'HTML Before Fields', 'amb-beaver-basics' ),
          //   'description' => __( 'Extra HTML to add before the fields', 'amb-beaver-basics' ),
          // ],

          // 'html_after_fields' => [
          //   'type' => 'textarea',
          //   'label' => __( 'HTML After Fields', 'amb-beaver-basics' ),
          //   'description' => __( 'Extra HTML to add before the fields', 'amb-beaver-basics' ),
          // ],

          'submit_value' => [
            'type' => 'text',
            'label' => __( 'Submit Button Text', 'amb-beaver-basics' ),
            'placeholder' => __( 'Update', 'amb-beaver-basics' ),
            'connections' => [ 'text' ],
          ],

        ],
      ],

      'result' => [
        'title' => __( 'Result', 'amb-beaver-basics' ),
        'fields' => [

          'redirect_url' => [
            'type' => 'link',
            'label' => __( 'Redirect URL', 'amb-beaver-basics' ),
            'description' => __( 'The URL to be redirected to after the form is submitted. Defaults to the current URL with a GET parameter "?updated=true".<br><br>A special placeholder "%post_url%" will be converted to post\'s permalink (handy if creating a new post).<br><br>A special placeholder "%post_id%" will be converted to post\'s ID (handy if creating a new post).', 'amb-beaver-basics' ),
            'connections' => [ 'url' ],
          ],

          'updated_message' => [
            'type' => 'text',
            'label' => __( 'Updated Message', 'amb-beaver-basics' ),
            'placeholder' => __( 'Post updated', 'amb-beaver-basics' ),
            'description' => __( 'A message displayed above the form after being redirected. Can also be set to false for no message.', 'amb-beaver-basics' ),
            'connections' => [ 'text' ],
          ],

        ],
      ],

    ],
  ],

] );


