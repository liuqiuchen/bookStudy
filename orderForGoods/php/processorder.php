<html>
<head>
    <title>Bob's Auto Parts - Order Results</title>
</head>
<body>
    <h1>Bob's Auto Parts</h1>
    <h2>
        Order Results <br/>
        <?php
            $tireqty = $_POST['tireqty'];
            $oilqty = $_POST['oilqty'];
            $sparkqty = $_POST['sparkqty'];
            //$find = $_POST['find'];
            $shippingAddress = $_POST['shipping_address'];
            
            $totalqty = 0;
            $totalqty = $tireqty + $oilqty + $sparkqty;
//            echo "Items ordered: ". $totalqty. "<br/>";
            
            $totalmount = 0.00;
            
            define('TIREPRICE', 100);
            define('OILPRICE', 10);
            define('SPARKPRICE', 4);
            
            $discount = 0;
            
            if($totalqty == 0) {
                echo 'You did not order anything on the previous page!<br/>';
            } else {
                if($tireqty > 0) {     
                    if($tireqty < 10) {
                        $discount = 0;
                    } elseif (($tireqty >= 10) && ($tireqty <= 49)) {
                        $discount = 5;
                    } elseif (($tireqty >= 50) && ($tireqty <= 99)) {
                        $discount = 10;
                    } elseif ($tireqty >= 100) {
                        $discount = 15;
                    }
                    
                    $tireqty = $tireqty * floatval($discount / 100);
                    echo $tireqty. ' tireqty, discount: '.floatval($discount / 100) . '<br/>';
                }                   
                if($oilqty > 0)
                    echo $oilqty. ' oilqty<br/>';
                if($sparkqty > 0)
                    echo $sparkqty. ' sparkqty<br/>';
            }
            
            echo 'Shipping Address: '. $shippingAddress . '<br/>';

            $date = Date("jS F Y");
            $outputString = $date. "\t" .$tireqty. "tires \t" . $oilqty . "oil\t"
                . $sparkqty . "spark plugs\t\$ " . $totalmount . "\t" . $shippingAddress. "\n";

            $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
            $filePath = "$DOCUMENT_ROOT/bookStudy/orderForGoods/temp/orders.txt";

            if(file_exists($filePath)) $fp = fopen($filePath, 'ab');
            else echo "文件不存在";

            flock($fp, LOCK_EX); // 写操作锁定

            if(!$fp) {
                echo "<p><b>Your order could not be processed at this time.Please
                try again later.</b></p>";
                exit;
            }

            fwrite($fp, $outputString, strlen($outputString));

            flock($fp, LOCK_UN); // 释放已有的锁定
            fclose($fp);
        ?>
    </h2>

</body>
</html>
