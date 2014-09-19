<style>
li {
  list-style: none;
  text-align: center;
  display: inline-block;
}
li img { border: 2px solid rgba(0,0,0,0.5); margin-bottom: 0.5em }
</style>
<h1>Low Contrast Offenders</h1>
<p>This is where we expose shitty low-contrast impossible to read websites.</p>
<p>Expose this morons.</p>

<form method='post' action="addoffender.php">
  <input name="url">
  <input type="submit" value="Add Offender">
</form>

<ul>
<?php
  include('db.php');
  $res = $db->query("select * from sites order by up limit 20");

  while( $row = $res->fetchArray() ) {
    echo "<li><img src=img/" . md5($row['url']) . "_tn.jpg><br>";
    echo "<a href=" . $row['url'] . ">" . $row['url'] . "</a>";
    echo "</li>";
  }
?>
</ul>
