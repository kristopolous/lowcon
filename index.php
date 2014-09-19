<?php
function clean($str) {
  if(strlen($str) > 35) {
    return substr($str, 0, 35) . '&hellip;';
  } 
  return $str;
}
?>
<style>
body{background:url('subtle_grunge.png')}
form,p,h1 { text-align: center } 
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
</style>
<h1>Low Contrast Offenders</h1>
<p>This is where we expose shitty low-contrast impossible to read websites.</p>

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
