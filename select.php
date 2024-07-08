<?php
session_start();
require_once('funcs.php');
loginCheck();

        //1.  DB接続します
        $pdo = db_conn();

        //２．データ取得SQL作成
        $stmt = $pdo->prepare('SELECT * FROM kadai08_db1_table');
        $status = $stmt->execute();

        //３．データ表示(html内で別の書き方をするのでコメントアウト)
        // $values = "";
        // if($status==false) {
        //   sql_error($stmt);
        // }

        //全データ取得(html内で別の書き方をするのでコメントアウト)
        // $values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
        // $json = json_encode($values,JSON_UNESCAPED_UNICODE);

        $view = '';
        if ($status == false) {
            sql_error($stmt);
        } else {
            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $view .= '<p>';
                // $view .= '<a href="logbook.php?id=' . $r["id"] . '">';
                $view .= h($r['id']) . " " . h($r['date']) . " " . h($r['point_name']). " " . h($r['comment']). " " . h($r['wind_direction']);
                // $view .= '</a>';
                $view .= " ";

                if($_SESSION['kanri'] ===1){
                    $view .= '<a class="btn btn-danger" href="detail.php?id=' . $r['id'] . '">';
                    $view .= '[<i class="glyphicon glyphicon-remove"></i>更新]';
                    $view .= '</a>';
                    $view .= '<a class="btn btn-danger" href="delete.php?id=' . $r['id'] . '">';
                    $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
                    $view .= '</a>';
                }

                $view .= '</p>';
            }
        }

     ?>

<!DOCTYPE html>
<html lang='ja'>
<head>
<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Dive Log表示</title>
<link rel='stylesheet' href='css/range.css'>
<link href='css/bootstrap.min.css' rel='stylesheet'>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id='main'>
<!-- Head[Start] -->
<header>
  <nav class='navbar navbar-default'>
    <div class='container-fluid'>
      <div class='navbar-header'>
      <a class='navbar-brand' href='logbook.php'>ログブック記入（logbook.php）へ戻る</a>
      <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class='container jumbotron'>
      <h3>DB（kadai08_db1_table）の内容を表示</h3>
      <h4>(ここはselect.php)</h4>
      <?= $view ?> 
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
