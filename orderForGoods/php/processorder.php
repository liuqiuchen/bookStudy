<html>
<head>
    <title>Bob's Auto Parts - Order Results</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>
    Order Results <br/>
    <?php
    require_once('../common/includes/file_exceptions.php');

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

    try {
        if(!($fp = fopen($filePath, 'ab')))
            throw new fileOpenException();
        if(!(flock($fp, LOCK_EX))) // 写操作锁定
            throw new fileLockException();
        if(!(fwrite($fp, $outputString, strlen($outputString))))
            throw new fileWriteException();
        flock($fp, LOCK_UN); // 释放已有的锁定
        fclose($fp);
        echo '<p>Order written.</p>';
    } catch (fileOpenException $foe) {
        echo '<p><strong>Orders file could not be opened.Please contact our webmaster for help.</strong></p>';
    } catch (Exception $e) {
        echo "<p><b>Your order could not be processed at this time.Please
                try again later.</b></p>";
    }


    ?>
</h2>

</body>
</html>
