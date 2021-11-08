<?php
$con = mysqli_connect("localhost","root","","bandienmay");
if (!$con)
  {
  die('Could not connect: ' );
  };

$con -> set_charset("utf8");
?>