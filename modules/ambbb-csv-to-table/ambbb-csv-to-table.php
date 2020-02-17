<?php

class ambbbCSVToTableModule extends FLBuilderModule
{
  private $_row_count;
  private $_row_class; // resets for each row
  private $_col_classes; // set on first row, reference on subsequent rows

  public function __construct()
  {
    parent::__construct( [
      'name'        => __( 'CSV to Table', 'amb-beaver-basics' ),
      'description' => __( 'Module description.', 'amb-beaver-basics' ),
      'group'       => __( 'Beaver Basics', 'amb-beaver-basics' ),
      'category'    => __( 'BB - Basic', 'amb-beaver-basics' ),
      'dir'         => plugin_dir_path( __FILE__ ),
      'url'         => plugins_url( '/', __FILE__ )
    ] );
  }

  public function getDelimiter()
  {
    $characters = [
      'comma' => ',',
      'tab' => "\t",
    ];
    return $characters[$this->settings->delimiter];
  }

  public function rows( $data )
  {
    $rows = explode( "\n", $data );
    $this->_row_count = count( $rows );
    return $rows;
  }

  public function cells( $data )
  {
    $cells = explode( $this->getDelimiter(), $data );
    return $cells;
  }

  public function isHeadRow( $row_index )
  {
    return (
      0 == $row_index // first row
      && in_array( $this->settings->headers, [ 'col', 'both' ] ) // YES headers for columns
    );
  }

  public function isHeadCol( $col_index )
  {
    return (
      0 == $col_index // first col
      && in_array( $this->settings->headers, [ 'row', 'both' ] ) // YES headers for rows
    );
  }

  public function isFirstBodyRow( $row_index )
  {
    return (
      (
        0 == $row_index // first row
        && in_array( $this->settings->headers, [ 'row', 'none' ] ) // NO headers for columns
      )
      || (
        1 == $row_index // second row
        && in_array( $this->settings->headers, [ 'col', 'both' ] ) // YES headers for columns
      )
    );
  }

  public function isLastBodyRow( $row_index )
  {
    return ( ( $row_index + 1 ) == $this->_row_count );
  }

  public function setRowClass( $row_index, $cell )
  {
    $this->_row_class = sanitize_title( $cell );
  }

  public function setColClass( $col_index, $cell )
  {
    $this->_col_classes[ $col_index ] = sanitize_title( $cell );
  }

  public function getCellClasses( $row_index, $col_index )
  {
    $classes = [];
    if ( !empty( $this->_row_class ) ) {
      $classes[] = "row--{$this->_row_class}";
    }
    if ( !empty( $this->_col_classes[$col_index] ) ) {
      $classes[] = "col--{$this->_col_classes[$col_index]}";
    }
    return implode( ' ', $classes );
  }

  public function formatCellContent( $cell_content )
  {
    $cell_content = preg_replace( "/\(([^)]*)\)/", '<span class="small">($1)</span>', $cell_content );
    return $cell_content;
  }
}

FLBuilder::register_module( 'ambbbCSVToTableModule', [
  'content' => [
    'title' => __( 'Content', 'amb-beaver-basics' ),
    'sections' => [
      'content' => [
        'title' => '',
        'fields' => [

          'headers' => [
            'type' => 'button-group',
            'label' => __( 'Headers', 'amb-beaver-basics' ),
            'default' => 'col',
            'options' => [
              'none' => __( 'None', 'amb-beaver-basics' ),
              'col'=> __( 'For Cols', 'amb-beaver-basics' ),
              'row' => __( 'For Rows', 'amb-beaver-basics' ),
              'both' => __( 'Both', 'amb-beaver-basics' ),
            ],
            'preview' => [
              'type' => 'none',
            ],
            'connections' => [ 'html' ],
          ],

          'delimiter' => [
            'type' => 'button-group',
            'label' => __( 'Delimiter', 'amb-beaver-basics' ),
            'default' => 'comma',
            'options' => [
              'comma' => __( 'Comma (CSV)', 'amb-beaver-basics' ),
              'tab' => __( 'Tab (TSV)', 'amb-beaver-basics' ),
            ],
            'preview' => [
              'type' => 'none',
            ],
            'connections' => [ 'html' ],
          ],

          'source' => [
            'type' => 'code',
            'label' => __( 'Source Data', 'amb-beaver-basics' ),
            'editor' => 'html',
            'rows' => 10,
            'default' => '',
            'preview' => [
              'type' => 'none'
            ],
            'connections' => [ 'html' ],
          ],

        ]
      ]
    ]
  ]
] );
