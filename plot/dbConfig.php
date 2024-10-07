<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){
    try {
        //  $db_name = "imageposting";    //データベース名
        //  $db_id   = "root";      //アカウント名
        //  $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード"root"に修正してください。
        //  $db_host = "localhost"; //DBホスト
        //  $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
        // $pdo = new PDO('mysql:dbname=gs_story;charset=utf8;host=localhost','root','');
        $pdo = new PDO('mysql:dbname=gsdeploy_unit5;charset=utf8;host=mysql80.gsdeploy.sakura.ne.jp','gsdeploy','8130mama');
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}
