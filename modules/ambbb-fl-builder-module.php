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

  public function escInlineHtml( $string )
  {
    return wp_kses( $string, ambbb__allowed_html__inline() );
  }

  // return rel="noopener" if the target is blank
  public function noopener( $target )
  {
    return '_blank' == $target ? 'rel="noopener"' : '';
  }

  protected function classesString( array $chunks )
  {
    return implode(
      ' ',
      preg_filter( '/^/', 'ambbb-', $chunks )
    );
  }
}