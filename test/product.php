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

head("產品資料維護", $header_other);
menu($username,$select='product');
?>
    <div class="container">

  <?php
  
  function display_form($op,$prodid)
  {

    
      if ($op==3)
      {
        $prodid="";
        $prodname="";
        $unitprice="";
        $cost="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT prodid,prodname,unitprice,cost FROM product where prodid='$prodid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $prodid=$row['prodid'];
                  $prodname=$row['prodname'];
                  $unitprice=$row['unitprice'];
                  $cost=$row['cost'];
              }
                $op=2;
      }


      echo "<form action=product.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品代號</label>
              <input type='text' class='form-control' name=prodid id='prodid' placeholder='請輸入產品代號' value=$prodid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品名稱</label>
              <input type='text' class='form-control' name=prodname id='prodname' placeholder='請輸入產品名稱' value=$prodname>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>單價</label>
              <input type='text' class='form-control' name=unitprice id='unitprice' placeholder='請輸入單價' value=$unitprice>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>成本</label>
              <input type='text' class='form-control' name=cost id='cost' placeholder='請輸入成本' value=$cost>
            </div>";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='product.php';
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
              $prodname=$_REQUEST['prodname'];
              $unitprice=$_REQUEST['unitprice'];
              $cost=$_REQUEST['cost'];
                  $sql="update product 
                          set prodid='$prodid',
                              prodname='$prodname',
                              unitprice='$unitprice',
                              cost='$cost'
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
              $prodname=$_REQUEST['prodname'];
              $unitprice=$_REQUEST['unitprice'];
              $cost=$_REQUEST['cost'];

              $sql="insert into product (prodid,prodname,unitprice,cost) values ('$prodid','$prodname','$unitprice','$cost')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $prodid=$_REQUEST['prodid'];              
            
              $sql="delete from product where prodid='$prodid'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }
  ?>


    <p align=right>
    <a href=product.php?op=3><button type='button' class='btn btn-success'>新增</button></a>  </p>
    <table class="example">
  	<thead>
  		<tr>
  			<td>產品代號</td>
             <td>產品名稱</td>
             <td>單價</td>  
             <td>成本</td>  
             <td> 編輯</td>			
             <td> 刪除</td>			
  		</tr>
  	</thead>
  	<tbody>

    <?php


    
    include("connectdb.php");
    $sql = "SELECT prodid,prodname,unitprice,cost FROM product";

    $result =$connect->query($sql);

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
        $prodid=$row['prodid'];
        $prodname=$row['prodname'];
        $unitprice=$row['unitprice'];
        $cost=$row['cost'];

        echo "<tr><TD>$prodid<td> $prodname<TD>$unitprice<td>$cost";    
        echo "<TD><a href=product.php?op=1&prodid=$prodid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
        echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$prodname]嗎?'))location='product.php?prodid=$prodid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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