<?php
// function to show plugin view
function zairux_show_plugin($datas) {

// if you want, you can change here the content
$image = $datas['Image']; // chatbot image
$start_sentence = $datas['Start']; //chatbot start sentence
$name = $datas['Name']; // chatbot name

?>

<!-- chatbot body-->
<div id="zairux_chatbot">
  <div id="zairux_chat_body" style="display:none;">
    <div class="zairux_chat-head">
      <span id="zairux_agent_name"><span id="zairux_jquery_agent_name"><?php echo $name; ?></span> <i class="fa fa-comments"></i></span><span id="zairux_zone_submit"></span>
    </div>
    <div class="zairux_nano zairux_has-scrollbar">
      <div class="zairux_nano-content zairux_pad-all" id ="zairux_scrollfix" tabindex="0">
          <div class="zairux_list-unstyled media-block" id="zairux_list_mess">
            <div id = "zairux_container2">
              <div class="zairux_media-left">

                <img src="<?php echo $image; ?>" id="zairux_jquery_agent_image" class="zairux_img-circle" width="50" height="50" alt="Profile Picture">

                <br />
              </div>
               <div class="zairux_media-left-text">
                <div class="zairux_speech-left">
                  <p id="zairux_jquery_agent_start"><?php echo $start_sentence; ?></p>
                </div>
                <p class="zairux_speech-time">
                   <span id="zairux_start_time"></span>
                </p>

            </div>
          </div>
        </div>
        </div>
        <span id="zairux_logo-ref"><a href="https://zairux.com" target="_blank"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'image/zairux/logo.png'; ?>" style="width:7vh;height:2vh;"></a></span>

    </div>

    <div id="zairux_footer-agent">

        <form id ="zairux_form_chat">
                <input type="text"  maxlength="30" placeholder="<?php echo esc_html( __( 'Ask me something...', 'zairux-chatbot' ) ); ?>" name="zairux_usermsg" class="zairux_text_agent" id="zairux_usermsg" style="width:74%;">
                <button type="submit" id="zairux_btn_agent" class="zairux_myButton"
                style="width:20%"><?php echo esc_html( __( 'Send', 'zairux-chatbot' ) ); ?></button>



        </div>
  </div>
  <img src="<?php echo plugin_dir_url( __FILE__ ) . 'image/zairux/icon.ico'; ?>" width="50px" height="50px" id="zairux_buttOCchat" onClick='showChat()'>
</div>
<script type="text/javascript">
  //message start date
  document.getElementById( "zairux_start_time" ).innerHTML = getDate();
</script>

<?php } ?>
