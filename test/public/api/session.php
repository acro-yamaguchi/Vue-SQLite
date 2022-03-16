<?php 
    header('Content-Type: application/json; charset=utf-8');

    $json = file_get_contents("php://input");
    $req = json_decode($json, true);

    $userId = $req['userId'];
    $pass = $req['pass'];

    try {
        $db = new PDO("sqlite:../../db/happyposition.db");
    } catch (Exception $e) {
        print 'DB接続でエラーが発生';
        print $e->getTraceAsString();
    }

    try {
        $stmt = $db -> prepare('SELECT * FROM users WHERE userId=?');
        $stmt -> bindParam(1, $userId, PDO::PARAM_STR);
        $stmt -> execute();
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    }
    catch (Exeption $e) {
        echo json_encode(array('result' => 'DB接続エラー'));
        exit();
    }

    if(isset($result['userId'])){
        if (password_verify($pass, $result['pass'])) {
            $token = password_hash('token', PASSWORD_DEFAULT);
            echo json_encode(array('result' => $token));
            exit();
        } else {
            echo json_encode(array('result' => 'false'));
        }
    } else {
        echo json_encode(array('result' => 'false'));
    }

?>