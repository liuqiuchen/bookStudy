<html>
<head>
    <title>Browse Directories</title>
</head>
<body>
<h1>Browsing</h1>
<?php
// 对上传文件名称进行字母表方式排序
$dir = '../../../../uploads/';
$file1 = scandir($dir);
$file2 = scandir($dir, 1);

echo "<p>Upload directory is $dir</p>";
echo '<p>目录列表按字母顺序排列的，上升的</p><ul>';

function orderScanDir($files) {
    foreach($files as $file) {
        if($file != '.' && $file != '..') {
            $file = iconv('gbk', 'utf-8', $file);
            echo "<li>$file</li>";
        }

    }
    echo '</ul>';
}

orderScanDir($file1);

echo "<p>Upload directory is $dir</p>";
echo '<p>目录列表按字母顺序排列的，下降的</p><ul>';
orderScanDir($file2);

?>

</body>
</html>
