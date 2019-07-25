<?php
/**
 * Plugin Name: Beaver Basics
 * Plugin URI: TBD
 * Description: Simple modules for Beaver Builder
 * Version: 0.0.0.3
 * Author: Alert My Banjos
 * Author URI: https://www.alert-my-banjos.com/
 * Copyright: (c) 2019 Alert My Banjos
 * License: TBD
 * License URI: TBD
 * Text Domain: amb-beaver-basics
 */

function ambbb__load_modules()
{
  if ( class_exists( 'FLBuilder' ) ) {
    include_once( 'modules/ambbb-acf-frontend-form/ambbb-acf-frontend-form.php');
    include_once( 'modules/ambbb-button/ambbb-button.php');
    include_once( 'modules/ambbb-gallery/ambbb-gallery.php');
    include_once( 'modules/ambbb-heading/ambbb-heading.php');
    include_once( 'modules/ambbb-menu/ambbb-menu.php');
    include_once( 'modules/ambbb-quote/ambbb-quote.php');
    include_once( 'modules/ambbb-search-form/ambbb-search-form.php');
  }
}
add_action( 'init', 'ambbb__load_modules' );
