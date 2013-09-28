<?php include('../assets/templates/header.php'); ?>
<script>
setInstructions("This serves mostly as a lab to test XSS and CSRF vulnerabilities. It simulates stored XSS attacks through unsanitized comment fields.");
</script>

      <form action="index.php" method="post" class="form-signin">
        <h2 class="form-signin-heading">Web Crash Course</h2>
        <h3 class="form-signin-heading">XSS / CSRF</h3>
        <input type="text" name="title" autocomplete="off" id="title" class="form-control" placeholder="Title">
        <input type="text" name="body" autocomplete="off" id="body" class="form-control" placeholder="Message">
        <button class="btn btn-primary btn-block" type="submit">Post</button>
        <a class="btn btn-warning btn-block" href="./?action=clear">Clear Posts</a>
        <?php
        include '../lib/db.php';
        $pagename = "XSS Demo";

        session_start();

        $filename = "../lib/data/" . base64_encode(base64_encode(session_id())) . ".db";
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

<?php include('../assets/templates/footer.php'); ?>
