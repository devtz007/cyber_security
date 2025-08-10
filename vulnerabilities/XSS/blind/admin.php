<!-- admin.php -->
<!DOCTYPE html>
<html>
<head><title>Admin View</title></head>
<body>
  <h1>Support Tickets</h1>
  <div style="padding: 1em; background: #f2f2f2; border: 1px solid #ccc;">
    <?php
      $data = file_get_contents("data.txt");
      echo nl2br($data); // BLIND XSS SINK
    ?>
  </div>
</body>
</html>
