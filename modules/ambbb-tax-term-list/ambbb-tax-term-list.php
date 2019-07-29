<?php

/**
 * @class TaxTermListModule
 */
class ambbbTaxTermListModule extends FLBuilderModule
{
  public function __construct()
  {
    parent::__construct(array(
      'name'        => __( 'Tax Term List', 'amb-beaver-basics' ),
      'description' => __( 'Linked list of all terms in a taxonomy.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ));
  }

  public static function get_public_taxonomies()
  {
    return array_map(
      function( $tax ) {
        return $tax->label;
      },
      get_taxonomies(
        array(
          'public' => true
        ),
        'objects'
      )
    );
  }
}

// For list of possible arguments to include in settings, see:
// https://developer.wordpress.org/reference/classes/wp_term_query/__construct/

// Register the module
FLBuilder::register_module( 'ambbbTaxTermListModule', array(
  'options' => array(
    'title'     => __( 'Options', 'amb-beaver-basics' ),
    'sections'  => array(
      'query'   => array(
        'title'     => __( 'Query', 'amb-beaver-basics' ),
        'fields'    => array(
          'taxonomy'  => array(
            'type'      => 'select',
            'label'     => __( 'Taxonomy', 'amb-beaver-basics' ),
            'options'   => ambbbTaxTermListModule::get_public_taxonomies()
          ),
          'hide_empty' => array(
            'type'      => 'select',
            'label'     => __( 'Empty Terms', 'amb-beaver-basics' ),
            'default'   => 1,
            'options'   => array(
              0           => __( 'Show', 'amb-beaver-basics' ),
              1           => __( 'Hide', 'amb-beaver-basics' )
            )
          ),
          'orderby'    => array(
            'type'      => 'select',
            'label'     => __( 'Order By', 'amb-beaver-basics' ),
            'default'   => 'name',
            'options'   => array(
              'name'      => __( 'Name', 'amb-beaver-basics' ),
              'slug'      => __( 'Slug', 'amb-beaver-basics' ),
              'count'     => __( 'Count', 'amb-beaver-basics' )
            )
          ),
          'order'    => array(
            'type'      => 'select',
            'label'     => __( 'Order', 'amb-beaver-basics' ),
            'default'   => 'ASC',
            'options'   => array(
              'ASC'       => __( 'Ascending', 'amb-beaver-basics' ),
              'DESC'      => __( 'Descending', 'amb-beaver-basics' )
            )
          )
        )
      ),
      'display'   => array(
        'title'     => __( 'Display', 'amb-beaver-basics' ),
        'fields'    => array(
          'link'   => array(
            'type'          => 'select',
            'label'         => __( 'Link Terms', 'amb-beaver-basics' ),
            'default'       => 1,
            'options'       => array(
              1          => __( 'Yes', 'amb-beaver-basics' ),
              0          => __( 'No', 'amb-beaver-basics' )
            )
          ),
          'count'   => array(
            'type'          => 'select',
            'label'         => __( 'Post Count', 'amb-beaver-basics' ),
            'default'       => 0,
            'options'       => array(
              1          => __( 'Show', 'amb-beaver-basics' ),
              0          => __( 'Hide', 'amb-beaver-basics' )
            )
          ),
          'description'   => array(
            'type'          => 'select',
            'label'         => __( 'Description', 'amb-beaver-basics' ),
            'default'       => 0,
            'options'       => array(
              1          => __( 'Show', 'amb-beaver-basics' ),
              0          => __( 'Hide', 'amb-beaver-basics' )
            )
          )
        )
      )
    )
  )
) );