<html>
  <head>
  <title>B</title>
   
  </head>
  <script>
    var blank;
    function PIDFunction(){
      blank=1;
    }
   function sendData() {
   const toSayText = document.getElementById('toSay').value;
   if(blank==1){
    window.opener.document.getElementById("PID").value = toSayText;
    window.close();
   }
}
  </script>
  <body>
      <textarea id = "toSay"></textarea>
      <button id = "sendText" onclick="sendData()">送出文字</button>
  </body>
</html>