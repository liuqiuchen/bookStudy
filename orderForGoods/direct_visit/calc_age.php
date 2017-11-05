<?php
/**
 * 生日计算并不是时间戳的很好应用。这个例子只适用于在所有平台下计算1970年以后出生的人的生日。Windows
 * 无法管理1970年以前的时间戳。即使这样，这种计算也不非常准确。
 */
date_default_timezone_set('Asia/Shanghai');
// 根据某人的生日计算年龄
$day = 27;
$month = 5;
$year = 1963;
$bdayunix = mktime(0,0,0,$month, $day, $year);
$nowunix = time();
$ageunix = $nowunix - $bdayunix;
$age = floor($ageunix / (365*24*60*60)); // convert from seconds to years
echo "Birthday is $year, $month, $day, Age is $age.";