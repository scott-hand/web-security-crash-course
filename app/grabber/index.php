<?php include('../assets/templates/header.php'); ?>
<script>
setInstructions("This cookie grabber is meant to be used to test cookie stealing XSS attacks. It is not designed to be used on other people, as it only displays cookies that were entered with the "
+ "same PHP session. To store some value, append ?val=DATA to the url, where DATA may be information such as cookies. To view cookies, visit the page with no parameters.");
</script>

        <h1>Cookie Grabber Results (<a href="?clear=clear">Clear</a>)</h1>
        <hr />
        <?php
            session_start();
            $id = base64_encode(base64_encode(session_id()));

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

<?php include('../assets/templates/footer.php'); ?>
