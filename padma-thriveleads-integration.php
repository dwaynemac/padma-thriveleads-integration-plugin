<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
/**
 * @package PADMA ThriveLeads Integration
 * @version 0.1
 */
 
/*
Plugin Name: PADMA ThriveLeads Integration
Plugin URI: http://github.com/dwaynemac/padma-thriveleads-integration-plugin
Description: Make ThriveLeads forms forward fields to PADMA CRM.
Author: Dwayne Macgowan
Version: 0.1
AuthorURI: http://github.com/dwaynemac
*/

define( 'PADMA_TVI__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( PADMA_TVI__PLUGIN_DIR . 'includes/options-page.php' );
require_once( PADMA_TVI__PLUGIN_DIR . 'includes/post-to-padma.php' );
require_once( PADMA_TVI__PLUGIN_DIR . 'includes/hook-into-thriveleads.php' );

?>