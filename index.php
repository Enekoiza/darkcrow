<?php
header(($_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.0').' 503 Service Temporarily Unavailable',true,503);
header('Retry-After: 3600');
header('X-Powered-By:'); //hide PHP
?><!DOCTYPE html>
<!-- Source: https://www.wmtips.com/html/howto-make-a-perfect-site-maintenance-page.htm -->
<html lang="en">
<head>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Maintenance...</title>
<style type="text/css">
* {
  box-sizing: border-box;
}
html, body {
height: 100%;
margin: 0;
}
main {
height: 100%;
margin: 0 auto;
max-width: 700px;
padding: 30px;
display: table;
text-align: center;
}
main > * {
display: table-cell;
vertical-align: middle;
}

body
{
font: 20px Helvetica, sans-serif; color: #333;
background: url("fondo.jpeg") no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}
@keyframes blink {50% { color: transparent }}
.dot { animation: 1s blink infinite }
.dot:nth-child(2) { animation-delay: 250ms }
.dot:nth-child(3) { animation-delay: 500ms }

p, h1{
    color: white;
}

</style>

</head>
<body>



    <main>
    <div>
    <h1>Maintenance in progress<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1>
    <p class="text-white bg-dark">Sorry for the inconvenience but we're performing some maintenance right now. Please check back later.</p>
    </div>

</main>

</body>
</html>