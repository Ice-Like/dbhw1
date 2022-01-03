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

head("部門資料維護", $header_other);
menu($username,$select='dept');
?>
    <div class="container">

  <?php
  
  function display_form($op,$deptid)
  {

    
      if ($op==3)
      {
        $deptid="";
        $deptname="";
        $managername="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT deptid,deptname,managername FROM dept where deptid='$deptid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $deptid=$row['deptid'];
                  $deptname=$row['deptname'];
                  $managername=$row['managername'];
              }
                $op=2;
      }


      echo "<form action=dept.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>部門代號</label>
              <input type='text' class='form-control' name=deptid id='deptid' placeholder='請輸入部門代號' value=$deptid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>部門名稱</label>
              <input type='text' class='form-control' name=deptname id='deptname' placeholder='請輸入部門名稱' value=$deptname>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>主管姓名</label>
              <input type='text' class='form-control' name=managername id='managername' placeholder='請輸入主管姓名' value=$managername>
            </div>";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='dept.php';
       </script>";
}

    if(isset($_REQUEST['op']))
    {
      $op=$_REQUEST['op'];   

      
      switch ($op)
      {
        case 1:  //修改
              $deptid=$_REQUEST['deptid']; 
               display_form($op,$deptid);
              break;      
        case 2:  //修改資料
                $deptid=$_REQUEST['deptid'];
              $deptname=$_REQUEST['deptname'];
              $managername=$_REQUEST['managername'];

                  $sql="update dept 
                          set deptid='$deptid',
                              deptname='$deptname',
                              managername='$managername'
                        where deptid='$deptid'";
                  include("connectdb.php");
                  #include('dbutil.php');
                  execute_sql($sql);
                  pageBack();
              break;
        case 3: //新增
               $deptid="";
                display_form($op,$deptid);
              break;
        case 4: //新增資料
              $deptid=$_REQUEST['deptid'];
              $deptname=$_REQUEST['deptname'];
              $managername=$_REQUEST['managername'];

              $sql="insert into dept (deptid,deptname,managername) values ('$deptid','$deptname','$managername')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $deptid=$_REQUEST['deptid'];              
            
              $sql="delete from dept where deptid='$deptid'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }
  ?>


    <p align=right>
    <a href=dept.php?op=3><button type='button' class='btn btn-success'>新增</button></a>  </p>
    <table class="example">
  	<thead>
  		<tr>
  			<td>部門代號</td>
             <td>部門名稱</td>
             <td>主管姓名</td>  
             <td> 編輯</td>			
             <td> 刪除</td>			
  		</tr>
  	</thead>
  	<tbody>

    <?php


    
    include("connectdb.php");
    $sql = "SELECT deptid,deptname,managername FROM dept";

    $result =$connect->query($sql);

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
        $deptid=$row['deptid'];
        $deptname=$row['deptname'];
        $managername=$row['managername'];

        echo "<tr><TD>$deptid<td> $deptname<TD>$managername";    
        echo "<TD><a href=dept.php?op=1&deptid=$deptid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
        echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$deptname]嗎?'))location='dept.php?deptid=$deptid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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