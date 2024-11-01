<?php

function zairux_getData($api, $identity){
    //Zairux only stores the IP used temporarily. We never use this data to monitor the customer.
    $jsonData = array(
        'token' => ''.$api.'', // api client token
        'internal_key' => ''.$identity.'', // unique identity per client
        'ip' => zairux_getIP(),
        'lang' => ''.substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2).''
    );

    $url = 'https://agents.zairux.com/web/data';
    $response= wp_remote_post($url, array(
        'headers'     => array('Content-Type' => 'application/json;'),
        'body'        => json_encode($jsonData),
        'method'      => 'POST',
        'data_format' => 'body',
    ));
    if( is_wp_error( $response ) ) {
      return NULL; // Bail early
    }

    return wp_remote_retrieve_body( $response );
}
?>
