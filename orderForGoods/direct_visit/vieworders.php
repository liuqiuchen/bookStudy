<?php
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>
<html>
<head>
    <title>Bob's Auto Parts - Customer Orders</title>
</head>
<body>
    <h1>Bob's Auto Parts</h1>
    <h2>Customer Orders</h2>
    <?php
        $filePath = "$DOCUMENT_ROOT/bookStudy/orderForGoods/temp/orders.txt";
        $fp = fopen($filePath, 'rb');

        flock($fp, LOCK_SH); // lock file for reading

        if(!$fp) {
            echo "<p><b>Your order could not be processed at this time.Please
                try again later.</b></p>";
            exit;
        }

       /* while(!feof($fp)) {
            $order = fgets($fp, 99);
            echo $order . '<br/>';
        }*/

        /**
         * nl2br()函数将输出的\n字符转换成HTML的换行符<br/>
        */
        echo nl2br(fread($fp, filesize($filePath))) . '<br/>';

        // ftell() 函数以字节为单位报告文件指针当前在文件中的位置
        // rewind() 函数将文件指针复位到文件的开始
        echo 'Final position of the file pointer is '. (ftell($fp)) . '<br/>';
        rewind($fp);
        echo 'After rewind, the position is '. (ftell($fp)) . '<br/>';

        flock($fp, LOCK_UN); // release read lock
        fclose($fp);
    ?>
</body>
</html>
