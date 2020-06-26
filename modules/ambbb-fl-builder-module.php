<?php

// Extend Builder Model Class
class ambbbFLBuilderModule extends FLBuilderModule
{
  public function __construct( $params )
  {
    parent::__construct( $params );
  }

  public function objectHas( $obj, $key )
  {
    return !empty( $obj->{$key} );
  }

  public function has( $key )
  {
    return $this->objectHas( $this->settings, $key );
  }

  public function hasAny( $keys )
  {
    foreach ( $keys as $key ) {
      if ( $this->has( $key ) ) return true;
    }
    return false;
  }

  public function hasAll( $keys )
  {
    foreach ( $keys as $key ) {
      if ( ! $this->has( $key ) ) return false;
    }
    return true;
  }

  public function isTrue( $key )
  {
    return (bool) $this->settings->{$key};
  }

  protected function mayBeBoolean( $input )
  {
    if ( 'true' === $input ) { $input = true; }
    if ( 'false' === $input ) { $input = false; }
    return $input;
  }

  public function escInlineHtml( $string )
  {
    return wp_kses( $string, ambbb__allowed_html__inline() );
  }

  // return rel="noopener" if the target is blank
  public function noopener( $target )
  {
    return '_blank' == $target ? 'rel="noopener"' : '';
  }

  private function mayAppend( $base = '', $separator = '', $append = NULL )
  {
    if ( !empty( $append ) ) {
      $base .= $separator . $append;
    }
    return $base;
  }

  public function bemBase()
  {
    return $this->slug;
  }

  public function bemClass( $element = NULL, $modifier = NULL )
  {
    $class = $this->bemBase();
    if ( is_array( $element ) ) {
      $element = implode( '__', $element );
    }
    $class = $this->mayAppend( $class, '__', $element );
    $class = $this->mayAppend( $class, '--', $modifier );
    return $class;
  }

  public function classes( $element = NULL, $obj = NULL )
  {
    $classes = [];
    $classes[] = $this->bemClass( $element );
    // ambbb__MODULE__ELEMENT_classes
    $filter_tag = sprintf(
      'ambbb__%s__%s_classes',
      preg_replace( '/^ambbb[-_]*/', '', $this->slug ),
      $element ?: 'base'
    );
    $classes = apply_filters( $filter_tag, $classes, $this, $obj );
    return implode( ' ', $classes );
  }
}