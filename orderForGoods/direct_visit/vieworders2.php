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
    $orders = file($filePath);
    $numberOfOrders = count($orders);

    if($numberOfOrders == 0) {
        echo "<p><b>No orders pending.Please try again later.</b></p>";
    }

    echo "<table border='1'>
            <tr>
                <th bgcolor='#ccccff'>Order Date</th>
                <th bgcolor='#ccccff'>Tires</th>
                <th bgcolor='#ccccff'>Oil</th>
                <th bgcolor='#ccccff'>Spark Plugs</th>
                <th bgcolor='#ccccff'>Total</th>
                <th bgcolor='#ccccff'>Address</th>
            </tr>";

    for($i = 0; $i < $numberOfOrders;$i++) {
        $line = explode("\t", $orders[$i]);
        $line[1] = intval($line[1]);
        $line[2] = intval($line[2]);
        $line[3] = intval($line[3]);

        echo "<tr>
                <td>$line[0]</td>
                <td align='right'>$line[1]</td>
                <td align='right'>$line[2]</td>
                <td align='right'>$line[3]</td>
                <td align='right'>$line[4]</td>
                <td align='right'>$line[5]</td>
        </tr>";
    }

    echo "</table>";

    ?>

</body>
</html>
