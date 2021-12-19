<?php

require_once "./db.php";

if (!empty($_GET['mobile'])) {
    $conn = DB::getInstance()->connect();

    $order_id = rand(10000, 99999);
    $insertData = [
        'order_id' => $order_id,
        'mobile' => $_GET['mobile'],
        'created_at' => date("Y-m-d H:i:s", time()),
        'status' => 0
    ];

    // 把数据存入表中
    $sql = "insert into order_queue(order_id,mobile,created_at,status) values({$insertData['order_id']},'{$insertData['mobile']}','{$insertData['created_at']}',{$insertData['status']});";
    $rst = mysqli_query($conn, $sql);

    if ($rst) {
        echo 'OK';
    } else {
        echo 'error';
    }
}