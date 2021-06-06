<?php
require_once("Tweet.php");
require_once("Request.php");

    $request = new Request;
    $name = $request -> getPostedValue('name');
    $content = $request -> getPostedValue('content');
    $parent_id = $request -> isPost() === true ? $request -> getPostedValue('parent_id') : $request -> getQueryValue('id');

    $tweet = new Tweet;
    if($tweet -> create($content,(int)$parent_id) === true){
      header('Location:../index.php');
    }

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>reply</title>
  <!-- <link rel="stylesheet" href="stylesns.css"> -->
</head>
<body>
  <header>
  </header>
  <main>
    <div class="input-form form-text">
    <form action="reply.php" method="post">
      <!-- <div class="text-wrapper"> -->
      <!-- <p>name:</p>
        <input type="text" name="name" required>
      </div> -->
      <div class="textarea-wrapper">
        <textarea name="content" id="" cols="30" rows="10" required></textarea>
      </div>
      <div class="btn">
        <input type="hidden" name="parent_id" value=<?php echo $parent_id?>>
        <button type="submit" class="clear-decoration button-decoration">送信</button>
      </div>
    </div>
    </form>
  </main>
  <footer>
  </footer>
</body>
</html>