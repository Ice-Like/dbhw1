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

head("產品存量", $header_other);
menu($username,$select='inv');

  
  function display_form($op,$prodid)
  {

    
      if ($op==3)
      {
        $prodid="";
        $stock="";
        $safestock="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT prodid,stock,safestock FROM inv where prodid='$prodid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $prodid=$row['prodid'];
                  $stock=$row['stock'];
                  $safestock=$row['safestock'];
              }
                $op=2;
      }


      echo "<form action=inv.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品代號</label>
              <input type='text' class='form-control' name=prodid id='prodid' placeholder='請輸入產品代號' value=$prodid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>現存量</label>
              <input type='text' class='form-control' name=stock id='stock' placeholder='請輸入現存量' value=$stock>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>安全存量</label>
              <input type='text' class='form-control' name=safestock id='safestock' placeholder='請輸入安全存量' value=$safestock>
            </div>";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='inv.php';
       </script>";
}

    if(isset($_REQUEST['op']))
    {
      $op=$_REQUEST['op'];   

      
      switch ($op)
      {
        case 1:  //修改
              $prodid=$_REQUEST['prodid']; 
               display_form($op,$prodid);
              break;      
        case 2:  //修改資料
                $prodid=$_REQUEST['prodid'];
              $stock=$_REQUEST['stock'];
              $safestock=$_REQUEST['safestock'];

                  $sql="update inv 
                          set prodid='$prodid',
                              stock='$stock',
                              safestock='$safestock'
                        where prodid='$prodid'";
                  include("connectdb.php");
                  #include('dbutil.php');
                  execute_sql($sql);
                  pageBack();
              break;
        case 3: //新增
               $prodid="";
                display_form($op,$prodid);
              break;
        case 4: //新增資料
              $prodid=$_REQUEST['prodid'];
              $stock=$_REQUEST['stock'];
              $safestock=$_REQUEST['safestock'];

              $sql="insert into inv (prodid,stock,safestock) values ('$prodid','$stock','$safestock')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $prodid=$_REQUEST['prodid'];              
            
              $sql="delete from inv where prodid='$prodid'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }else{
      echo '
      <p align=right>
      <a href=inv.php?op=3><button type="button" class="btn btn-success">新增</button></a>  </p>
      <table class="example">
      <thead>
        <tr>
          <td>產品代號</td>
               <td>現存量</td>
               <td>安全存量</td>  
               <td> 編輯</td>			
               <td> 刪除</td>			
        </tr>
      </thead>
      <tbody>
      ';
      include("connectdb.php");
      $sql = "SELECT prodid,stock,safestock FROM inv";
  
      $result =$connect->query($sql);
  
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
          $prodid=$row['prodid'];
          $stock=$row['stock'];
          $safestock=$row['safestock'];
  
          echo "<tr><TD>$prodid<td> $stock<TD>$safestock";    
          echo "<TD><a href=inv.php?op=1&prodid=$prodid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
          echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$prodid]嗎?'))location='inv.php?prodid=$prodid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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