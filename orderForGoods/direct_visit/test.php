<?php
/**
 * 在任何情况下，如果目标关键字不在字符串中，strpos()或strrpos()都将返回false
 * ，因此，这就可能带来新的问题，因为false在一个如PHP这样的弱类型语言中等于0，
 * 也就是说字符串的第一个字符。
 * 可以使用运算符 === 来测试返回值，从而避免这个问题
 */
$test = 'Hello world';
$result = strpos($test, 'H');
if($result === false) {
    echo 'Not found';
} else {
    echo 'Found at position: '. $result;
}


