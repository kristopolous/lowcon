<?php
include('db.php');

$raw_url = $_POST['url'];
$url = $db->escapeString($raw_url);
$res = $db->query('select * from sites where url="' . $url . '"');
$row = $res->fetchArray();

if(!$row) {
  $md5 = md5($url);
  $site = escapeshellarg($raw_url);
  exec('DISPLAY=:10 cutycapt --min-height=768 --min-width=1024 --url=' . $site . ' --out=img/' . $md5 . '.png');
  // only continue if the image was successfully made.

  if(file_exists('img/' . $md5 . '.png')) {
    exec('convert img/' . $md5 . '.png -resize 300x -crop 300x320+0+0 -resize 300x img/' . $md5 . '_tn.jpg');
    $db->exec('
      insert into sites (url, up, down, view) 
      values("' . $url . '", 1, 0, 1)');
  } else {
    echo "Oh shit ... couldn't get screen shot.";
    die;
  }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

