<?php

include('./dbConfig.php'); // DB設定ファイルをインクルード

$db = db_conn(); // データベース接続を取得

// ここからアップロード処理
$targetDirectory = 'images/';
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDirectory . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)) {
    $arrImageTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $arrImageTypes)) {
        $postImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        if ($postImageForServer) {
            $insert = $db->prepare("INSERT INTO images (file_name) VALUES (:file_name)");
            $insert->bindValue(':file_name', $fileName, PDO::PARAM_STR);
            $insert->execute();
            // 成功メッセージ処理
        } else {
            // アップロード失敗メッセージ処理
        }
    } else {
        // 無効なファイルタイプメッセージ処理
    }
} else {
    // ファイル未選択メッセージ処理
}

header('Location: ./html/index.php', true, 303);
exit();
