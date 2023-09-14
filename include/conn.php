<?php
$host = 'localhost';
$user = 'root';
$pswd = '';
$dbname = 'penperel';

$conn = new mysqli($host,$user,$pswd,$dbname);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

