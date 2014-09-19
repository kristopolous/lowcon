<?php
function clean($str) {
  if(strlen($str) > 35) {
    return substr($str, 0, 35) . '&hellip;';
  } 
  return $str;
}
?>
<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<style>
body{background:url('subtle_grunge.png');text-align:center}
h1{font-family: 'Poiret One', cursive;color:#bbb;font-weight:normal;font-size:4em;margin-bottom:0.25em;}
li {
  background: rgba(255,255,255,0.7);
  list-style: none;
  text-align: center;
  padding: 1.25em;
  margin: 0 1em;
  box-shadow: 0 0 3px 2px rgba(127,127,127,0.5);
  display: inline-block;
}
input{padding: 0.25em}
form { margin-bottom: 3em}
form > * { font-size: 130% }
li img { border: 2px solid rgba(0,0,0,0.25); padding: 0.15em; margin-bottom: 1em }
#content {
  background: rgba(255,255,255,0.5);
  padding: 0.5em;
  margin-bottom: 1.5em;
}
#copy {
  font-size: 1.2em;
  font-family: 'Droid Sans', sans-serif;
  display: inline-block;
  width: 30em;
  text-align: left;
  line-height: 1.5em;
}
#joke { border-radius: 12px }
p { margin: 0.5em}
</style>
<h1>Low Contrast Offenders</h1>
<div id='content'>
<img id='joke' src='hipster.jpg'>
<div id="copy">
<p>Sometimes people have the cool-kid designer stick shoved sooo far up their ass that they forgot to make their content readable.</p>
<p>Fuck them.</p>
<p>This is where we expose shitty low-contrast impossible to read websites. </p>
<p>Screw those poeple. Really.</p>
</div>
</div>

<form method='post' action="addoffender.php">
  <input size=40 name="url">
  <input type="submit" value="Add Offender">
</form>

<ul>
<?php

  include('db.php');
  $res = $db->query("select * from sites order by up limit 20");

  while( $row = $res->fetchArray() ) {
    echo "<li><img src=img/" . md5($row['url']) . "_tn.jpg><br>";
    echo "<a href=" . $row['url'] . ">" . clean($row['url']) . "</a>";
    echo "</li>";
  }
?>
</ul>
