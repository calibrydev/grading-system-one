<?php
include('testconnection.php');
session_start();
  if(isset($_POST['login'])){
    $adm = $_POST['adm']; 
    $password = $_POST['password'];
    $user=$_POST['user'];
    if($user=='Admin'){
      $sql = "SELECT * FROM admin WHERE username =:adm AND password = :password ";
      $stmt=$conns->prepare($sql);
      $data=[
      ':adm'=>$adm,
      ':password'=>$password
      ];
      // execute the query with given parameters
      $stmt->execute($data);
      
      // check if the query is executed
      if($stmt->rowCount()>0){
        // if the query is executed then get the result
        $result = $stmt->fetch();
        // set the session and redirect to the dashboard
        $_SESSION['name'] = $result['username']; 
        header("Location: Adminnav.php");
      }else{
        echo "Username or Password is incorrect";
      }
    }else if($user=='teacher'){
      $sql = "SELECT * FROM teachers WHERE  email=:adm AND password = :password ";
      $stmt=$conns->prepare($sql);
      $data=[
      ':adm'=>$adm,
      ':password'=>$password
      ];
      // execute the query with given parameters
      $stmt->execute($data);
      
      // check if the query is executed
      if($stmt->rowCount()>0){
        // if the query is executed then get the result
        $result = $stmt->fetch();
        // set the session and redirect to the dashboard
        $_SESSION['name'] = $result['name'];
        header("Location: tunits.php");
      }else{
        echo "Username or Password is incorrect";
      }
    }
    else if($user=='student'){
      $sql = "SELECT * FROM studentdetails WHERE adm =:adm AND password = :password ";
      $stmt=$conns->prepare($sql);
      $data=[
      ':adm'=>$adm,
      ':password'=>$password
      ];
      // execute the query with given parameters
      $stmt->execute($data);
      
      // check if the query is executed
      if($stmt->rowCount()>0){
        // if the query is executed then get the result
        $result = $stmt->fetch();
        // set the session and redirect to the dashboard
        $_SESSION['adm'] = $result['adm'];
        header("Location: dashboardstudent.php");
      }else{
        echo "Username or Password is incorrect";
      }
    }
    // $sql = "SELECT * FROM studentdetails WHERE adm =:adm AND password = :password ";
    // $stmt=$conns->prepare($sql);
    // $data=[
    // ':adm'=>$adm,
    // ':password'=>$password
    // ];
    // // execute the query with given parameters
    // $stmt->execute($data);
    
    // // check if the query is executed
    // if($stmt->rowCount()>0){
    //   // if the query is executed then get the result
    //   $result = $stmt->fetch();
    //   // set the session and redirect to the dashboard
    //   $_SESSION['adm'] = $result['adm'];
    //   $_SESSION['id'] = $result['id'];
    //   header("Location: nav.php");
    // }else{
    //   echo "Username or Password is incorrect";
    // }

    
  }







?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Signup Forms</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
  margin: 0;
  font-family: Arial, sans-serif;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.login-form, .signup-form {
  border: 1px solid #ccc;
  padding: 20px;
  margin: 10px;
  width: 300px;
}

.login-form h2, .signup-form h2 {
  margin-top: 0;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="password"],
input[type="email"] {
  width: calc(100% - 10px);
  padding: 5px;
}

button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

  </style>
</head>
<body>
  <div class="container">
    <div class="login-form">
      <h2>Login</h2>
      <form action="loginsingup.php" method="post">
        <div class="form-group">
          <label for="login-username">Username:</label>
          <input type="text" id="login-username" name="adm">
        </div>
        <div class="form-group">
          <label for="login-password">Password:</label>
          <input type="password" id="login-password" name="password">
        </div>
        <div class="form-group">
          <label for="user">User (Admin.teacher,student)</label>
          <input type="text" id="user" name="user">
        </div>
        <input type="submit" name="login" value="login">
      </form>
    </div>
   
  </div>
</body>
</html>
