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

head("訂單資料維護", $header_other);
menu($username,$select='orderdetail');
?>
    <div class="container">

  <?php
  
  function display_form($op,$seq)
  {

    
      if ($op==3)
      {
        $seq="";
        $prodid="";
        $orderid="";
        $qty="";
        $discount="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT seq,prodid,orderid,qty,discount FROM orderdetail where seq='$seq'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $seq=$row['seq'];
                  $prodid=$row['prodid'];
                  $orderid=$row['orderid'];
                  $qty=$row['qty'];
                  $discount=$row['discount'];
              }
                $op=2;
      }


      echo "<form action=orderdetail.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>序號</label>
              <input type='text' class='form-control' name=seq id='seq' placeholder='請輸入序號' value=$seq>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品代號</label>
              <input type='text' class='form-control' name=prodid id='prodid' placeholder='請輸入產品代號' value=$prodid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>訂單編號</label>
              <input type='text' class='form-control' name=orderid id='orderid' placeholder='請輸入訂單編號' value=$orderid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>數量</label>
              <input type='text' class='form-control' name=qty id='qty' placeholder='請輸入數量' value=$qty>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>折扣</label>
              <input type='text' class='form-control' name=discount id='discount' placeholder='請輸入折扣' value=$discount>
            </div>";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='orderdetail.php';
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
              $prodid=$_REQUEST['prodid'];
              $orderid=$_REQUEST['orderid'];
              $qty=$_REQUEST['qty'];
              $discount=$_REQUEST['discount'];
                  $sql="update orderdetail 
                          set seq='$seq',
                              rodid='$prodid',
                              orderid='$orderid',
                              qty='$qty',
                              discount='$discount'
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
              $prodid=$_REQUEST['prodid'];
              $orderid=$_REQUEST['orderid'];
              $qty=$_REQUEST['qty'];
              $discount=$_REQUEST['discount'];

              $sql="insert into orderdetail (seq,prodid,orderid,qty,discount) values ('$seq','$prodid','$orderid','$qty','$discount')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $seq=$_REQUEST['seq'];              
            
              $sql="delete from orderdetail where seq='$seq'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }
  ?>


    <p align=right>
    <a href=orderdetail.php?op=3><button type='button' class='btn btn-success'>新增</button></a>  </p>
    <table class="example">
  	<thead>
  		<tr>
        <td>序號</td>
  			<td>產品代號</td>
        <td>訂單編號</td>
        <td>數量</td>  
        <td>折扣</td>  
        <td> 編輯</td>			
        <td> 刪除</td>			
  		</tr>
  	</thead>
  	<tbody>

    <?php


    
    include("connectdb.php");
    $sql = "SELECT seq,prodid,orderid,qty,discount FROM orderdetail";

    $result =$connect->query($sql);

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
        $seq=$row['seq'];
        $prodid=$row['prodid'];
        $orderid=$row['orderid'];
        $qty=$row['qty'];
        $discount=$row['discount'];

        echo "<tr><td>$seq<TD>$prodid<td> $orderid<TD>$qty<td>$discount";    
        echo "<TD><a href=orderdetail.php?op=1&seq=$seq><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
        echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$seq]嗎?'))location='orderdetail.php?seq=$seq&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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