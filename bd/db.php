<?php
session_start();
$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'phppdf'
) or die(mysqli_error($mysqli));
?>
