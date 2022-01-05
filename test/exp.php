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

head("員工工作經驗", $header_other);
menu($username,$select='exp');

  
  function display_form($op,$empid)
  {

    
      if ($op==3)
      {
        $empid="";
        $outsidejob1="";
        $outsidejob2="";
        $compjob1="";
        $compjob2="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT empid,outsidejob1,outsidejob2,compjob1,compjob2 FROM exp where empid='$empid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $empid=$row['empid'];
                  $outsidejob1=$row['outsidejob1'];
                  $outsidejob2=$row['outsidejob2'];
                  $compjob1=$row['compjob1'];
                  $compjob2=$row['compjob2'];
              }
                $op=2;
      }


      echo "<form action=exp.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
              <input type='text' class='form-control' name=empid id='empid' placeholder='請輸入員工代號' value=$empid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>在外任職一</label>
              <input type='text' class='form-control' name=outsidejob1 id='outsidejob1' placeholder='請輸入在外任職一' value=$outsidejob1>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>在外任職二</label>
              <input type='text' class='form-control' name=outsidejob2 id='outsidejob2' placeholder='請輸入在外任職二' value=$outsidejob2>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>公司任職一</label>
              <input type='text' class='form-control' name=compjob1 id='compjob1' placeholder='請輸入公司任職一' value=$compjob1>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>公司任職二</label>
              <input type='text' class='form-control' name=compjob2 id='compjob2' placeholder='請輸入公司任職二' value=$compjob2>
            </div>
            ";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='exp.php';
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
                  $outsidejob1=$_REQUEST['outsidejob1'];
                  $outsidejob2=$_REQUEST['outsidejob2'];
                  $compjob1=$_REQUEST['compjob1'];
                  $compjob2=$_REQUEST['compjob2'];

                  $sql="update exp
                          set empid='$empid',
                              outsidejob1='$outsidejob1',
                              outsidejob2='$outsidejob2',
                              compjob1='$compjob1',
                              compjob2='$compjob2'
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
              $outsidejob1=$_REQUEST['outsidejob1'];
              $outsidejob2=$_REQUEST['outsidejob2'];
              $compjob1=$_REQUEST['compjob1'];
              $compjob2=$_REQUEST['compjob2'];

              $sql="insert into exp (empid,outsidejob1,outsidejob2,compjob1,compjob2) values ('$empid','$outsidejob1','$outsidejob2','$compjob1','$compjob2')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $empid=$_REQUEST['empid'];              
            
              $sql="delete from exp where empid='$empid'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }else{
      echo '
      <p align=right>
      <a href=exp.php?op=3><button type="button" class="btn btn-success">新增</button></a>  </p>
      <table class="example">
      <thead>
        <tr>
          <td>員工代號</td>
          <td>在外任職一</td> 
          <td>在外任職二</td>
          <td>公司任職一</td>  
          <td>公司任職二</td>
          <td> 編輯</td>			 
          <td> 刪除</td>			
        </tr>
      </thead>
      <tbody>
      ';
      include("connectdb.php");
      $sql = "SELECT empid,outsidejob1,outsidejob2,compjob1,compjob2 FROM exp";
  
      $result =$connect->query($sql);
  
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
          $empid=$row['empid'];
          $outsidejob1=$row['outsidejob1'];
          $outsidejob2=$row['outsidejob2'];
          $compjob1=$row['compjob1'];
          $compjob2=$row['compjob2'];
  
          echo "<tr><TD>$empid<td> $outsidejob1<TD>$outsidejob2<td> $compjob1<TD>$compjob2";    
          echo "<TD><a href=exp.php?op=1&empid=$empid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
          echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$empid]嗎?'))location='exp.php?empid=$empid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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