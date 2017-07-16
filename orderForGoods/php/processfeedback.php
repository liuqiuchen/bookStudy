<?php

$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];

$toAddress = '2016968116@qq.com';
$subject = 'Feedback from web site';
$mailContent = "Customer name: $name\n
Customer email: $email\n
Customer comments:\n$feedback";

$fromAddress = "From: webServer@example.com";
if(mail($toAddress, $subject, $mailContent, $fromAddress)) {
    echo 'success';
} else {
    echo 'fail';
}

