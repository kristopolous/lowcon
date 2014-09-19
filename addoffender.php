<?php
include('db.php');

$raw_url = $_POST['url'];
$url = mysql_real_escape_string($raw_url);
$res = $db->query('select * from sites where url="' . $url . '"');
$row = $res->fetchArray();

if(true || !$row) {
  $md5 = md5($url);
  $site = escapeshellarg($raw_url);
  exec('DISPLAY=:0 cutycapt --min-height=768 --min-width=1024 --url=' . $site . ' --out=img/' . $md5 . '.png');
  exec('convert img/' . $md5 . '.png -resize 300x -crop 300x450+0+0 -resize 300x img/' . $md5 . '_tn.jpg');
  $db->exec('
    insert into sites (url, up, down, view) 
    values("' . $url . '", 1, 0, 1)');
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

