<?php
// 使用其他Web站点的数据

$content=file_get_contents("http://www.jb51.net/");
$pos = strpos($content,'utf-8');
if($pos===false){$content = iconv("gbk","utf-8",$content);}
$postb=strpos($content,'<title>')+7;
$poste=strpos($content,'</title>');
$length=$poste-$postb;
echo substr($content,$postb,$length);



















