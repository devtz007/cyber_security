<?php
// Get user inputs (ALL WITHOUT SANITIZATION — intentionally)
$param      = isset($_GET['param']) ? $_GET['param'] : '';
$path       = $_SERVER['REQUEST_URI'];
$userAgent  = $_SERVER['HTTP_USER_AGENT'] ?? '';
$referer    = $_SERVER['HTTP_REFERER'] ?? '';
$postData   = $_POST['post_input'] ?? '';
$cookieVal  = $_COOKIE['xss_cookie'] ?? '';

// Set a cookie for demonstration (optional)
setcookie("xss_cookie", "change_this_to_XSS", time() + 3600);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Multi-Vector XSS Demo</title>
  <style>
    body {
      font-family: sans-serif;
      margin: 2rem
    }
  </style>
</head>

<body>
  <h1>Vulnerable XSS Demo</h1>

  <h2>GET Parameter:</h2>
  <div>param: <?= $param ?></div>

  <h2>URL Path:</h2>
  <div>Request URI: <?= $path ?></div>
  <script>
    var path = "<?= $path ?>";
    document.write(path);
  </script>

  <h2>Header Reflection:</h2>
  <div>User-Agent: <?= $userAgent ?></div>
  <div>Referer: <?= $referer ?></div>

  <h2>POST Data:</h2>
  <div>post_input: <?= $postData ?></div>

  <h2>Cookie:</h2>
  <div>xss_cookie: <?= $cookieVal ?></div>

  <hr>
  <form method="get">
    <label>GET param:</label>
    <input type="text" name="param">
    <button type="submit">Submit GET</button>
  </form>

  <form method="post">
    <label>POST input:</label>
    <input type="text" name="post_input">
    <button type="submit">Submit POST</button>
  </form>
</body>

</html>