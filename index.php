<?php
    require_once("lib/Tweet.php");
    require_once("lib/Request.php");
    
    $tweet = new Tweet;
    $records = $tweet->getRecords();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sns</title>
    <link rel="stylesheet" href="index.css">
</head>
    <body>

        <?php
            session_start();
            if (isset($_SESSION['id'])) {//ログインしているとき
                $username = $_SESSION['name'];
                $msg = 'こんにちは' . htmlspecialchars($username, \ENT_QUOTES, 'UTF-8') . 'さん';
                $link = '<a href="logout.php">ログアウト</a>';
            } else {//ログインしていない時
                $msg = 'ログインしていません';
                $link = '<a href="login_form.php">ログイン</a>';

            }
        ?>


        <h1><?php echo $msg; ?></h1>
        <?php echo $link; ?>
            <a href="tweet.html">
                <p>
                    呟く
                </p>    
            </a>
        <div class="timeline">
            <?php foreach ($records as $key => $value) : ?>
                <div id="tweet_<?php echo $value['id'] ?>" class="tweet <?php if (!is_null($value['parent_id'])) : ?>reply<?php endif; ?>">
                    <p class="output-name"></p>
                    <p class="output-content"> <?php echo nl2br(htmlspecialchars($value['content'])); ?> </p>
                    <div class="flex-center">
                        <form action="tweet/delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                            <button type="submit" class="clear-decoration button-decoration">削除</button>
                        </form>
                        <div class="form-reply">
                            <form action="tweet/reply.php" method="get">
                                <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                                <button type="submit" class="clear-decoration button-decoration">返信</button>
                            </form>
                        </div>
                    </div>
                    <div class="good-button-wrapper flex-center">
                        <button type="button" data-id="<?php echo $value['id'] ?>" class="clear-decoration good-button"><i class="fas fa-heart fa-2x"></i></button>
                        <span class="good-count" data-id="<?php echo $value['id'] ?>"> <?php echo $value['favorites_count']; ?></span>
                    </div>
                    <p> <?php echo $value['created_at'] ?> </p>
                </div>
            <?php endforeach; ?>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    </body>
</html>