<?php
include 'database.php';
global $db;
$rfid       = $_POST['rfid'];
$query      = $db->query("SELECT * FROM accounts_tbl WHERE rfid = '$rfid'");
$row        = $query->fetch_object();
$fullname   = $row->firstname.' '.$row->middlename.' '.$row->surname;
$image      = $row->image;
echo json_encode(['fullname' => $fullname,'image' => $image]);