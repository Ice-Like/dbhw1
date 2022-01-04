<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>註冊</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">

    

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
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
  <?php
    if(isset($_REQUEST['email']))
    { 
      $username=$_REQUEST['username'];
      $email=$_REQUEST['email'];
      $password=$_REQUEST['password'];
      $role='2';
      $gender=$_REQUEST['gendor'];  
      include("connectdb.php");
      include("basic.php");
      $sql = "SELECT email FROM user where email='$email'";
      $result =$connect->query($sql);

      if($row = $result->fetch_assoc())
      {
        echo '<script>alert("該電子郵件已經註冊過")</script>';

      }else{
        date_default_timezone_set('Asia/Taipei');
        $now = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `user`( `email`, `password`, `username`, `role`, `created`, `gender`) VALUES ('$email','$password','$username','$role','$now','$gender')";
        
        execute_sql($sql);
        echo $sql;
        switchto("index.php");
      }


    }


?>
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="./assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <h2>註冊帳號</h2>
    </div>

    <div class="form-signin">
     
      <div class="col-md-5 col-lg-5">
        <h4 class="mb-3">使用者資訊</h4>
        <form class="needs-validation" action="signup.php" method='post'>

            <div class="col-12">
              <label for="username" class="form-label">使用者名稱</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" name="username" placeholder="使用者名稱" required>
              <div class="invalid-feedback">
                  請輸入使用者名稱
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">電子信箱 <span class="text-muted">(email)</span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
              <div class="invalid-feedback">
                請輸入電子信箱
              </div>
            </div>

            <div class="col-12">
              <label for="password" class="form-label">密碼</label>
              <input type="text" class="form-control" id="password" name="password" placeholder="密碼" required>
              <div class="invalid-feedback">
                請輸入密碼
              </div>
            </div>

            <div class="col-md-5">
              <label for="gendor" class="form-label">性別</label>
              <select class="form-select" id="gendor" name="gendor" required>
                <option value="">請選擇...</option>
                <option value="1">男</option>
                <option value="2">女</option>
              </select>
              <div class="invalid-feedback">
                請選擇你的性別
              </div>
            </div>

          </div>


          <hr class="my-4">



          <button class="w-100 btn btn-primary btn-lg" type="submit">註冊</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 僅供測試用</p>
    <ul class="list-inline">
      <li class="list-inline-item">已經擁有帳號了?&emsp;<a href="index.php">按我返回登入</a></li>
    </ul>
  </footer>
</div>


    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="form-validation.js"></script>
  </body>
</html>
