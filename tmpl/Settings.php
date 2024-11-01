<?php
/*Zairux options */
function zairux_show_settings() {
?>

<h2><?php echo esc_html( __( 'Zairux Plugin Settings', 'zairux-chatbot' ) ); ?>:</h2>

<form method = "post" action = "options.php">
  <?php settings_fields( 'zx-settings-group' ); ?>
 <?php do_settings_sections( 'zx-settings-group' ); ?>
 <!-- Server default url -->
<b><?php echo esc_html( __( 'Private Key', 'zairux-chatbot' ) ); ?>:</b> <input type = "text" name = "zairux_api_private" id = "zairux_api_private" value = "<?php echo esc_attr( get_option( 'zairux_api_private' ) ); ?>">
<br /><br />
<!-- Api token default -->
<b><?php echo esc_html( __( 'Public Key', 'zairux-chatbot' ) ); ?>:</b> <input type = "text" name = "zairux_api_public" id = "zairux_api_public" value="<?php echo esc_attr( get_option('zairux_api_public') ); ?>">

<?php submit_button(); ?>
</form>
<!--Data -->
<br /><br /><b><font color = "red"><?php echo esc_html( __( 'Note', 'zairux-chatbot' ) ); ?>:</font></b>

<?php echo esc_html( __( 'For special modifications or errors on the visual of the plugin, as well as implementing
any extra functionality, contact support@zairux.com or from the support (for free). If you wish, you can also contribute to the plugin, by doing so we will put you in the credits of it.', 'zairux-chatbot' ) ); ?>
 <br />
<b><?php echo esc_html( __( 'If you are a programmer, you can modify the visual in: [wordpress path]> wp-content> plugins> Zairux BotChat> tmpl> css> Chat.css', 'zairux-chatbot' ) ); ?>
<br /><br /><?php echo esc_html( __( 'To be able to use your chatbot in a personalized way, register with Zairux (for free or with a payment plan) and obtain your public and private keys. Link ->', 'zairux-chatbot' ) ); ?><a href="https://zairux.com/reg?refer=plug"> Zairux </a>.
<?php } ?>
