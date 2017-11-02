<html>
<head>
    <title>Browse Directories</title>
</head>
<body>
<h1>Browsing</h1>

<?php
// 一个能够过浏览所上传文件的目录的脚本
$current_dir = 'D:/wamp64/uploads';
$dir = opendir($current_dir); // opendir()用于打开所浏览的目录，
// 类似于fopen()打开所读取的文件，知识传递给此函数的参数不是文件名称，而是一个目录名称。
// 该函数返回一个目录句柄，与fopen()相似

echo "<p>Upload directory is $current_dir</p>";
echo '<p>Directory Listing: </p><ul>';

// readdir($dir)从目录中读取文件，当该目录中没有可读的文件时，此函数将返回false，
// 当函数读取一个名为0的文件时，也将返回false，为了确保，可以用!==
while(false !== ($file = readdir($dir))) {
    /**
     * 通常，当前目录. 和上一级目录.. 也会显示在列表中，但是下面我们过滤掉了
     */
    if($file != '.' && $file != '..') {
        $file = iconv('gbk', 'utf-8', $file);
        echo "<li>$file</li>";
    }
}
echo '</ul>';
closedir($dir); // 关闭该目录，类似于fclose()

?>
</body>
</html>
