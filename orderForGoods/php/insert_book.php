<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book-O-Rama Book Entry Results</title>
</head>
<body>
<h1>Book-O-Rama Book Entry Results</h1>
<?php
require_once('../common/db_references.php');

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

@ $db = new mysqli($db_server, $db_user_name, $db_password, $db_name);

if(mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.Please try again later.';
    exit;
}

$query = "insert into books values(?, ?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param('sssd', $is_bn, $author, $title, $price);
$stmt->execute();
echo $stmt->affected_rows.' book inserted into database.';
$stmt->close();

