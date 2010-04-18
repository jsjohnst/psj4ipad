<?php

  $unique_key = uniqid("HiPad");
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = "editor.php/" . $unique_key;
  header("Location: http://$host$uri/$extra");
  exit;
?>
