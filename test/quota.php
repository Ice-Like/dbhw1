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

head("業績目標", $header_other);
menu($username,$select='quota');
?>
    <div class="container">

  <?php
  
  function display_form($op,$empid)
  {

    
      if ($op==3)
      {
        $empid="";
        $quota85="";
        $quota84="";
        $quota83="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT empid,quota85,quota84,quota83 FROM quota where empid='$empid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $empid=$row['empid'];
                  $quota85=$row['quota85'];
                  $quota84=$row['quota84'];
                  $quota83=$row['quota83'];
              }
                $op=2;
      }


      echo "<form action=quota.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
              <input type='text' class='form-control' name=empid id='empid' placeholder='請輸入員工代號' value=$empid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>業績目標85</label>
              <input type='text' class='form-control' name=quota85 id='quota85' placeholder='請輸入業績目標85' value=$quota85>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>業績目標84</label>
              <input type='text' class='form-control' name=quota84 id='quota84' placeholder='請輸入業績目標84' value=$quota84>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>業績目標83</label>
              <input type='text' class='form-control' name=quota83 id='quota83' placeholder='請輸入業績目標83' value=$quota83>
            </div>";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='quota.php';
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
              $quota85=$_REQUEST['quota85'];
              $quota84=$_REQUEST['quota84'];
              $quota83=$_REQUEST['quota83'];
                  $sql="update quota 
                          set empid='$empid',
                              quota85='$quota85',
                              quota84='$quota84',
                              quota83='$quota83'
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
              $quota85=$_REQUEST['quota85'];
              $quota84=$_REQUEST['quota84'];
              $quota83=$_REQUEST['quota83'];

              $sql="insert into quota (empid,quota85,quota84,quota83) values ('$empid','$quota85','$quota84','$quota83')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $empid=$_REQUEST['empid'];              
            
              $sql="delete from quota where empid='$empid'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }else{
      echo '
      <p align=right>
      <a href=quota.php?op=3><button type="button" class="btn btn-success">新增</button></a>  </p>
      <table class="example">
      <thead>
        <tr>
          <td>員工代號</td>
               <td>業績目標85</td>
               <td>業績目標84</td>  
               <td>業績目標83</td>  
               <td> 編輯</td>			
               <td> 刪除</td>			
        </tr>
      </thead>
      <tbody>
      ';
      include("connectdb.php");
      $sql = "SELECT empid,quota85,quota84,quota83 FROM quota";
  
      $result =$connect->query($sql);
  
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
          $empid=$row['empid'];
          $quota85=$row['quota85'];
          $quota84=$row['quota84'];
          $quota83=$row['quota83'];
  
          echo "<tr><TD>$empid<td> $quota85<TD>$quota84<td>$quota83";    
          echo "<TD><a href=quota.php?op=1&empid=$empid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
          echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$empid]嗎?'))location='quota.php?empid=$empid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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