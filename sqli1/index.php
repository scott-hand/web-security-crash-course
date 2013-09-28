<?php include('../assets/templates/header.php'); ?>

<script>
setInstructions("This lab demonstrates very basic authentication SQL injection. An easy goal is to authenticate as any user. The more difficult goal is to authenticate as " +
"the user with username \"admin\".");
</script>

<form action="index.php" method="post" class="form-signin">
        <h2 class="form-signin-heading">Web Crash Course</h2>
        <h3 class="form-signin-heading">SQL Injection 1</h3>
        <input type="text" id="username" name="username" class="form-control" autocomplete="off" placeholder="Username" autofocus onKeyUp="userNameChanged(this.value)">
        <input type="text" id="password" name="password" class="form-control" autocomplete="off" placeholder="Password" onKeyUp="passwordChanged(this.value)">
        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
        <p class="btn btn-success btn-block" id="hide_button" onClick="javascript:toggleHelp();">Hide Assistance</p>
</form>

<?php
    include '../assets/templates/sql.php';
    $pagename = "SQL Injection Demo 1";

    $query = "select * from users where username = '' and password = ''";
    $last_query = null; 
    $code = "\$row = \$db->query(\"select * from users where username = '\$username' and password = '\$password'\")->fetch();";

    if (isset($_POST['username']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $last_query = "select * from users where username = '$username' and password = '$password'"; 
        $row = $db->query($last_query)->fetch();
        print "<script>$('#username').val('$username');$('#password').val('$password');</script>";
        print "<hr /><p class='lead'>Result:</p>\n";
        if ($row != null)
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
                $('#query')[0].innerHTML = "select * from users where username = '" + username + "' and password = '" + password + "'";
            }
        </script>
HTML;
    print $update_script;
?>

<?php include('../assets/templates/footer.php'); ?>
