<?php
require_once '../common/db_references.php';

$name = $_POST['name'];
$password = $_POST['password'];

if((!isset($name)) || (!isset($password))) {
    //echo 'Visitor needs to enter a name and password.';

    ?>
    <h1>Please Log In</h1>
    <p>This page is secret.</p>
    <form action="secretdb.php" method="post">
        <p>Username: <input type="text" name="name"></p>
        <p>Password: <input type="password" name="password"></p>
        <p><input type="submit" name="submit" value="Log In"></p>
    </form>
    <?php
} else {
    $db_user_name = 'root';
    $db_password = '';
    $db_name = 'author';
    $mysql =
mysqli_connect($db_server, $db_user_name, $db_password);
    if(!$mysql) {
        echo 'Cannot connect to database.';
        exit;
    }
    $selected = mysqli_select_db($mysql, $db_name);
    if(!$selected) {
        echo 'Cannot select database';
        exit;
    }
    $query = "select count(*) from authorized_users where name = '".$name."' and
    password = '".sha1($password)."'";

    $result = mysqli_query($mysql, $query);
    if(!$result) {
        echo 'Cannot run query.'.mysqli_error($mysql);
        exit;
    }
    $row = mysqli_fetch_row($result);
    $count = $row[0];

    if($count > 0) {
        echo '<h1>Here it is!</h1>
<p>I bet you are glad you can see this secret page.</p>';
    } else {
        echo '<h1>Go Away!</h1>
<p>You are not authorized to user this resource.</p>';
    }
}
?>
