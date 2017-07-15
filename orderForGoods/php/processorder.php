<html>
<head>
    <title>Bob's Auto Parts - Order Results</title>
</head>
<body>
    <h1>Bob's Auto Parts</h1>
    <h2>
        Order Results <br/>
        <?php
            $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT']; // 相对路径
            //echo $DOCUMENT_ROOT; //D:/wamp/www
            
            $fp = @fopen("$DOCUMENT_ROOT/bookStudy/orderForGoods/temp/orders.txt", 'ab');
            if(!$fp) {
                echo "<p><b>Your order could not be processed at this time."
                . "Please try again later.</b></p></body></html>";
                exit;
            }
        
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
            
            /*switch ($find) {
            	case 'a':
            		echo '<p>Regular customer.</p>';
            		break;
            	case 'b':
            		echo '<p>Customer referred by TV advert.</p>';
            		break;
            	case 'c':
            		echo '<p>Customer referred by phone directory.</p>';
            		break;
            	case 'd':
            		echo '<p>Customer referred by word of mouth.</p>'; 
            	default:
            		echo '<p>We do not know how this customer found us.</p>';
            }
            
            $totalmount = $tireqty * TIREPRICE * $discount
                    + $oilqty * OILPRICE
                    + $sparkqty * SPARKPRICE;   
            */
                
            
//            echo 'Subtotal: $'. number_format($totalmount, 2). '<br/>';

//            echo '<p>Your order is as follows: </p>';
            
//            echo 'isset($tireqty): '.isset($tireqty). '<br/>'; // 1
//            echo 'isset($nothere): '.isset($nothere). '<br/>';
//            echo 'empty($tireqry): '.empty($tireqty). '<br/>';
//            echo 'empty($nothere): '.empty($nothere). '<br/>'; // 1
        ?>
    </h2>

</body>
</html>