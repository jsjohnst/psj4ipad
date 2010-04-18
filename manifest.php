<?php
  $unique_key = $_SERVER['PATH_INFO'];

  header('Content-Type: text/cache-manifest');
  echo "CACHE MANIFEST\n";

  $dir = new RecursiveDirectoryIterator(".");
  foreach(new RecursiveIteratorIterator($dir) as $file) {
    if (!preg_match('/.svn/', $file) && 
        $file->IsFile() &&
        !preg_match('/manifest.php$/', $file))
    {
      if(preg_match('/index.php$/', $file) ) {
          # No-op          
      } else if (isPhpFile($file->getFilename())) {
          echo "." . $file . $unique_key . "\n";
      } else {
          echo "." . $file . "\n";
      }
    }
  }
  
  echo "\nNETWORK:\n";
  echo "../index.php\n";
  
  echo "# UUID: " . $unique_key . "\n";
  
  function isPHPFile($Haystack){
      $Needle = ".php";
      return strrpos($Haystack, $Needle) === strlen($Haystack)-strlen($Needle);
  }
?>
