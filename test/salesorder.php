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

head("銷售訂單", $header_other);
menu($username,$select='salesorder');
?>
    
    <div class="container">

  <?php
  
  function display_form($op,$seq)
  {

    
      if ($op==3)
      {
        $seq="";
        $orderid="";
        $empid="";
        $custid="";
        $orderdate="";
        $descript="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT seq,orderid,empid,custid,orderdate,descript FROM salesorder where seq='$seq'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $seq=$row['seq'];
                  $orderid=$row['orderid'];
                  $empid=$row['empid'];
                  $custid=$row['custid'];
                  $orderdate=$row['orderdate'];
                  $descript=$row['descript'];
              }
                $op=2;
      }


      echo "<form action=salesorder.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>序號</label>
              <input type='text' class='form-control' name=seq id='seq' placeholder='請輸入序號' value=$seq>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>訂單編號</label>
              <input type='text' class='form-control' name=orderid id='orderid' placeholder='請輸入訂單編號' value=$orderid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
              <input type='text' class='form-control' name=empid id='empid' placeholder='請輸入員工代號' value=$empid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>客戶代號</label>
              <input type='text' class='form-control' name=custid id='custid' placeholder='請輸入客戶代號' value=$custid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>訂單日期</label>
              <input type='text' class='form-control' name=orderdate id='orderdate' placeholder='請輸入訂單日期' value=$orderdate>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>備註</label>
              <input type='text' class='form-control' name=descript id='descript' placeholder='請輸入備註' value=$descript>
            </div>            
            ";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='salesorder.php';
       </script>";
}

    if(isset($_REQUEST['op']))
    {
      $op=$_REQUEST['op'];   

      
      switch ($op)
      {
        case 1:  //修改
              $seq=$_REQUEST['seq']; 
               display_form($op,$seq);
              break;      
        case 2:  //修改資料
                  $seq=$_REQUEST['seq'];
                  $orderid=$_REQUEST['orderid'];
                  $empid=$_REQUEST['empid'];
                  $custid=$_REQUEST['custid'];
                  $orderdate=$_REQUEST['orderdate'];
                  $descript=$_REQUEST['descript'];

                  $sql="update salesorder
                          set seq='$seq',
                              orderid='$orderid',
                              empid='$empid',
                              custid='$custid',
                              orderdate='$orderdate',
                              descript='$descript'
                        where seq='$seq'";
                  include("connectdb.php");
                  #include('dbutil.php');
                  execute_sql($sql);
                  pageBack();
              break;
        case 3: //新增
               $seq="";
                display_form($op,$seq);
              break;
        case 4: //新增資料
              $seq=$_REQUEST['seq'];
              $orderid=$_REQUEST['orderid'];
              $empid=$_REQUEST['empid'];
              $custid=$_REQUEST['custid'];
              $orderdate=$_REQUEST['orderdate'];
              $descript=$_REQUEST['descript'];

              $sql="insert into salesorder (seq,orderid,empid,custid,orderdate,descript) values ('$seq','$orderid','$empid','$custid','$orderdate','$descript')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $seq=$_REQUEST['seq'];              
            
              $sql="delete from salesorder where seq='$seq'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }else{
      echo '
      <p align=right>
    <a href=salesorder.php?op=3><button type="button" class="btn btn-success">新增</button></a>  </p>
    <table class="example">
  	<thead>
  		<tr>
  			<td>序號</td>
             <td>訂單編號</td> 
             <td>員工代號</td>
             <td>客戶代號</td>
             <td>訂單日期</td>  
             <td>備註</td>
             <td> 編輯</td>			
             <td> 刪除</td>			
  		</tr>
  	</thead>
  	<tbody>
      ';
      include("connectdb.php");
      $sql = "SELECT seq,orderid,empid,custid,orderdate,descript FROM salesorder";
  
      $result =$connect->query($sql);
  
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
          $seq=$row['seq'];
          $orderid=$row['orderid'];
          $empid=$row['empid'];
          $custid=$row['custid'];
          $orderdate=$row['orderdate'];
          $descript=$row['descript'];
  
          echo "<tr><TD>$seq<td> $orderid<TD>$empid<td>$custid<TD> $orderdate<td>$descript";    
          echo "<TD><a href=salesorder.php?op=1&seq=$seq><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
          echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$orderid]嗎?'))location='salesorder.php?seq=$seq&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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