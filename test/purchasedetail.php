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

head("產品訂購明細", $header_other);
menu($username,$select='purchasedetail');
?>
    
    <div class="container">

  <?php
  
  function display_form($op,$seq)
  {

    
      if ($op==3)
      {
        $seq="";
        $purchaseid="";
        $prodid="";
        $qty="";
        $purchaseprice="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT seq,purchaseid,prodid,qty,purchaseprice FROM purchasedetail where seq='$seq'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $seq=$row['seq'];
                  $purchaseid=$row['purchaseid'];
                  $prodid=$row['prodid'];
                  $qty=$row['qty'];
                  $purchaseprice=$row['purchaseprice'];
              }
                $op=2;
      }


      echo "<form action=purchasedetail.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>序號</label>
              <input type='text' class='form-control' name=seq id='seq' placeholder='請輸入序號' value=$seq>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>採購代號</label>
              <input type='text' class='form-control' name=purchaseid id='purchaseid' placeholder='請輸入採購代號' value=$purchaseid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品代號</label>
              <input type='text' class='form-control' name=prodid id='prodid' placeholder='請輸入產品代號' value=$prodid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>數量</label>
              <input type='text' class='form-control' name=qty id='qty' placeholder='請輸入數量' value=$qty>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>採購單價</label>
              <input type='text' class='form-control' name=purchaseprice id='purchaseprice' placeholder='請輸入採購單價' value=$purchaseprice>
            </div>
            ";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='purchasedetail.php';
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
                  $purchaseid=$_REQUEST['purchaseid'];
                  $prodid=$_REQUEST['prodid'];
                  $qty=$_REQUEST['qty'];
                  $purchaseprice=$_REQUEST['purchaseprice'];

                  $sql="update purchasedetail
                          set seq='$seq',
                              purchaseid='$purchaseid',
                              prodid='$prodid',
                              qty='$qty',
                              purchaseprice='$purchaseprice'
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
              $purchaseid=$_REQUEST['purchaseid'];
              $prodid=$_REQUEST['prodid'];
              $qty=$_REQUEST['qty'];
              $purchaseprice=$_REQUEST['purchaseprice'];

              $sql="insert into purchasedetail (seq,purchaseid,prodid,qty,purchaseprice) values ('$seq','$purchaseid','$prodid','$qty','$purchaseprice')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $seq=$_REQUEST['seq'];              
            
              $sql="delete from purchasedetail where seq='$seq'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }else{
      echo '
      <p align=right>
      <a href=purchasedetail.php?op=3><button type="button" class="btn btn-success">新增</button></a>  </p>
      <table class="example">
      <thead>
        <tr>
          <td>序號</td>
          <td>採購代號</td> 
          <td>產品代號</td>
          <td>數量</td>  
          <td>採購單價</td>
          <td> 編輯</td>			 
          <td> 刪除</td>			
        </tr>
      </thead>
      <tbody>
      ';
      include("connectdb.php");
      $sql = "SELECT seq,purchaseid,prodid,qty,purchaseprice FROM purchasedetail";
  
      $result =$connect->query($sql);
  
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
          $seq=$row['seq'];
          $purchaseid=$row['purchaseid'];
          $prodid=$row['prodid'];
          $qty=$row['qty'];
          $purchaseprice=$row['purchaseprice'];
  
          echo "<tr><TD>$seq<td> $purchaseid<TD>$prodid<td> $qty<TD>$purchaseprice";    
          echo "<TD><a href=purchasedetail.php?op=1&seq=$seq><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
          echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$seq]嗎?'))location='purchasedetail.php?seq=$seq&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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