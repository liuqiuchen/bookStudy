<?php
function create_table($data) {
    echo "<table border='1'>";
    reset($data);
    $value = current($data);
    while($value) {
        echo "<tr><td>$value</td></tr>\n";
        $value = next($data);
    }
    echo '<table/>';
}

$my_array = array('Line one', 'Line two', 'Line three');
create_table($my_array);