<?php
require_once("lib/DB.php");


session_start();
$mail = $_POST['mail'];
$db = new DB;
$dbh = $db -> getDBHandler();

$sql = "SELECT * FROM users WHERE mail = :mail";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':mail', $mail);
$stmt->execute();
$member = $stmt->fetch();
//指定したハッシュがパスワードにマッチしているかチェック
    if ($member && password_verify($_POST['pass'], $member['pass'])) {
        //DBのユーザー情報をセッションに保存
        $_SESSION['id'] = $member['id'];
        $_SESSION['name'] = $member['name'];
        $msg = 'ログインしました。';
        $link = '<a href="index.php">ホーム</a>';
    } else {
        $msg = 'ユーザーIDもしくはパスワードが間違っています。';
        $link = '<a href="login_form.php">戻る</a>';
    }


?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>