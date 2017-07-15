<?php
$pictures = array();
for($i = 1;$i <= 12;$i++) {
    array_push($pictures, "$i.jpg");
}
shuffle($pictures);
?>
<html>
<head>
    <title>Bob's Auto Parts</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<div align="center">
    <table width="100%">
        <tr>
            <?php
                for($i = 0;$i < 3;$i++) {
                    echo "<td align='center'><img src='./imgs/".$pictures[$i]."'></td>";
                }
            ?>
        </tr>
    </table>
</div>
<button><a href="javascript:window.location.reload(true)">refresh</a></button>
</body>
</html>








































