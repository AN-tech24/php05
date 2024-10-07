<?php
$url = $_SERVER['REQUEST_URI'];


    $uri = $_SERVER['REQUEST_URI'];
    if (strpos($uri, 'imageDetail.php') !== false) {
        // imageDetail.phpのリクエストに対する処理
        $imageId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($imageId !== null) {
            // プレースホルダーを使用してSQLを実行
            $sql = "SELECT * FROM images WHERE id = :id";
            $sth = $db->prepare($sql);
            $sth->bindValue(':id', $imageId, PDO::PARAM_INT);
            $sth->execute();
            $data['image'] = $sth->fetch();
        } else {
            // IDが指定されていない場合のエラーハンドリング
            exit("Error: ID is not specified.");
        }
    } else {
        // すべての画像を取得
        $sql = "SELECT * FROM images ORDER BY create_date DESC";
        $sth = $db->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll();
    }
    
    // データを返す
    return $data;

} catch (PDOException $e) {
    // エラーメッセージの表示
    exit('DB Error: ' . $e->getMessage());
}
