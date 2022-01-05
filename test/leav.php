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

head("請假資料", $header_other);
menu($username,$select='leav');

  
  function display_form($op,$empid)
  {

    
      if ($op==3)
      {
        $empid="";
        $vacation="";
        $year="";
        $month="";
        $days="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT empid,vacation,year,month,days FROM leav where empid='$empid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $empid=$row['empid'];
                  $vacation=$row['vacation'];
                  $year=$row['year'];
                  $month=$row['month'];
                  $days=$row['days'];
              }
                $op=2;
      }


      echo "<form action=leav.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
              <input type='text' class='form-control' name=empid id='empid' placeholder='請輸入員工代號' value=$empid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>假別</label>
              <input type='text' class='form-control' name=vacation id='vacation' placeholder='請輸入假別' value=$vacation>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>年</label>
              <input type='text' class='form-control' name=year id='year' placeholder='請輸入年' value=$year>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>月</label>
              <input type='text' class='form-control' name=month id='month' placeholder='請輸入月' value=$month>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>日</label>
              <input type='text' class='form-control' name=days id='days' placeholder='請輸入日' value=$days>
            </div>
            ";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='leav.php';
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
                  $vacation=$_REQUEST['vacation'];
                  $year=$_REQUEST['year'];
                  $month=$_REQUEST['month'];
                  $days=$_REQUEST['days'];

                  $sql="update leav
                          set empid='$empid',
                              vacation='$vacation',
                              year='$year',
                              month='$month',
                              days='$days'
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
              $vacation=$_REQUEST['vacation'];
              $year=$_REQUEST['year'];
              $month=$_REQUEST['month'];
              $days=$_REQUEST['days'];

              $sql="insert into leav (empid,vacation,year,month,days) values ('$empid','$vacation','$year','$month','$days')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $empid=$_REQUEST['empid'];              
            
              $sql="delete from leav where empid='$empid'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }else{
      echo '
      <p align=right>
      <a href=leav.php?op=3><button type="button" class="btn btn-success">新增</button></a>  </p>
      <table class="example">
      <thead>
        <tr>
          <td>員工代號</td>
          <td>假別</td> 
          <td>年</td>
          <td>月</td>  
          <td>日</td>
          <td> 編輯</td>			 
          <td> 刪除</td>			
        </tr>
      </thead>
      <tbody>
      ';
      include("connectdb.php");
      $sql = "SELECT empid,vacation,year,month,days FROM leav";
  
      $result =$connect->query($sql);
  
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
          $empid=$row['empid'];
          $vacation=$row['vacation'];
          $year=$row['year'];
          $month=$row['month'];
          $days=$row['days'];
  
          echo "<tr><TD>$empid<td> $vacation<TD>$year<td> $month<TD>$days";    
          echo "<TD><a href=leav.php?op=1&empid=$empid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
          echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$empid]嗎?'))location='leav.php?empid=$empid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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