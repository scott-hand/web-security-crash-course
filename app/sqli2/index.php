<?php include('../assets/templates/header.php'); ?>

<script>
setInstructions("This is another authentication bypass injection demo. In this one, the authentication logic is written in the PHP code rather than the previous one that did it directly in the "
    +"database query.");
</script>

<form action="index.php" method="post" class="form-signin">
        <h2 class="form-signin-heading">Web Crash Course</h2>
        <h3 class="form-signin-heading">SQL Injection 2</h3>
        <input type="text" id="username" name="username" class="form-control" autocomplete="off" placeholder="Username" autofocus onKeyUp="userNameChanged(this.value)">
        <input type="text" id="password" name="password" class="form-control" autocomplete="off" placeholder="Password">
        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
        <p class="btn btn-success btn-block" id="hide_button" onClick="javascript:toggleHelp();">Hide Assistance</p>
</form>

<?php
    include '../assets/templates/sql.php';
    $pagename = "SQL Injection Demo 2";

    $query = "select * from users where username = ''";
    $last_query = null; 
    $code = "\$password = \$_POST['password'];\n\$row = \$db->query(\"select id, username, password from users where username = '\$username'\")->fetch();\nif (\$row['password'] === \$password)\n...\n";

    if (isset($_POST['username']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $last_query = "select * from users where username = '$username'";
        $row = $db->query("select * from users where username = '$username'")->fetch();
        print "<script>$('#username').val('$username');$('#password').val('$password');</script>";
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
    print "<br/>";
    helper($query, $code, $last_query);

    unset($db);

    $update_script = <<<HTML
        <script>
            function updateQuery() {
                $('#query')[0].innerHTML = "select * from users where username = '" + username + "'";
            }
        </script>
HTML;
    print $update_script;
?>
<?php include('../assets/templates/footer.php'); ?>
