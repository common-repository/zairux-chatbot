<?php
/**
* Plugin Name: Zairux Chatbot
* Description: This plugin allows you to integrate your chatbot in a basic way in your Wordpress, wide functionalities registering in Zairux.com, you can select a free plan.
* Version: 1.0.0
* Author: Zairux
* Author URI: https://zairux.com
* License: GPL2
* Text Domain: zairux-chatbot
* Domain Path: /languages
*/
require 'tmpl/default.php';
require 'tmpl/Settings.php';
require 'tmpl/GetData.php';
require 'tmpl/SendMess.php';

add_action('init', 'zairux_plugin_langs');
add_action( 'init', 'zairux_init' );

//ajax
add_action( 'wp_ajax_'.'zairux_SendMessage', 'zairux_SendMessage', 10, 3 );
add_action( 'wp_ajax_nopriv_'.'zairux_SendMessage', 'zairux_SendMessage',10, 3 );

add_action( 'wp_footer', 'zairux_Botchat' );
add_action( 'admin_menu', 'zairux_plugin_menu' ); //anclaje al footer

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'salcode_add_plugin_page_settings_link');

function salcode_add_plugin_page_settings_link( $links ) {
	$links[] = '<a href="' .
		admin_url( 'options-general.php?page=zairux_admin' ) .
		'">' . __('Settings') . '</a>';
	return $links;
}
function zairux_plugin_langs(){
	$text_domain	= 'zairux-chatbot';
	$path_languages = basename(dirname(__FILE__)).'/languages';

 	load_plugin_textdomain($text_domain, false, $path_languages );
}
function zairux_plugin_menu(){
    add_menu_page( 'Zairux Wordpress config', 'Zairux Wordpress config', 'administrator', 'zairux_admin', 'zairux_display_admin_settings', null );
    //call register settings function
	  add_action( 'admin_init', 'zairux_opts_settings' );

}
function zairux_display_admin_settings(){

    zairux_show_settings();
}
//Returns Client Ip address, not believe 100%, first the connection to the token is created, we dont store IP address
function zairux_getIP(){

		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else
		    $ip = $_SERVER['REMOTE_ADDR'];

		return $ip;
}
function zairux_Botchat()
{
		$identity = zairux_generateRandomString( 7 );
		//This function asks Zairux for initial information,
		// you can delete it and put the manual information by replacing the variable $data in the php, file -> SendMess.php
		$data = zairux_getData( esc_attr( get_option('zairux_api_private') ), $identity);
		$data_decode = json_decode($data, true);
		//--
		wp_register_script( 'ajax-mess', ''. plugin_dir_url( __FILE__ ) . 'tmpl/js/ajax-funcs.js', array(), '' );
		$arr = array (
		 'ajax_url' => admin_url( 'admin-ajax.php' ),
		 'img' => ''.$data_decode['Image'].'',
		 'identity' => ''.$data_decode['Identity'].'',
		 'zx' => ''.esc_attr( get_option('zairux_api_public') ).''
		);

		wp_localize_script( 'ajax-mess', 'obj', $arr );
		wp_enqueue_script( 'ajax-mess' );

		//function to show the plugin
    zairux_show_plugin($data_decode);

}
function zairux_generateRandomString() {
    return md5(uniqid());
}
function zairux_opts_settings() {

	//register our settings
  $defaults_public = array(
        'type'              => 'string',
        'description'       => 'Public Key',
        'sanitize_callback' => 'sanitize_text_field',
        'show_in_rest'      => false,
        'default'           => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoxLCJhZ2VudCI6OH0.XPJ_FZs2gN4sGcJPiBwX_YGRWZfeuxOPnCYsiIxGG7k'
    );
  //register our settings
  $defaults_private = array(
        'type'              => 'string',
        'description'       => 'Private Key',
        'sanitize_callback' => 'sanitize_text_field',
        'show_in_rest'      => false,
        'default'           => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoxLCJhZ2VudCI6OH0.AaQU7Yes0g2tyRUiVitRtWb4g0BTCuT3he3xZ1YUU04' //Default api, change it in Zairux.com (you can use free plan)
  );

	register_setting( 'zx-settings-group', 'zairux_api_private', $defaults_private);
	register_setting( 'zx-settings-group', 'zairux_api_public', $defaults_public );
}

// include custom jQuery and funcs
function zairux_init() {
  if ( !is_admin() ) {

		wp_enqueue_script( 'jquery' );

		wp_enqueue_style( 'zairux-chat', plugin_dir_url( __FILE__ ) . 'tmpl/css/Chat.css' ); // Styles
		wp_enqueue_script( 'zairux-chatfuncs', plugin_dir_url( __FILE__ ) . 'tmpl/js/ChatFunctions.js' ); //funcs


  }
}
