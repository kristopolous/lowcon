<?php
include('db.php');

function get_title($url) {
  static $uaList = Array(
    'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)',
    'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.41 Safari/537.36',
    'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36',
    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:25.0) Gecko/20100101 Firefox/25.0'
  );
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  curl_setopt($ch, CURLOPT_USERAGENT, $uaList[array_rand($uaList)]);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

  $data = curl_exec($ch);
  curl_close($ch);
  // parse the html
  $doc = new DOMDocument();
  @$doc->loadHTML($data);
  $name = '';
  // use the title as the name
  $titleList = $doc->getElementsByTagName("title");
  foreach($titleList as $title) {
    $name = $title->nodeValue;
  }
  return trim($name);
}

$raw_url = $_POST['url'];
$url = $db->escapeString($raw_url);
$res = $db->query('select * from sites where url="' . $url . '"');
$row = $res->fetchArray();

if(!$row) {
  $md5 = md5($url);
  $site = escapeshellarg($raw_url);
  if($_SERVER['HTTP_HOST'] == 'localhost') { 
    $display = ":0";
  } else {
    $display = ":10";
  }
  exec('DISPLAY='.$display.' cutycapt --min-height=768 --min-width=1024 --url=' . $site . ' --out=img/' . $md5 . '.png');

  // only continue if the image was successfully made.
  if(file_exists('img/' . $md5 . '.png')) {
    exec('convert img/' . $md5 . '.png -resize 300x -crop 300x320+0+0 -resize 300x img/' . $md5 . '_tn.jpg');
    $title = $db->escapeString(get_title($url));
    $db->exec('
      insert into sites (url, title, up, down, view) 
      values("' . $url . '", "' . $title . '", 1, 0, 1)');

    if($db->lastErrorCode() !== 0) {
      echo $db->lastErrorMsg();
      exit(0);
    }
  } else {
    echo "Oh shit ... couldn't get screen shot.";
    die;
  }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

