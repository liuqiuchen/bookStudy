<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table border="0" cellpadding="3">
        	<tr>
        		<td bgcolor="#cccccc" align="center">Distance</td>
        		<td bgcolor="#cccccc" align="center">Cost</td>
        	</tr>
        	<?php 
        	$distance = 50;
        	while($distance <= 250) {
        		echo "<tr>
        			  <td align=\"right\">". $distance ."</td>
        			  <td align=\"right\">". ($distance / 10). "</td>
        			  </tr>\n";
        		$distance += 50;
        	}
        	?>
        </table>
    </body>
</html>





















