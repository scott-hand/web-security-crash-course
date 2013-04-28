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
      <form action="index.php" method="post" class="form-signin">
        <h2 class="form-signin-heading">CSG Web Crash Course</h2>
        <h3 class="form-signin-heading">XSS / CSRF</h3>
        <input type="text" name="title" autocomplete="off" id="title" class="input-block-level" placeholder="Title">
        <input type="text" name="body" autocomplete="off" id="body" class="input-block-level" placeholder="Message">
        <button class="btn btn-large btn-primary" type="submit">Post</button>
        <a class="btn btn-large btn-warning" href="./?action=clear">Clear Posts</a>
        <?php
        include '../lib/db.php';

        session_start();

        $filename = "../lib/data/" . session_id() . ".db";
        $db = file_exists($filename) ? initDB($filename) : initDB($filename);

        if (isset($_POST['title']))
        {
            $title = $_POST['title'];
            $body = $_POST['body'];
            $stmt = $db->prepare("insert into comments (title, body) values (:title, :body)");
            $stmt->execute(array(":title" => $title, ":body" => $body));
            $stmt->closeCursor();
        } 
        else if (isset($_GET['action']))
            $db->query('delete from comments');

        $query = $db->query("select * from comments");

        $i = 1;
        while (($row = $query->fetch()) != null)
        {
            print "<hr /><p><strong class='lead'>$i. " . $row['title'] . "</strong><br />" . $row['body'] . "</p>\n";
            $i++;
        }

        if ($i == 1)
            print "<br /><br /><strong class='lead'>No Comments.</strong>\n";

        unset($db);
        ?>
      </form>

    </div> <!-- /container -->

  </body>
</html>

