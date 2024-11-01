// - function that is executed when clicking on the arrow to open or close the chat - //
function showChat(){
  var x = document.getElementById( "zairux_chat_body" );
  //--mostrar o ocultar menus--//
  var img = document.getElementById( "zairux_buttOCchat" );

  if (x.style.display === "none"){
    x.style.display = "block";


  }else{
    x.style.display = "none";

  }

}
// return current user date (no server) - //
function getDate(){
   var d = new Date(),
   minutes = d.getMinutes().toString().length == 1 ? '0' + d.getMinutes() : d.getMinutes(),
   hours = d.getHours().toString().length == 1 ? '0' + d.getHours() : d.getHours(),
   ampm = d.getHours() >= 12 ? 'pm' : 'am';
   return hours + ':' + minutes+ampm;
}
//close chat
function closeChat(){
      var content = document.getElementById( 'zairux_container' );
      content.style.display = "none";
}
