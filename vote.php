<?php
$dir = $_GET['dir'];
$id = intval($_GET['id']);

if($id > 0 && in_array($dir, array('up', 'down'))) {
  require('db.php');
  $db->exec("update sites set $dir = $dir + 1 where id = $id"); 
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
