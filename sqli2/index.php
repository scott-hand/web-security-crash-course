<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SQLi Demo 2</title>

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
      <form action="index.php" method="post" class="form-signin">
        <h2 class="form-signin-heading">Web Crash Course</h2>
        <h3 class="form-signin-heading">SQL Injection 2</h3>
        <input type="text" name="username" autocomplete="off" id="username" class="input-block-level" placeholder="Username" onKeyUp="userNameChanged(this.value)">
        <input type="text" name="password" autocomplete="off" id="password" class="input-block-level" placeholder="Password">
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
        <p class="btn btn-large btn-success" id="hide_button" onClick="javascript:toggleHelp();">Hide Assistance</p>
        <?php
        include '../lib/db.php';

        session_start();

        $filename = "../lib/data/" . session_id() . ".db";
        $db = file_exists($filename) ? initDB($filename) : initDB($filename);

        if (isset($_POST['username']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $row = $db->query("select * from users where username = '$username'")->fetch();
            print "<hr /><p class='lead'>Result:</p>\n";
            if ($row['password'] === $password)
            {
                $db_name = $row['username'];
                print "Logged in as $db_name.\n";        
                if ($db_name === "admin")
                    print "<br />Congratulations! You passed!\n";
            }
            else
            {
                print "Incorrect username or password.\n";
            }
        } 
        print "<span id='help'><hr />\n";
        print "<p class='lead'>SQL Query so far:</p>\n";
        print "<pre id='query'>select * from users where username=''</pre>\n";
        if (isset($_POST['username']))
            print "<p class='lead' id='query_help'>Last Submitted Query:</p><pre>select * from users where username = '$username'</pre>\n";
 print "<p class='lead'>PHP Code:</p>";
        print "<pre>\$password = \$_POST['password'];\n";
	print "\$row = \$db->query(\"select * from users where username = '\$username'\")->fetch();\n";
	print "if (\$row['password'] === \$password)\n";
        print "...\n";
        print "</pre></span>\n";

        unset($db);

        ?>
      </form>

    </div> <!-- /container -->

    <script src="../assets/js/jquery.js"></script>
    <script>
        var username = "";
        var password = "";
        function userNameChanged(input) {
            username = input;
            updateQuery();
        }

        function updateQuery() {
            $('#query')[0].innerHTML = "select * from users where username = '" + username + "'";
        }

        function toggleHelp() {
            $('#help').slideToggle();
            if ($('#hide_button')[0].innerHTML == "Hide Assistance")
                $('#hide_button')[0].innerHTML = "Show Assistance";
            else
                $('#hide_button')[0].innerHTML = "Hide Assistance";
        }
    </script>
  </body>
</html>

