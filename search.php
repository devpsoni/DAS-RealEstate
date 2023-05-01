<?php
session_start();
$search = $_POST['search'];
$buyRent = $_POST['buyRent'];
$budget = $_POST['budget'];

$_SESSION['search'] = $search;
$_SESSION['buyRent'] = $buyRent;
$_SESSION['budget'] = $budget;

header('Location: listings.html');
exit;
?>
