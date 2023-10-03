<?php
session_start();
session_destroy();
header('location: index.php'); // Adjust the path as needed
