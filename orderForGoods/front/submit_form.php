<?php
switch($_POST['gender']) {
    case 'Male':
    case 'Female':
    case 'Other':
        echo "<p align='center'>
Congratulations! You are ".$_POST['gender']."
</p>";
        break;
    default:
        echo "<p align='center'>
<span style='color: red;'>WARNING:</span>
Invalid input value for gender specified.
</p>";
        break;
}

// 当输入0和非数字的时候就会报错
$number_of_nights = $_POST['num_nights'];
if($number_of_nights == 0) {
    echo 'Error: Invalid number of nights for the room!';
    exit;
}

echo 'END';





























