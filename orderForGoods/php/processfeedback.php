<?php
// 原样输出
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$feedback = trim($_POST['feedback']); // "sss\ss'哈哈' "呜呜"\n"

$email_array = explode('@', $email);
/**
array (size=2)
0 => string 'erbao' (length=5)  // 用户名称
1 => string 'qq.com' (length=6) // 域名
 */
var_dump($email_array);

// addslashes 特殊字符转义
$name1 = addslashes(trim($_POST['name']));
$feedback1 = addslashes(trim($_POST['feedback'])); // "sss\\ss\'哈哈\' \"呜呜\"\\n"

// stripslashes 自动去掉所有斜杠\
$name2 = stripslashes(trim($_POST['name']));
$feedback2 = stripslashes(trim($_POST['feedback'])); // "sssss'哈哈' "呜呜"n"
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php ucwords('process feedback');?></title>
</head>
<body>

<h3>Customer feedback</h3>
<p>Your customer <?php echo $name;?> representative told me,</p>
<p>"<?php echo $feedback;?>"</p>

<h3>After addslashes</h3>
<p>Your customer <?php echo $name1;?> representative told me,</p>
<p>"<?php echo $feedback1;?>"</p>

<h3>After stripslashes</h3>
<p>Your customer <?php echo $name2;?> representative told me,</p>
<p>"<?php echo $feedback2;?>"</p>


</body>
</html>






























