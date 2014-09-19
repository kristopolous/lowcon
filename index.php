<?php
function clean($str) {
  if(strlen($str) > 37) {
    return substr($str, 0, 35) . '&hellip;';
  } 
  return $str;
}
?>
<!doctype html>
<title>The Worst Websites On The Whole Fucking Internet, in Pictures.</title>
<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<style>
body{background:url('subtle_grunge.png');text-align:center;margin:0;padding:0}
#header{font-family: 'Poiret One', cursive;color:#aaa;font-weight:normal;background:rgba(191,191,191,0.1);padding:1em}
#header p {color:#aaa;font-size:1.15em}
h1{font-weight:normal;font-size:4em;padding:0;margin:0}
li {
  background: rgba(255,255,255,0.7);
  list-style: none;
  text-align: center;
  padding: 1.25em;
  margin: 1em;
  box-shadow: 0 0 3px 2px rgba(127,127,127,0.5);
  display: inline-block;
}
input{padding: 0.25em}
input[type='text']{border: 2px solid rgba(80,80,80,0.5)}
input[type="submit"]{padding: inherit 2em;}
form { margin-bottom: 1em}
form > * { font-size: 130% }
li img { border: 2px solid rgba(0,0,0,0.25); padding: 0.15em; margin-bottom: 1em }
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
#copy {
  font-size: 1.2em;
  display: inline-block;
  width: 30em;
  text-align: left;
  line-height: 1.5em;
}
ul { text-align: left }
#joke { vertical-align: top; border-radius: 12px }
p { margin: 0.5em}
</style><div id=header>
<h1>Low Contrast Offenders</h1>
<p>who the hell can read this shit</p>
</div>
<div id='content'>
  <img id='joke' src='hipster.jpg'>
  <div id="copy">
    <p>Some people have the cool-kid designer stick shoved so far up their ass that they forgot to make their content readable.</p>
    <p>Fuck them. This has gone on too long.</p>
    <p>Let's expose low-contrast impossible to read websites.</p>
    <p>Screw those people. Really.</p>
  </div>
</div>

<form method='post' action="addoffender.php">
  <input type='text' size=40 name="url" placeholder="ex: http://impossible-to-read-cool-kid-site.com">
  <input type="submit" value="Add Offender">
</form>

<ul>
<?php

  include('db.php');
  $res = $db->query("select * from sites order by up limit 20");

  while( $row = $res->fetchArray() ) {
    echo "<li>";
    echo "<a target=_blank href=" . $row['url'] . "><img src=img/" . md5($row['url']) . "_tn.jpg></a><br>";
    echo "<a target=_blank href=" . $row['url'] . ">" . clean($row['title']) . "</a>";
    echo "</li>";
  }
?>
</ul>
