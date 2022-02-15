<?php 
    $date = date('Y年n月j日'); 
    $ary = array('message'=>'Hello', 'name'=>'John', 'date'=>$date);

    echo json_encode($ary, JSON_UNESCAPED_UNICODE)
?>