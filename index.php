<?php
$isAdmin = isset($_GET['admin']);

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
<style>
body{text-align:center;margin:0;padding:0}
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
}
.score small { font-size: 80%; display:inline-block; font-weight: normal; opacity: 0.8} 
#fuck{position:absolute;top:0;right:0}
#grey{background:url('subtle_grunge.png')}
#header{font-family: 'Poiret One', cursive;color:#aaa;font-weight:normal;background:rgba(191,191,191,0.1);padding:1em}
#header p {color:#aaa;font-size:1.15em}
.title { 
border-top: 1px solid rgba(192,192,192,0.6);
padding: 0.75em 5px 1em;
line-height:1.5em;

text-align: left;color: #444;display: block;font-size:11px; width: 290px }
.title a { font-size: 14px; display: block; padding-bottom:0.15em }
h1{font-weight:normal;font-size:4em;padding:0;margin:0}
li {
  overflow: hidden;
  position: relative;
  background: rgba(255,255,255,0.7);
  list-style: none;
  text-align: center;
  padding: 1.25em 0.75em 1em 0.75em;
  margin: 1em;
  box-shadow: 0 0 3px 2px rgba(127,127,127,0.5);
  display: inline-block;
}
input{padding: 0.25em}
input[type='text']{border: 2px solid rgba(80,80,80,0.5)}
input[type="submit"]{padding: inherit 2em;}
form { margin-bottom: 1em}
form > * { font-size: 140% }
li img { padding: 0.2em; margin-bottom: 1em }
#copyright {
  margin-top: 2em;
  padding-bottom: 0.5em;
  font-size:0.75em;
  opacity: 0.8;
}
#content {
  background: rgba(255,255,255,0.5);
  padding: 0.5em;
  margin-bottom: 1.5em;
}
a, a:visited { color: darkblue; text-decoration: none }
a:hover { text-decoration: underline;color:blue }
a,#copy{
  font-family: 'Droid Sans', sans-serif;
}
@font-face {
  font-family: "Comic Sans";
  src: url('comic-sans.ttf') format('truetype'),
    url('comic-sans.woff') format('woff');
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
ul { text-align: left }
.vote { margin-top: 1em;
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
#joke { padding:3px; border-radius: 16px;border: 1px solid rgba(0,0,0,100) }
p { margin: 0.5em}
</style>
<div id='grey'>
<div id=header>
  <h1>Low Contrast Offenders</h1>
  <p>who the hell can read this shit</p>
</div>
<div id='content'>
  <div id='message-container'>
    <img id='joke' src='hipster.png'>
    <div id="message"></div>
  </div>
  <div id="copy">
    <p>Many sites use colors and ridiculously skinny fonts which make their content quite difficult to read on a variety of devices.</p>
    <p>This has gone on too long.</p>
    <p>Expose low-contrast impossible to read sites.</p>
    <p>Here's a nickel kid. Get <a href="guide.html">yourself a better website</a>.</p>
  </div>
</div>
</div>

<form method='post' action="addoffender.php">
  <input type='text' size=40 name="url" placeholder="ex: http://impossible-to-read-cool-kid-site.ly">
  <input type="submit" value="Add Offender">
</form>

<ul>
<?php

  include('db.php');
  $res = $db->query("select * from sites where up - down > -5 order by up - down desc limit 50");

  while( $row = $res->fetchArray() ) {
    $score = ($row['up'] - $row['down']);
    echo "<li>";
    echo "<span style=color:rgba(0,0,0," . ( (100 - $score) / 100) ."); class=score>" . $score . " <small>pts</small></span>";
    echo "<a name=item" . $row['id'] . " target=_blank href=" . $row['url'] . "><img src=img/" . md5($row['url']) . "_tn.jpg></a>";
    echo "<span class=title><a target=_blank href=" . $row['url'] . ">" . clean($row['title']) . "</a>" . $row['url'] . "</span>";
    echo "<div class=vote>";
    echo "<a class=down href=vote.php?dir=down&id=" . $row['id'] .">-1 It's fine</a>";
    echo "<a class=up href=vote.php?dir=up&id=" . $row['id'] .">+1 Unreadable</a>";
    if($isAdmin) {
      echo "<a href=drop.php?id=" . $row['id'] .">X</a>";
    }
    echo "</div>";
    echo "</li>";
  }
?>
</ul>
<div id="copyright">&copy;2014 blahblahblah. bullshit bullshit bullshit. <a target=_blank href="https://github.com/kristopolous/lowcon">source code</a></div>
<div id="fuck"><a href="https://github.com/kristopolous/lowcon" title="Oh yeah baby, come and git it"><img src="fork.gif"></a></div>
<script>
var messages = [
  "i don't use any color with numbers in it. What is this? 2012?",
  "the only content i read is \"lorem ipsum dolor sit amet, consectetur adipiscing elit\"",
  "i'm a c programmer - except in the classes i got d's in.",
  "i don't use computers. i type my css on postcards and mail it off to the datacenter.",
  "the bike i came in is the last thing you'll see that's fixed for the next 2 hours.",
  "i've taken javascript off my resume. it's coffescript all the way",
  "man that iphone is really ancient. what is it? like 2 months old?",
  "i have to stop coding now because i've sobered up.",
  "turning on adblock on my site is like 301'ing to about:blank.",
  "we haven't gotten any complaints. i told you that feedback feature doesn't need to work.",
  "A good day is a PBR, a MBP, and #BBB on #AAA.",
  "i utilize a process known as TDD; \"Takes Days n' Days\" to do shit.",
  "On saturdays I like to sit at home and go through my collection of DNS records.",
  "I charge $100/hr for results that will lose you $50,000. guaranteed.",
  "Of course the site needs 30MB of dependencies. Why is this even a question?",
  "my mobile stategy is to move around companies a lot and not fix things.",
  "can't code so i call myself a ux engineer",
  "look at me, im so cool. my sass generates less which generates lots of bugs.",
  "I use this font for irony even though it was designed for low resolution."
], ix = 0, iy = 7;

setInterval(function(){
  var m = document.getElementById('message');
  if(iy == 6) { m.className = 'fadeout'; }
  if(iy == 7) { 
    m.innerHTML = messages[ix]; 
    ix++;
    ix %= messages.length;
  }
  if(iy == 8) { m.className = 'fadein'; }

  iy ++;
  iy %= 12;

}, 1 * 1000);  

</script>
