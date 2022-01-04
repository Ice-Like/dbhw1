<?php
include("auth.php");
include("template.php");

$header_other='
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- jQuery v1.9.1 -->
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <!-- DataTables v1.10.16 -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

  ';

head("員工個人資料", $header_other);
menu($username,$select='person');
?>
    
    <div class="container">

  <?php
  
  function display_form($op,$empid)
  {

    
      if ($op==3)
      {
        $empid="";
        $birth="";
        $jobtitle="";
        $gender="";
        $birthplace="";
        $nativeplace="";
        $workyear="";
        $expertise1="";
        $expertise2="";
        $ForeignLang1="";
        $ForeignLang2="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT empid,birth,jobtitle,gender,birthplace,nativeplace,workyear,expertise1,expertise2,ForeignLang1,ForeignLang2 FROM person where empid='$empid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $empid=$row['empid'];
                  $birth=$row['birth'];
                  $jobtitle=$row['jobtitle'];
                  $gender=$row['gender'];
                  $birthplace=$row['birthplace'];
                  $nativeplace=$row['nativeplace'];
                  $workyear=$row['workyear'];
                  $expertise1=$row['expertise1'];
                  $expertise2=$row['expertise2'];
                  $ForeignLang1=$row['ForeignLang1'];
                  $ForeignLang2=$row['ForeignLang2'];
              }
                $op=2;
      }


      echo "<form action=person.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
              <input type='text' class='form-control' name=empid id='empid' placeholder='請輸入員工代號' value=$empid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>年齡</label>
              <input type='text' class='form-control' name=birth id='birth' placeholder='請輸入年齡' value=$birth>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>職稱</label>
              <input type='text' class='form-control' name=jobtitle id='jobtitle' placeholder='請輸入職稱' value=$jobtitle>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>性別</label>
              <input type='text' class='form-control' name=gender id='gender' placeholder='請輸入性別' value=$gender>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>出生地</label>
              <input type='text' class='form-control' name=birthplace id='birthplace' placeholder='請輸入出生地' value=$birthplace>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>籍貫</label>
              <input type='text' class='form-control' name=nativeplace id='nativeplace' placeholder='請輸入籍貫' value=$nativeplace>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>到職年</label>
              <input type='text' class='form-control' name=workyear id='workyear' placeholder='請輸入到職年' value=$workyear>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>專長一</label>
              <input type='text' class='form-control' name=expertise1 id='expertise1' placeholder='請輸入專長一' value=$expertise1>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>專長二</label>
              <input type='text' class='form-control' name=expertise2 id='expertise2' placeholder='請輸入專長二' value=$expertise2>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>第一外語</label>
              <input type='text' class='form-control' name=ForeignLang1 id='ForeignLang1' placeholder='請輸入第一外語' value=$ForeignLang1>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>第二外語</label>
              <input type='text' class='form-control' name=ForeignLang2 id='ForeignLang2' placeholder='請輸入第二外語' value=$ForeignLang2>
            </div>
            ";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='person.php';
       </script>";
}

    if(isset($_REQUEST['op']))
    {
      $op=$_REQUEST['op'];   

      
      switch ($op)
      {
        case 1:  //修改
              $empid=$_REQUEST['empid']; 
               display_form($op,$empid);
              break;      
        case 2:  //修改資料
                  $empid=$_REQUEST['empid'];
                  $birth=$_REQUEST['birth'];
                  $jobtitle=$_REQUEST['jobtitle'];
                  $gender=$_REQUEST['gender'];
                  $birthplace=$_REQUEST['birthplace'];
                  $nativeplace=$_REQUEST['nativeplace'];
                  $workyear=$_REQUEST['workyear'];
                  $expertise1=$_REQUEST['expertise1'];
                  $expertise2=$_REQUEST['expertise2'];
                  $ForeignLang1=$_REQUEST['ForeignLang1'];
                  $ForeignLang2=$_REQUEST['ForeignLang2'];

                  $sql="update person
                          set empid='$empid',
                              birth='$birth',
                              jobtitle='$jobtitle',
                              gender='$gender',
                              birthplace='$birthplace',
                              nativeplace='$nativeplace',
                              workyear='$workyear',
                              expertise1='$expertise1',
                              expertise2='$expertise2',
                              ForeignLang1='$ForeignLang1',
                              ForeignLang2='$ForeignLang2'
                        where empid='$empid'";
                  include("connectdb.php");
                  #include('dbutil.php');
                  execute_sql($sql);
                  pageBack();
              break;
        case 3: //新增
               $empid="";
                display_form($op,$empid);
              break;
        case 4: //新增資料
              $empid=$_REQUEST['empid'];
              $birth=$_REQUEST['birth'];
              $jobtitle=$_REQUEST['jobtitle'];
              $gender=$_REQUEST['gender'];
              $birthplace=$_REQUEST['birthplace'];
              $nativeplace=$_REQUEST['nativeplace'];
              $workyear=$_REQUEST['workyear'];
              $expertise1=$_REQUEST['expertise1'];
              $expertise2=$_REQUEST['expertise2'];
              $ForeignLang1=$_REQUEST['ForeignLang1'];
              $ForeignLang2=$_REQUEST['ForeignLang2'];

              $sql="insert into person (empid,birth,jobtitle,gender,birthplace,nativeplace,workyear,expertise1,expertise2,ForeignLang1,ForeignLang2) values ('$empid','$birth','$jobtitle','$gender','$birthplace','$nativeplace','$workyear','$expertise1','$expertise2','$ForeignLang1','$ForeignLang2')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $empid=$_REQUEST['empid'];              
            
              $sql="delete from person where empid='$empid'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }else{
      echo '
      <p align=right>
      <a href=person.php?op=3><button type="button" class="btn btn-success">新增</button></a>  </p>
      <table class="example">
      <thead>
        <tr>
          <td>員工代號</td>
               <td>年齡</td> 
               <td>職稱</td>
               <td>性別</td>  
               <td>出生地</td>
               <td>籍貫</td>  
               <td>到職年</td>
               <td>專長一</td>  
               <td>專長二</td>
               <td>第一外語</td>
               <td>第二外語</td>    
               <td> 編輯</td>			
               <td> 刪除</td>			
        </tr>
      </thead>
      <tbody>
      ';
      include("connectdb.php");
      $sql = "SELECT empid,birth,jobtitle,gender,birthplace,nativeplace,workyear,expertise1,expertise2,ForeignLang1,ForeignLang2 FROM person";
  
      $result =$connect->query($sql);
  
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
          $empid=$row['empid'];
          $birth=$row['birth'];
          $jobtitle=$row['jobtitle'];
          $gender=$row['gender'];
          $birthplace=$row['birthplace'];
          $nativeplace=$row['nativeplace'];
          $workyear=$row['workyear'];
          $expertise1=$row['expertise1'];
          $expertise2=$row['expertise2'];
          $ForeignLang1=$row['ForeignLang1'];
          $ForeignLang2=$row['ForeignLang2'];
  
          echo "<tr><TD>$empid<td> $birth<TD>$jobtitle<td> $gender<TD>$birthplace<td> $nativeplace<TD>$workyear<td> $expertise1<TD>$expertise2<td> $ForeignLang1<TD> $ForeignLang2";    
          echo "<TD><a href=person.php?op=1&empid=$empid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
          echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$jobtitle]嗎?'))location='person.php?empid=$empid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
      }
    }
  ?>






</tbody>
  </table>


  </div>
  



<?php
$scriptOther='
    <script>
  	$( ".example" ).DataTable();
    </script>
    ';

footer($scriptOther);
?>