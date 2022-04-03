<?php 
    header('Content-Type: application/json; charset=utf-8');

    $json = file_get_contents("php://input");
    $req = json_decode($json, true);

    $image = $req['image'];
    $create_at = date("Y-m-d H:i:s");

    try {
        $db = new PDO("sqlite:../../../db/happyposition.db");
        // 取得（SELECT）
        $stmt = $db->prepare("INSERT INTO top_image (
            image, create_at
        ) VALUES (
            :image, :create_at,
        )");

        $stmt->bindParam( ':image', $image, PDO::PARAM_STR);
        $stmt->bindParam( ':create_at', $create_at, PDO::PARAM_STR);

        $result = $stmt->execute();

        if($result) {
            echo true;
        } else {
            echo false;
        }
    }
    catch(Exception $e) {
        print 'DB接続でエラーが発生';
        print $e->getTraceAsString();
        echo false;
    }
    finally {
        $db = null;
    }
?>