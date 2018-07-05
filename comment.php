<?php
include('db.php');

$id = mysql_real_escape_string($_POST['id']);
$text = mysql_real_escape_string($_POST['comment']);
$db->exec('insert into comments(id, comment, date) values(' . $id . ',"' . $text . '", date(\'now\'))');
