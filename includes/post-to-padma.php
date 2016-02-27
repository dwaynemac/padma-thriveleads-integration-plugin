<?php

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
};

?>