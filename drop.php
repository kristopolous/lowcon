<?php
$id = intval($_GET['id']);

if($id > 0) {
  require('db.php');
  $db->exec("delete from sites where id = $id"); 
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
