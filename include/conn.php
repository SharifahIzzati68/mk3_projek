<?php
$host = 'localhost';
$user = 'root';
$pswd = '';
$dbname = 'penperel';

$conn = new mysqli($host,$user,$pswd,$dbname);
session_start();