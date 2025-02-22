<?php
  $con = mysqli_connect('localhost','phpmyadmin','vason','test');
  if (!$con) {
    die('Could not connect: ' . mysqli_error($link));
  }

  $txtUser = $_POST['user'];
  $txtPassword = $_POST['password'];
  $txtHashPassword = password_hash($txtPassword, PASSWORD_DEFAULT);
  $txtName = $_POST['name'];
  $txtEmail = $_POST['email'];

  $sql = "SELECT * FROM `user` WHERE `username` = '$txtUser' OR `email` = '$txtEmail'";
  $res = mysqli_query($con, $sql);

  if(mysqli_num_rows($res) > 0)
  {
     echo(json_encode(array("res"=>"existed")));
  }
  else
  {
    $sql = "INSERT INTO `user` (`username`, `password`, `name`, `email`, `superuser`) VALUES ('$txtUser', '$txtHashPassword', '$txtName', '$txtEmail', '0')";
    $res = mysqli_query($con, $sql);
    echo(json_encode(array("res"=>"success")));
  }
  
  mysqli_close($con);
?>

