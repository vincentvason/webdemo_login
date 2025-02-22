<?php
  session_start();
  $con = mysqli_connect('localhost','phpmyadmin','vason','test');
  if (!$con) {
    die('Could not connect: ' . mysqli_error($link));
  }

  $txtUser = $_POST['user'];
  $txtPassword = $_POST['password'];

  $sql = "SELECT * FROM `user` WHERE `username` = '$txtUser'";
  $res = mysqli_query($con, $sql);

  //echo("<script>console.log("do");</script>");

  if(mysqli_num_rows($res) == 0)
  {
    echo(json_encode(array("res"=>"notexisted")));
  }
  else
  {
    $row = mysqli_fetch_assoc($res);
    $hashed_password = $row['password'];
    if(password_verify($txtPassword, $hashed_password))
    {
        $name = $row['name'];
        $_SESSION['username'] = $txtUser;
        $_SESSION['name'] = $name;
        echo(json_encode(array("res"=>"success","username"=>$txtUser,"name"=>$name)));
    }
    else
    {
        echo(json_encode(array("res"=>"notexisted")));
    }
  }
?>