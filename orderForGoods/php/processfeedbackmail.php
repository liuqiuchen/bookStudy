<?php

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$feedback = trim($_POST['feedback']);

$toAddress = '2016968116@qq.com';
$subject = 'Feedback from web site';
$mailContent = "Customer name: $name\n
Customer email: $email\n
Customer comments:\n$feedback";

$from = "webServer@example.com";

$email_array = explode('@', $email);

if(strtolower($email_array[1]) == 'qq.com') {
    $from = 'fromQQFeedback@example.com';
} else {
    $from = 'fromOtherFeedback@example.com';
}

if(strstr($feedback, 'shop'))
    $from = 'retail@example.com';
else if(strstr($feedback, 'delivery'))
    $from = 'fulfillment@example.com';

$fromAddress = "From: $from";

if(mail($toAddress, strtoupper($subject), $mailContent, $fromAddress)) {
    echo 'success<br/>';
} else {
    echo 'fail<br/>';
}































