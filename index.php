<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AI Copilot Clone</title>

<style>
/* Reset */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family: Arial, sans-serif;
}

/* Background */
body{
  background: linear-gradient(135deg, #e3f2ff, #f6faff);
  min-height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
}

/* Container Box */
.container{
  background:#fff;
  width:90%;
  max-width:650px;
  padding:30px 35px;
  border-radius:14px;
  box-shadow:0 8px 25px rgba(0,0,0,0.1);
  text-align:center;
}

/* Header Title */
h1{
  font-size:28px;
  color:#1e4f91;
  margin-bottom:8px;
}

/* Subtitle */
p.desc{
  font-size:15px;
  color:#555;
  margin-bottom:35px;
}

/* Button */
button{
  background:#1e4f91;
  color:#fff;
  border:none;
  padding:14px 28px;
  font-size:16px;
  border-radius:8px;
  cursor:pointer;
  transition:background .3s;
}

button:hover{
  background:#163b6d;
}

/* Footer Text */
.footer-note{
  margin-top:25px;
  font-size:13px;
  color:#888;
}
</style>
</head>
<body>

<div class="container">
  <h1>🚀 AI Copilot Clone</h1>
  <p class="desc">Your smart assistant for chat, writing & automation.</p>

  <button onclick="redirectToChat()">Start Chat</button>

  <div class="footer-note">
    © 2025 - Powered by PHP • HTML • JS
  </div>
</div>

<script>
function redirectToChat(){
  window.location.href = 'chat.php';
}
</script>

</body>
</html>
