<?php

add_action( 'admin_menu', 'padma_tvi_custom_menu');
function padma_tvi_custom_menu(){
  add_options_page(
    'PADMA Options',
    'PADMA Options',
    'manage_options',
    'padma_tvi_options_page',
    'padma_tvi_options_page_callback'
  );
};

function padma_tvi_options_page_callback(){
      ?>
    <div class="wrap">
        <h2>PADMA Options</h2>
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