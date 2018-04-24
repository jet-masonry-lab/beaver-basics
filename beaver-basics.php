<?php
/**
 * Plugin Name: Beaver Basics
 * Plugin URI: TBD
 * Description: Simple modules for Beaver Builder
 * Version: 2.0.6.4
 * Author: Dish Works
 * Author URI: https://www.dish-works.com/
 * Copyright: (c) 2018 Dish Works
 * License: TBD
 * License URI: TBD
 * Text Domain: dw-beaver-basics
 */

function dwbb__load_modules()
{
  if ( class_exists( 'FLBuilder' ) ) {
    include_once( 'modules/dwbb-heading/dwbb-heading.php');
    include_once( 'modules/dwbb-search-form/dwbb-search-form.php');
  }
}
add_action( 'init', 'dwbb__load_modules' );
