<?php include('../assets/templates/header.php'); ?>

<script>
setInstructions("This exercise tests the ability to exploit trust that is placed in user controlled parameter passing. The goal is to buy a $1,000,000 bicycle despite starting with $50. If you " +
    "blow it, just hit reset to start back at $50.");
</script>

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

<?php include('../assets/templates/footer.php'); ?>
