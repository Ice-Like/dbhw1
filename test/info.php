<?php
include("auth.php");
include("template.php");
head("進銷存系統");
menu($username,$select='info');
content($username,$email,$gender,$role,$created);

footer();
function content($username,$email,$gender,$role,$created){
    echo '
    <div class="container">
  
  
      <hr class="my-4">
  
      <h2 class="mt-4" >個人資料</h2>
      
      <div class="row mb-3" style="padding-left: 30%;">
        <div class="col-md-7 themed-grid-col" >
          <div class="pb-3" style="text-align: center;">
            詳細資訊
          </div>
          <div class="row" style="padding-left: 15%;">
            <div class="col-md-3 themed-grid-col">名稱</div>
            <div class="col-md-7 themed-grid-col">'.$username.'</div>
          </div>
          <div class="row" style="padding-left: 15%;">
            <div class="col-md-3 themed-grid-col">電子郵件</div>
            <div class="col-md-7 themed-grid-col">'.$email.'</div>
          </div>
          <div class="row" style="padding-left: 15%;">
            <div class="col-md-3 themed-grid-col">性別</div>
            <div class="col-md-7 themed-grid-col">'.(($gender=='1') ? '男性' : '女性') .'</div>
          </div>
          <div class="row" style="padding-left: 15%;">
            <div class="col-md-3 themed-grid-col">創建日期</div>
            <div class="col-md-7 themed-grid-col">'.$created.'</div>
          </div>
        </div>
  
      </div>
  
      <hr class="my-4">
  
      
  
  
  
  
    ';
  }

?>