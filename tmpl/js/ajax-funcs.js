
/* This script send messages between server and client, and show them */
var cnt_insert = 0;

jQuery( function () {

    jQuery( '#zairux_form_chat' ).on( 'submit' , function ( e ) {

       e.preventDefault(); // prevent the "submit" button from refreshing the web

       var div = document.getElementById( "zairux_list_mess" );
       var firstMessage = document.createElement( "div" );
       var message = document.getElementById ( "zairux_usermsg" );
       var text_mess = message.value; // message value
       var img = obj.img; //imagen del chatbot
       if ( text_mess.length > 0 ) {// the user has to send a message
             // insert user message in the chat
           firstMessage.innerHTML += ' <div id = "zairux_container2-right">' +

               '<div class=\"zairux_media-right\">' +
                '<div class=\"zairux_speech-right\">'+
                   '<p>'+text_mess+'</p>' +
                 '</div>' +
                 '<p class=\"zairux_speech-time-right\">' +
                 '' + getDate() + '' + // getDate, nos retorna la hora del usuario del chat, no del servidor.
                 '</p>' +
              '</div>' +
           '</div>';

           // add the previous div to our established div.
            div.appendChild ( firstMessage );
            var content_mess = document.getElementById ( 'zairux_scrollfix' ); // we control the scroll
            content_mess.scrollTop = content_mess.scrollHeight; // autoscroll when adding chat message

            message.value = '';

            // Bot response from here --------------
            var latestMessage = document.createElement( 'div' );

                   jQuery.ajax({
                             data: {
                               "message" : text_mess,
                               "identity" : obj.identity,
                               "zx" : obj.zx,
                               action: 'zairux_SendMessage'
                             },
                             url:   obj.ajax_url,
                             type:  'POST',
                             dataType : 'json',
                             beforeSend: function () {
                               latestMessage.innerHTML  = '<div id = "zairux_container2"><div id=\"zairux_mess-' + cnt_insert + '\">' +
                                        ' <div class=\"zairux_media-left \">' +
                                          '<span id=\"zairux_jquery_agent_image\"></span>' +
                                        '</div><div class=\"zairux_media-left-text\">' +
                                         '<div class=\"zairux_speech-left\">' +
                                         '<p><font color=\"white\" size=\"5\"><i class=\"fa fa-spinner fa-spin \"></i></font></p>' +
                                         '</div>' +
                                         '<p class=\"zairux_speech-time\">' +
                                         '' + getDate() + '' +
                                         '</p>'+
                                        '</div>' +
                                      '</div></div>';

                                   div.appendChild( latestMessage );
                                   var content_mess = document.getElementById( 'zairux_scrollfix' );
                                   content_mess.scrollTop = content_mess.scrollHeight;

                             },
                             success:  function ( data ) {
                               response = data['message'];
                               if ( !jQuery.trim( data ) || data['message']== 'ACCESS DENIED' || data['message']== 'OFFLINE' || data['message'] == 'ACCESS DENIED. INVALID TOKEN' || data['message'] == 'INTERNAL ERROR'){
                                 response = "<b> <font color=\"red\"><i class=\"fa fa-exclamation-circle\"></i></font> TEST SERVER DISCONNECTED OR ERROR, CONTACT WITH SUPPORT</b>";

                               }

                               // insert the dialog response message into the chat
                                 var insert_mess = document.getElementById ( 'zairux_mess-' + cnt_insert);
                                  insert_mess.innerHTML  = ' <div class=\"zairux_media-left \">' +
                                        '<img src=\"'+img+'\" id="zairux_jquery_agent_image" width=50 height=50 class=\"zairux_img-circle zairux_img-md\" alt=\"Profile Picture\">' +
                                      '</div><div class=\"zairux_media-left-text\">' +
                                       '<div class=\"zairux_speech-left\">' +
                                       '<p>' + response + '</p>' +
                                       '</div>' +
                                       '<p class=\"zairux_speech-time\">' +
                                       '' + getDate() + '' +
                                       '</p>' +
                                      '</div>';

                                 // the same, we add the div, we control the scroll
                                  var content_mess = document.getElementById( 'zairux_scrollfix' );
                                  content_mess.scrollTop = content_mess.scrollHeight; // move scroll down
                                  message.disabled = false;
                                  document.getElementById( 'zairux_btn_agent' ).disabled = false;
                                  cnt_insert++;
                                 },
                                 error: function(xhr, textStatus, error){
                                     console.log(xhr.statusText);
                                     console.log(textStatus);
                                     console.log(error);
                                 },
                     });

         }
    });

});
