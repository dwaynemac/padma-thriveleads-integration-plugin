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

// when ThriveLeads form is submitted we'll run our function
add_action("tve_leads_form_conversion", "padma_tvi_forward_post_to_padma", 10, 5); 

function padma_tvi_forward_post_to_padma($main, $form_type, $variation, $active_test_id, $data, $post_data) {
  error_log(padma_tvi_post_form($post_data));
}

function padma_tvi_post_form($data){
  $data = padma_tvi_merge_api_key($data);
  
  $response = wp_remote_post( "https://crm.padm.am/api/v1/form_integration", array(
    'method'      => 'POST',
    'httpversion' => '1.0',
    'blocking'    => true,
    'headers'     => array(),
    'body'        => $data,
    'cookies'     => array()
    )
  );
   
  if ( is_wp_error( $response ) ) {
    $response->get_error_message();
  } else {
    true;
  }
};

function padma_tvi_merge_api_key($array){
  return array_merge($array,array('api_key' => get_option( 'padma_tvi_api_key')));
}

/*
register_activation_hook( __FILE__, 'padma_tvi_padma_thriveleads_integration_activated' );
function padma_tvi_padma_thriveleads_integration_activated() {
};

register_deactivation_hook( __FILE__, 'padma_tvi_padma_thriveleads_integration_deactivated' );
function padma_tvi_padma_thriveleads_integration_deactivated(){
};
*/

add_action( 'admin_menu', 'padma_tvi_custom_menu');
function padma_tvi_custom_menu(){
  add_options_page(
    'PADMA Configuration',
    'PADMA Configuration',
    'manage_options',
    'padma_tvi_options_page',
    'padma_tvi_options_page_callback'
  );
};

function padma_tvi_options_page_callback(){
      ?>
    <div class="wrap">
        <h2>My Plugin Options</h2>
        <form method="post" action="options.php">
          <?php settings_fields('pluginPage'); ?>
          <?php do_settings_sections( 'pluginPage' ); ?>
          <?php submit_button(); ?>
        </form>
    </div>
    <?php
};

add_action( 'admin_init', 'padma_tvi_settings_init' );
function padma_tvi_settings_init(){
  add_settings_section(
    'padma_tvi_settings_section',
    'PADMA-ThriveLeads Integration Configuration',
    'padma_tvi_settings_callback',
    'pluginPage'
  );
  
  add_settings_field(
    'padma_tvi_api_key',
    'PADMA API KEY',
    'padma_tvi_api_key_setting_callback',
    'pluginPage',
    'padma_tvi_settings_section'
  );
  
  register_setting('pluginPage','padma_tvi_api_key','padma_tvi_api_key_sanitize_callback');
};

function padma_tvi_settings_callback(){
  echo "Insert here your api key. 'form_integration' access is needed.";
};

function padma_tvi_api_key_setting_callback(){
  $apikey = get_option( 'padma_tvi_api_key');
  echo "<input name='padma_tvi_api_key' id='padma_tvi_api_key' type='text' value='$apikey'/>";
};

function padma_tvi_api_key_sanitize_callback($raw_api_key){
  return $raw_api_key;
};
?>