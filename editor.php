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
<html manifest="../manifest.php/<?= $unique_key ?>"> 
    <head> 
        <meta charset="UTF-8" /> 
        <style type="text/css" media="screen">@import "../jqtouch/jqtouch/jqtouch.css";</style> 
        <style type="text/css" media="screen">@import "../jqtouch/themes/apple/theme.css";</style> 
        <script src="../jqtouch/jqtouch/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="../jqtouch/jqtouch/jqtouch.js" type="application/x-javascript" charset="utf-8"></script>

        <style type="text/css">
          html, body, #jqt, #home, #code_editor { height: 98%; }         
          textarea { height: 100%; width: 100%; font-family: monospace; font-size: 14px; -webkit-user-select: auto; }
        </style>

        <script type="text/javascript" charset="utf-8"> 
            var jQT = $.jQTouch({
                icon: '../icon.png',
                startupScreen: '../img/startup.png',
            });

            function saveCode() {
                var key = "<?= $unique_key ?>";
                localStorage.removeItem(key);
                localStorage.setItem(key, $('#home textarea').val());
            }
            function runCode() {
                window.location = "../app.php/<?= $unique_key ?>";
                return false;
            }
            function newFile() {
                window.location = "../index.php";
                return false;
            }
            function saveAndRun() {
                saveCode();
                return runCode();
            }
            
            function genSkeleton() {
                $('#home textarea').val("// Add your code below. If you're running this in Mobile\n" +
                                        "// Safari, click Save & Run, then add this app to your home\n" +
                                        "// screen (click +) to save it as an app.\n\n" +
                                        "void setup() {\n" +
                                        "  size(1024, 600);\n"+
                                        "}\n\n"+
                                        "void draw() {\n" +
                                        "  background(50);\n"+
                                        "}");
                saveCode();
            }

            $(document).ready(function(){
                $('#savebutton').tap(saveAndRun);
                $('#newbutton').tap(newFile);

                var key = "<?= $unique_key ?>";
 
                if (localStorage.getItem(key)) {
                    $('#home textarea').val(localStorage.getItem(key));
                } else {
                    genSkeleton();
                }
            });

        </script>
    </head>
    <body>
        <div id="jqt">
            <div id="home"> 
                <div class="toolbar"> 
                    <h1>Processing.js for iPad</h1> 
                    <a id="savebutton" class="button leftButton">Save &amp; Run</a> 
                    <a id="newbutton" class="button">New</a> 
                </div> 
                <div class="form" id="code_editor">
                    <textarea id="editor" class="edit"></textarea>
                </div>
            </div>
        </div>
    </body>
</html>
