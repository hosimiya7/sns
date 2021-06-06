
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
</head>
<body>
    <h1>ログインページ</h1>
    <form action="login.php" method="post">
        <div>
            <label>ユーザーID：<label>
            <input type="text" name="mail" required>
        </div>
        <div>
            <label>パスワード：<label>
            <input type="password" name="pass" required>
        </div>
        <input type="submit" value="ログイン">
    </form>
    <a href="new_user.php">
        新規登録はこちら
    </a>
    <a href="password.html">
        passwordを忘れたら…こちら
    </a>


</body>
</html>