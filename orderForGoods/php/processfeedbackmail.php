<?php

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$feedback = trim($_POST['feedback']);

if(!preg_match('/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $email)) {
    echo '<p style="color:red;">That is not a valid email address.</p>
          <p style="color:red;">Please return to the previous page and try again.</p>';
    exit;
}

$offColor = ['fuck', 'sex'];
$feedback = str_replace($offColor, '%!@', $feedback);

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

if(preg_match('/shop|customer service|retail/', $feedback))
    $from = 'retail@example.com';
else if(preg_match('/deliver|fulfill/', $feedback))
    $from = 'fulfillment@example.com';
else if(preg_match('/bill|account/', $feedback))
    $from = 'accounts@example.com';

if(preg_match('/bigcustomer\.com/', $email)) {
    $from = 'bob@example.com';
}

$fromAddress = "From: $from";

if(mail($toAddress, strtoupper($subject), $mailContent, $fromAddress)) {
    echo 'success<br/>';

    /**
     * * POSIX → PCRE
     * ereg_replace() → preg_replace()
     * ereg() → preg_match()
     * eregi_replace() → preg_replace()
     * eregi() → preg_match()
     * split() → preg_split()
     * spliti() → preg_split()
     * sql_regcase() → No equivalent
     */

    // 分割邮箱地址，并打印出来
    $emailArr = preg_split('/\.|@/', $email);
    while(list($key, $value) = each($emailArr)) {
        echo '<br/>'.$value;
    }
} else {
    echo 'fail<br/>';
}



