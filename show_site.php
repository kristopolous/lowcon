<?php
$isAdmin = isset($_GET['admin']);

$id = mysql_real_escape_string($_GET['id']);
function clean($str) {
  if(strlen($str) > 77) {
    return substr($str, 0, 75) . '&hellip;';
  } 
  return $str;
}
?>
<!doctype html>
<title>The Worst Websites On The Whole Fucking Internet, in Pictures.</title>
<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Chris the hipster McKenzie">
<meta name="description" content="a good day is a PBR, a MBP, and #BBB on #AAA. i have to stop coding now because i've sobered up." />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:creator" content="@githater" />
<meta name="twitter:description" content="a good day is a PBR, a MBP, and #BBB on #AAA. i have to stop coding now because i've sobered up." />
<!--
<meta name="twitter:image:src" content="http://indycast.net/images/twit-image.jpg" />
<meta property="og:image" content="http://indycast.net/og-image.php" />
-->
<meta name="twitter:site" content="@githater" />
<meta name="twitter:title" content="a good day is a PBR, a MBP, and #BBB on #AAA. i have to stop coding now because i've sobered up." />
<meta name="twitter:url" content="http://unreadable.website" />
<meta property="og:description" content="a good day is a PBR, a MBP, and #BBB on #AAA. i have to stop coding now because i've sobered up." />
<meta property="og:site_name" content="Unreadable Website" />
<meta property="og:title" content="The Worst Websites On The Whole Fucking Internet, in Pictures." />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://unreadable.website" />
<style>
@font-face {
  font-family: "Comic Sans";
  src: url('comic-sans.ttf') format('truetype'),
    url('comic-sans.woff') format('woff');
}
body{
  text-align:left;
  margin:0;
  padding:0;
}
h1{
  font-weight:normal;
  font-size:4em;
  padding:0;
  margin:0;
}
li {
  position: relative;
  overflow: hidden;
  background: rgba(255,255,255,0.7);
  list-style: none;
  text-align: center;
  padding: 1.25em 0.75em 1em 0.75em;
  margin: 1em;
  border: 1px solid rgba(192,192,192,0.7);
  box-shadow: 0 0 2px 1px rgba(192,192,192,0.5);
  display: inline-block;
}
p { margin: 0.5em}
input{padding: 0.25em}
input[type='text']{border: 2px solid rgba(80,80,80,0.5)}
input[type="submit"]{padding: inherit 2em;}
form { margin-bottom: 1em}
form > * { font-size: 140% }
li img { 
  padding: 0.2em; 
  margin-bottom: 1em; 
}
ul { text-align: left }
a, a:visited { color: darkblue; text-decoration: none }
a:hover { text-decoration: underline;color:blue }
a,#copy{
  font-family: 'Droid Sans', sans-serif;
}
.bmark {
  position:absolute;
  top: -40px;
  display: block;
}
.score {
  font-family: 'Lobster', cursive;
  color: white;
  position: absolute;
  top: -.95em;
  left: -1.5em;
  padding: 1em 2.5em 0.25em 1.5em;
  color: rgb(0,0,0);
  background: rgba(235,230,235,0.8);
  -ms-transform: rotate(-40deg); /* IE 9 */
  -webkit-transform: rotate(-40deg); /* Safari */
  transform: rotate(-40deg);
  text-shadow: 0 0 4px rgba(225,225,255,0.8);
  box-shadow: inset 0 0 4px 4px rgba(250,250,250,0.5);
  font-size: 150%;
  z-index: 100;
}
form,ul {
  display: inline-block;
}
.score small { 
  font-size: 80%; 
  display:inline-block; 
  font-weight: normal; 
  opacity: 0.8;
} 
#fuck{
  position:absolute;
  top:0;
  right:0;
}
#grey{
  background:url('subtle_grunge.png');
}
#header{
  font-family: 'Poiret One', cursive;
  color:#aaa;
  font-weight:normal;
  background:rgba(191,191,191,0.1);
  padding:1em;
}
h1 {
  font-family: 'Poiret One', cursive;
  color:#aaa;
  font-weight:normal;
}
#header p {
  color:#aaa;
  font-size:1.15em
}
.title .url {
  display:block;
  height: 32px; 
  overflow: hidden;
}
.title { 
  border-top: 1px solid rgba(192,192,192,0.6);
  padding: 0.75em 5px 1em;
  line-height:1.5em;
  text-align: left;
  color: #444;
  display: block;
  font-size:11px; 
  width: 290px;
}
.title a { 
  height: 17px; 
  overflow: hidden;
  font-size: 14px; 
  display: block; 
  padding-bottom:0em;
  margin-bottom:0.18em; 
}
#copyright {
  margin-top: 2em;
  padding-bottom: 0.5em;
  font-size:0.75em;
  text-align: center;
  opacity: 0.8;
}
#content {
  background: rgba(255,255,255,0.5);
  padding: 0.5em;
  margin-bottom: 1.5em;
}
#message-container { 
  vertical-align: top;
  z-index: 40;
  display: inline-block;
  position: relative;
}
#message {
  position: absolute;
  left: 148px;
  top: 42px;
  font-family:  "Comic Sans MS", "Comic Sans", cursive;
  font-size: 13px;
  width: 153px;
  height: 78px;
  overflow: hidden;
  text-align: left;
}
#copy {
  font-size: 1.2em;
  display: inline-block;
  width: 30em;
  text-align: left;
  line-height: 1.5em;
}
.fadeout {
  visibility: hidden;
  opacity: 0;
  transition: visibility 0s 1s, opacity 1s linear;
}
.fadein {
  visibility: visible;
  opacity: 1;
  transition: opacity 1s linear;
}
.vote { 
  margin-top: 1em;
  text-align: right;
}
.vote a { 
  color:#000; 
  box-shadow: 1px 1px 2px 0px silver;
  border: 1px solid rgba(64,64,94,0.2);
  background:url('subtle_grunge.png');
  display: inline-block; 
  padding:0.5em 1em; 
  margin:0 0.5em 
}
.vote a:hover { text-decoration: none }
a.up:hover {color: #44a; text-decoration: underline;}
a.down:hover { background: rgba(120,120,255,1); color: white}
a.up { color: #779;font-family: 'Poiret One', cursive}
a.down { background: #f4f4f4;color:#008}
#joke { 
  padding:3px; 
  border-radius: 16px;
  border: 1px solid rgba(0,0,0,100); 
}

@media (max-width: 768px) {
  h1 { font-size: 2.75em }
  ul { margin: 0; padding: 0; }
  #url-input, #copyright {
    text-align: center;
    width: 90%;
  }
  #copy {
    width: 100%
  }
  #joke {
    max-width: 90%;
  }
}
</style>
<div id='grey'>
<div id='header'>
  <a href='/'><h1>Low Contrast Offenders</h1></a>
  <p>who the hell can read this shit</p>
</div>

</div>

<ul>
<?php

  include('db.php');
  $res = $db->query("select * from sites where id = $id");

  while( $row = $res->fetchArray() ) {
    $score = ($row['up'] - $row['down']);
    echo "<li><a class='bmark' name='item" . $row['id'] ."' />.</a>";
    echo "<span style='color:rgba(0,0,0," . ( (100 - $score) / 100) .")' class='score'>" . $score . " <small>pts</small></span>";
    echo "<a target='_blank' href='" . $row['url'] . "'><img src='img/" . md5($row['url']) . "_tn.jpg'></a>";
    echo "<span class='title'><a target='_blank' href='" . $row['url'] . "'>" . clean($row['title']) . "</a><span class='url'>" . $row['url'] . "</span></span>";
    echo "<div class='vote'>";
    echo "<a rel='nofollow' class='down' href='vote.php?dir=down&id=" . $row['id'] ."'>-1 It's fine</a>";
    echo "<a rel='nofollow' class='up' href='vote.php?dir=up&id=" . $row['id'] ."'>+1 Unreadable</a>";
    if($isAdmin) {
      echo "<a href=drop.php?id=" . $row['id'] .">X</a>";
    }
    echo "</div>";
    echo "</li>";
  }
?>
</ul>
<form>
  <div class='input-group'>
    <label for='email'>Email</label>
    <input type='email' name='email'>
  </div>
  <div class='input-group'>
    <label for='name'>Name</label>
    <input type='text' name='name'>
  </div>
  <div class='input-group'>
    <label for='comment'>comment</label>
    <textarea name='comment'></textarea>
  </div>
  <button>Post it!</button>
</form>

<div id="copyright">&copy;2014,2015,2016...9999 blahblahblah. bullshit bullshit bullshit. <a target=_blank href="https://github.com/kristopolous/lowcon">source code</a></div>
<div id="fuck"><a href="https://github.com/kristopolous/lowcon" title="Oh yeah baby, come and git it"><img src="fork.gif"></a></div>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-28399789-4', 'auto');
ga('send', 'pageview');

</script>
