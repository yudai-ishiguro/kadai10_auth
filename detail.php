<?php
//１．PHP
session_start();
require_once('funcs.php');
loginCheck();

$id = $_GET["id"];

$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM kadai08_db1_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$v =  $stmt->fetch(); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);




?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">Dive Log表示(select.php)へ戻る</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="jumbotron">
  <fieldset>
                <legend>Dive Log(ここはdetail.php)</legend>
                <label>日付：<input type="date" name="date" value="<?=$v["date"]?>" required></label><br>
                <label>ポイント名：
                    <select name="pointName" required>
                        <option value="">選択してください</option>
                        <option value="point1" <?php if ($v["point_name"] == "point1") echo 'selected'; ?>>ポイント１</option>
                        <option value="point2" <?php if ($v["point_name"] == "point2") echo 'selected'; ?>>ポイント２</option>
                        <option value="point3" <?php if ($v["point_name"] == "point3") echo 'selected'; ?>>ポイント３</option>
                        <option value="point4" <?php if ($v["point_name"] == "point4") echo 'selected'; ?>>ポイント４</option>
                    </select>
                </label><br>
                <label>コメント：<br><textArea name="comment" rows="4" cols="40"><?=$v["comment"]?></textArea></label><br>
                <label>風向き：
                    <select name="windDirection">
                    <option value="北" <?php if ($v["wind_direction"] == "北") echo 'selected'; ?>>北</option>
                    <option value="北北東" <?php if ($v["wind_direction"] == "北北東") echo 'selected'; ?>>北北東</option>
                    <option value="北東" <?php if ($v["wind_direction"] == "北東") echo 'selected'; ?>>北東</option>
                    <option value="東北東" <?php if ($v["wind_direction"] == "東北東") echo 'selected'; ?>>東北東</option>
                    <option value="東" <?php if ($v["wind_direction"] == "東") echo 'selected'; ?>>東</option>
                    <option value="東南東" <?php if ($v["wind_direction"] == "東南東") echo 'selected'; ?>>東南東</option>
                    <option value="南東" <?php if ($v["wind_direction"] == "南東") echo 'selected'; ?>>南東</option>
                    <option value="南南東" <?php if ($v["wind_direction"] == "南南東") echo 'selected'; ?>>南南東</option>
                    <option value="南" <?php if ($v["wind_direction"] == "南") echo 'selected'; ?>>南</option>
                    <option value="南南西" <?php if ($v["wind_direction"] == "南南西") echo 'selected'; ?>>南南西</option>
                    <option value="南西" <?php if ($v["wind_direction"] == "南西") echo 'selected'; ?>>南西</option>
                    <option value="西南西" <?php if ($v["wind_direction"] == "西南西") echo 'selected'; ?>>西南西</option>
                    <option value="西" <?php if ($v["wind_direction"] == "西") echo 'selected'; ?>>西</option>
                    <option value="西北西" <?php if ($v["wind_direction"] == "西北西") echo 'selected'; ?>>西北西</option>
                    <option value="北西" <?php if ($v["wind_direction"] == "北西") echo 'selected'; ?>>北西</option>
                    <option value="北北西" <?php if ($v["wind_direction"] == "北北西") echo 'selected'; ?>>北北西</option>
                    </select>
                </label><br>
                <input type="hidden" name="id" value="<?=$v["id"]?>">
                <input type="submit" value="送信">(update.phpへ。そこからのリダイレクト先はselect.php)
            </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
