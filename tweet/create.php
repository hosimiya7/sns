<?php
// require_once("/php/snsphp/lib/Tweet.php");
require_once("../lib/Request.php");
require_once("../lib/Tweet.php");

$request = new Request;
$content = $request->getPostedValue('content');

$tweet = new Tweet;
$tweet->create($content);

header('Location:../index.php');

