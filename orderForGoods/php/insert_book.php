<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book-O-Rama Book Entry Results</title>
</head>
<body>
<h1>Book-O-Rama Book Entry Results</h1>
<?php
$is_bn = $_POST['isbn'];
$author = $_POST['author'];
$title = $_POST['title'];
$price = $_POST['price'];

if(!$is_bn || !$author || !$title || !$price) {
    echo 'You have not entered all the required details.<br/>
    Please go back and try again.';
    exit;
}

if(!get_magic_quotes_gpc()) {
    $is_bn = addslashes($is_bn);
    $author = addslashes($author);
    $title = addslashes($title);
    $price = doubleval($price);
}

@ $db = new mysqli('localhost', 'root', '', 'books');

if(mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.Please try again later.';
    exit;
}

$query = "insert into books values 
('".$is_bn."', '".$author."', '".$title."', '".$price."')";

$result = $db->query($query);

if($result) {
    echo $db->affected_rows.' book inserted into database.';
} else {
    echo 'An error has occurred.The item was not added.';
}

$db->close();

