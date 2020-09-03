<?php
/**
 * Plugin Name: Beaver Basics
 * Plugin URI: TBD
 * Description: Simple modules for Beaver Builder
 * Version: 0.1.0.0
 * Author: Alert My Banjos
 * Author URI: https://www.alert-my-banjos.com/
 * Copyright: (c) 2019 Alert My Banjos
 * License: TBD
 * License URI: TBD
 * Text Domain: amb-beaver-basics
 */

include_once( 'wordpress/wordpress.kses-allowed-html.php' );

if ( class_exists( 'FLBuilder' ) ) {

  // Register Styles + Scripts
  add_action( 'wp_enqueue_scripts', 'ambbb__register_styles_scripts' );

  // Settings
  include_once( 'settings/settings.layout.php');
  include_once( 'settings/settings.variations.php');

}


function ambbb__register_styles_scripts()
{
  wp_register_style( 'ambbb-col-flexbox', plugins_url( '/dist/settings.layout.css', __FILE__ ), [], plugins_url( '/dist/settings.layout.css', __FILE__ ) );
  wp_enqueue_style( 'ambbb-col-flexbox' );
}


function ambbb__init_modules()
{
  if ( class_exists( 'FLBuilder' ) ) {

    // Shared Forms
    include_once( 'modules/shared/ambbb-button-form.php');

    // Base Module Class
    include_once( 'modules/ambbb-fl-builder-module.php');

    // Modules
    include_once( 'modules/ambbb-acf-frontend-form/ambbb-acf-frontend-form.php');
    include_once( 'modules/ambbb-button/ambbb-button.php');
    include_once( 'modules/ambbb-callout/ambbb-callout.php');
    include_once( 'modules/ambbb-button-group/ambbb-button-group.php');
    include_once( 'modules/ambbb-csv-to-table/ambbb-csv-to-table.php');
    include_once( 'modules/ambbb-gallery/ambbb-gallery.php');
    include_once( 'modules/ambbb-heading/ambbb-heading.php');
    include_once( 'modules/ambbb-image/ambbb-image.php');
    include_once( 'modules/ambbb-image-grid/ambbb-image-grid.php');
    include_once( 'modules/ambbb-intro/ambbb-intro.php');
    include_once( 'modules/ambbb-menu/ambbb-menu.php');
    include_once( 'modules/ambbb-post/ambbb-post.php');
    include_once( 'modules/ambbb-queried-object/ambbb-queried-object.php');
    include_once( 'modules/ambbb-quote/ambbb-quote.php');
    include_once( 'modules/ambbb-search-form/ambbb-search-form.php');
    include_once( 'modules/ambbb-separator/ambbb-separator.php');
    include_once( 'modules/ambbb-slider/ambbb-slider.php');
    include_once( 'modules/ambbb-tax-term-list/ambbb-tax-term-list.php');
    include_once( 'modules/ambbb-video/ambbb-video.php');
    include_once( 'modules/ambbb-youtube/ambbb-youtube.php');

  }
}
add_action( 'init', 'ambbb__init_modules', 9999 ); // register with late priority to improve chances that other customizations are complete (e.g. custom post types registered)
