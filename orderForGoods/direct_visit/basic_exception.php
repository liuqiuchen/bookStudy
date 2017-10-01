<?php
try {
    throw new Exception('A terrible error has occurred', 42);
} catch (Exception $e) { // Exception类的异常
    /*echo 'Exception '. $e->getCode()
        .': '.$e->getMessage().'<br/>'
        .'in '.$e->getFile().' on line '.
        $e->getLine().'<br/>';
    var_dump($e->getTrace());*/
    echo $e;
}
/**
Exception 42: A terrible error has occurred
in D:\wamp64\www\bookStudy\orderForGoods\direct_visit\basic_exception.php on line 3
 */