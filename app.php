<?php

  $unique_key = $_SERVER['PATH_INFO'];

  if(!$unique_key) {
      $unique_key = uniqid("HiPad");
      $host  = $_SERVER['HTTP_HOST'];
      $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      $extra = "editor.php/" . $unique_key;
      header("Location: http://$host$uri/$extra");
      exit;
  }
  if (substr($unique_key, 0, 1) == "/") {
    $unique_key = substr($unique_key, 1);
  }
  
?>
<!DOCTYPE html> 
<html manifest="../manifest.php/<?= $unique_key ?>"> 
    <head> 
        <meta charset="UTF-8" /> 
        <style type="text/css" media="screen">@import "../jqtouch/jqtouch/jqtouch.css";</style> 
        <style type="text/css" media="screen">@import "../jqtouch/themes/apple/theme.css";</style> 
        <script src="../jqtouch/jqtouch/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"/>
        <script src="../jqtouch/jqtouch/jqtouch.js" type="application/x-javascript" charset="utf-8"/>

        <script type="text/javascript" charset="utf-8"> 
            var jQT = $.jQTouch({
                icon: '../icon.png',
                startupScreen: '../img/startup.png',
                fixedViewport: true,
            });
            
            function editCode() {
                window.location = "../editor.php/<?= $unique_key ?>";
                return false;
            }
            
            $(document).ready(function(){
                $('#editbutton').tap(editCode);
            });
        </script>
    </head>
    <body>
        <div id="jqt">
            <div id="home"> 
                <div class="toolbar"> 
                    <h1>Processing.js for iPad</h1> 
                    <a id="editbutton" class="button leftButton">Edit</a> 
                </div> 
                <div class="canvas" id="program">
                    <canvas id="canvas" width="100%" height="100%"></canvas>
                </div>
            </div>
        </div>

        <script>(function(){
            var init=function() {
                var canvas=document.getElementById("canvas");
                var key = "<?= $unique_key ?>";
                var sketch=localStorage.getItem(key);Processing(canvas,sketch);
            }
            addEventListener("DOMContentLoaded", init, false);
            })();
        </script>

        <script src="../processingjs/processing.js" type="text/javascript" charset="utf-8"></script> 
    </body>
</html>