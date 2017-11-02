<html>
<head>
    <title>Uploading...</title>
</head>
<body>
<h1>Uploading file...</h1>

<?php
// 检查在上传尝试中是否有错误代码形成
$userFile_error = $_FILES['user_file']['error'];
if($userFile_error > 0) {
    echo 'Problem: ';
    switch ($userFile_error) {
        case 1:
            echo '文件超过上传最大值。';
            break;
        case 2:
            echo '文件超过最大文件值';
            break;
        case 3:
            echo '文件仅被上传一部分';
            break;
        case 4:
            echo '没有文件被上传';
            break;
        case 6:
            echo '不能上传文件：没有指定的临时文件夹';
            break;
        case 7:
            echo '上传失败：不能写到磁盘。';
            break;
    }
    exit;
}

// 判断文件是否有正确的MIME类型
if($_FILES['user_file']['type'] != 'text/plain') {
    echo 'Problem: file is not text/plain';
    exit;
}

// 解决中文名称乱码
// $_FILES['user_file']['name'] 用户系统中的文件名称
$name = $_FILES['user_file']['name'];
$name=iconv("UTF-8","gb2312", $name);

// 放到我们想移动到的位置
//$upFile = 'D:/wamp64/uploads'.$_FILES['user_file']['name'];
$upFile = '../../../../uploads/'.$name;

// $_FILES['user_file']['tmp_name'] 文件在Web服务器上临时存储的位置
if(is_uploaded_file($_FILES['user_file']['tmp_name']))
{
    if(!move_uploaded_file($_FILES['user_file']['tmp_name'], $upFile)) {
        echo 'Problem: Could not move file to destination directory.';
        exit;
    }
    $name = iconv('gb2312', 'UTF-8', $name);
} else {
    echo 'Problem: Possible file upload attack. Filename: ';
    echo $_FILES['user_file']['name'];
    exit;
}

echo 'File uploaded successfully<br><br>';

// 清除HTML和PHP标记预览上传文件
$fp = fopen($upFile, 'r');
$contents = fread($fp, filesize($upFile));
fclose($fp);

$contents = strip_tags($contents);
$fp = fopen($upFile, 'w');
fwrite($fp, $contents);
fclose($fp);

echo 'Preview of uploaded file contents: <br><hr>';
echo $contents;
echo '<br><hr>';
?>

</body>
</html>