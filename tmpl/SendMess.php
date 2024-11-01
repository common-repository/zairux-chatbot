<?php
function zairux_SendMessage(){

  $jsonData = array(
        'message' => sanitize_text_field($_POST['message']),
        'identity' => sanitize_text_field($_POST['identity']),
        'token' => sanitize_text_field($_POST['zx'])
  );
  $url = 'https://agents.zairux.com/web/messages';
  $response = wp_remote_post($url, array(
         'headers'     => array('Content-Type' => 'application/json;'),
         'body'        => json_encode($jsonData),
         'method'      => 'POST',
         'data_format' => 'body',
  ));

  if( is_wp_error( $response ) ) {
         return NULL; // Bail early
  }

  echo wp_remote_retrieve_body( $response );
  die;
}
?>
