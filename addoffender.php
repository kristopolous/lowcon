<?php
include('db.php');
ini_set('output_buffering', 'off');
while (@ob_end_flush());
ini_set('implicit_flush', true);
ob_implicit_flush(true);
header('Cache-Control: no-cache'); // recommended to prevent caching of event data.
 
for($i = 0; $i < 1000; $i++) {
  echo ' ';
}
         
function report($what) {
  echo '<h3>' .$what. '</h3>';
  flush();
}

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
    $name = iconv('UTF-8', 'ASCII//TRANSLIT', $title->nodeValue);
  }
  return trim($name);
}

$raw_url = $_POST['url'];

if(empty($raw_url)) {
  echo "Hey dipshit, you need to enter stuff into that box. What the hell is wrong with you?";
  exit(0);
}

if(strpos(strtolower($raw_url), 'http') === false) {
  // if we omitted the protocol reference this is fine.
  $raw_url = 'http://' . $raw_url;
}

report("Ok I'm doing it ... just wait");

$url = $db->escapeString($raw_url);
$res = $db->query('select * from sites where url="' . $url . '"');
$row = $res->fetchArray();

if(!$row) {
  $md5 = md5($url);
  $parts = explode('#', $raw_url);
  $site = escapeshellarg($parts[0]);
  if($_SERVER['HTTP_HOST'] == 'localhost') { 
    $display = ":0";
  } else {
    $display = ":10";
  }
  report("I have to start a browser and everything ... come on now.");

  $cmd = 'DISPLAY='.$display.' cutycapt --min-height=768 --min-width=1024 --url=' . $site . ' --out=img/' . $md5 . '.png';
  echo $cmd;
  exec($cmd);

  report("Ok now I need to resize the screen shot...");

  // only continue if the image was successfully made.
  if(file_exists('img/' . $md5 . '.png')) {
    exec('convert img/' . $md5 . '.png -resize 300x -crop 300x320+0+0 -resize 300x img/' . $md5 . '_tn.jpg');

    // remove the big file
    unlink('img/' . $md5 . '.png');

    $title = $db->escapeString(get_title($url));
    $qstr = 'insert into sites (url, title, up, down, view) 
      values("' . $url . '", "' . $title . '", 1, 0, 1)';
    echo $qstr;
    $db->exec($qstr);

    if($db->lastErrorCode() !== 0) {
      echo $db->lastErrorMsg();
      exit(0);
    }
  } else {
    report("Oh shit ... couldn't get screen shot.");
    die;
  }
}
report("And now you go back to where you came from! farewell"); 
sleep(1);
echo "<script>document.location='/?what=new-stuff-thats-what&sort=new-shit'</script>";
flush();
