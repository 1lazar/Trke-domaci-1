<?php
  $serverName = "localhost";
  $userName = "root";
  $password = "";

  $link = mysqli_connect($serverName, $userName, $password);
  mysqli_select_db($link, "domaci");

?>