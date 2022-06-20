<?php
session_start();
ob_start();
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'nvsu';
$db = new mysqli($hostname,$username,$password,$database);