<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-brand">ダイブログ</div><br>
                <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
                <!-- <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div> -->
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <legend>新規登録はコチラ</legend>
    <form name="form1" action="user_insert.php" method="post">
        名前：<input type="text" name="name"></label><br><br>
        ID:<input type="text" name="lid" /><br><br>
        PW:<input type="password" name="lpw" /><br><br>
        <input type="hidden" name="kanri_flg" value="">
        <input type="hidden" name="life_flg" value="">
        <input type="submit" value="新規登録" />
    </form>

    <!-- Main[End] -->
</body>

</html>
