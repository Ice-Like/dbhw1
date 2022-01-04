<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>登入</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
  <?php
    if(isset($_REQUEST['email']))
    {
      $email=$_REQUEST['email'];
      $password=$_REQUEST['password'];

      #echo "email=$email password=$password";

      include("connectdb.php");
      include("basic.php");
      $sql = "SELECT uid,username,role,gender,created FROM user where email='$email' and password='$password'";
      $result =$connect->query($sql);

      if($row = $result->fetch_assoc())
      {
        $uid=$row['uid'];
        $username=$row['username'];
        $role=$row['role'];
        $gender=$row['gender'];  
        $created=$row['created'];     
        
        date_default_timezone_set('Asia/Taipei');
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE user SET lastlogin='$now' WHERE uid='$uid'";
        $result =$connect->query($sql);

        session_start();
        $_SESSION['uid'] =$uid;
        $_SESSION['role']=$role;
        $_SESSION['gender']=$gender;
        $_SESSION['email']=$email;
        $_SESSION['username']=$username;
        $_SESSION['created']=$created;
        switchto("home.php");

      
      }
      #else  echo "login fail!";


    }


?>
<main class="form-signin">
  <form action="index.php" method='post'>
    <img class="mb-4" src="https://img.88icon.com/download/jpg/20200822/770dfb81e6cf1a8b08e5311dceaf0116_512_512.jpg!88bg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">登入</h1>
    <form action="index.php" method='post'>
    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
      <label for="floatingInput">電子郵件</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="floatingPassword">密碼</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <a href='signup.php'>註冊</a>
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">登入</button>
    <p class="mt-5 mb-3 text-muted">&copy; 僅供測試用</p>
  </form>
</main>


    
  </body>
</html>
