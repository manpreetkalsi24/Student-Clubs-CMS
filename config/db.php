<?php
$host = 'localhost';
$user = 'root';
$password = ''; 
$dbname = 'student_clubs_cms';

$connect = mysqli_connect($host, $user, $password, $dbname);

if(!$connect){
    die("Connection failed: " . mysqli_connect_error());
}