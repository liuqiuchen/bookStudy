<?php
// 显示关于Page类的信息
require_once('../common/includes/Page.inc');

$class = new ReflectionClass('Page');
echo '<pre>'.$class.'</pre>';