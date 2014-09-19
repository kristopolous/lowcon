<?php
$dir = $_GET['dir'];

$col = false;
if($dir == 'up') { 
  $col = 'up';
} else if($dir == 'down') { 
  $col = 'down';
} 

$id = intval($_GET['id']);

if($col !== false && $id > 0) {
  require('db.php');
  $db->exec("update sites set $col = $col + 1 where id = $id"); 
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
