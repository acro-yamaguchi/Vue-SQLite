<?php 
    header('Content-Type: application/json; charset=utf-8');

    $json = file_get_contents("php://input");
    $req = json_decode($json, true);

    $title = $req['title'];
    $summary = $req['summary'];
    $content = $req['content'];
    $image = $req['image'];
    $create_at = date("Y-m-d H:i:s");

    try {
        $db = new PDO("sqlite:../../db/happyposition.db");
        // 取得（SELECT）
        $stmt = $db->prepare("INSERT INTO news (
            title, summary, content, create_at, image
        ) VALUES (
            :title, :summary, :content, :create_at, :image
        )");

        $stmt->bindParam( ':title', $title, PDO::PARAM_STR);
        $stmt->bindParam( ':summary', $summary, PDO::PARAM_STR);
        $stmt->bindParam( ':content', $content, PDO::PARAM_STR);
        $stmt->bindParam( ':create_at', $create_at, PDO::PARAM_STR);
        $stmt->bindParam( ':image', $image, PDO::PARAM_STR);

        $result = $stmt->execute();

        if($result) {
            echo json_encode(array('result' => true));
        } else {
            echo json_encode(array('result' => false));
        }
    }
    catch(Exception $e) {
        print 'DB接続でエラーが発生';
        print $e->getTraceAsString();
    }
    finally {
        $db = null;
    }
?>