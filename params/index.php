<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Parameter Tampering Demo</title>
    <script src="../assets/js/jquery.js"></script>

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
        <h3 class="form-signin-heading">Parameter Tampering</h3>
        <label class="radio">
            <input type="radio" name="item" id="item1" value="item1" checked>
            Cheap thing 1 - $5.00
        </label>
        <label class="radio">
            <input type="radio" name="item" id="item2" value="item2">
            Cheap thing 2 - $15.00
        </label>
        <label class="radio">
            <input type="radio" name="item" id="item3" value="item3">
            Cheap thing 3 - $25.00
        </label>
        <label class="radio">
            <input type="radio" name="item" id="item4" value="item4">
            Bicycle - $1,000,000.00
        </label>
        <button class="btn btn-large btn-primary" type="submit">Buy</button>
        <a class="btn btn-large btn-warning" href="./?reset=reset">Reset</a>
        <?php
            session_start();

            if (!isset($_SESSION['money']))
                $_SESSION['money'] = 50.00;

            print "<hr/><p id='response'>Current Balance: $" . $_SESSION['money'] . "</p>\n";

            if (isset($_POST['item']))
            {
                $price = 0.0;
                if ($_POST['item'] == 'item1')
                    $price = 5.0;
                else if ($_POST['item'] == 'item2')
                    $price = 15.0;
                else if ($_POST['item'] == 'item3')
                    $price = 25.0;
                else if ($_POST['item'] == 'item4')
                    $price = 1000000.0;
                print "<script>$.post('spend.php', { price: $price, item: '" . $_POST['item'] . "' }, function (data, response) { $('#response').html(data); });</script>\n";
            }
            else if (isset($_GET['reset']))
            {
                $_SESSION['money'] = 50.0;
                header('Location: ./');
                exit;
            }
        ?>
      </form>

    </div> <!-- /container -->

  </body>
</html>

