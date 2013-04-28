<?php
session_start();

if (isset($_POST['price']))
{
    $price = $_POST['price'];
    if ($price > $_SESSION['money'])
        print "Not enough money. You only have $" . $_SESSION['money'] . ".";
    else
    {
        $_SESSION['money'] -= $price;
        print "Bought item. You have $" . $_SESSION['money'] . " remaining.";
        if ($_POST['item'] === 'item4')
            print "<br />Congratulations, you win this one!\n";
    }
}
?>
