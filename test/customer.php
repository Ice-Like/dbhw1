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

head("客戶資料維護", $header_other);
menu($username,$select='customer');
?>
    
    <div class="container">

  <?php
  
  function display_form($op,$custid)
  {

    
      if ($op==3)
      {
        $custid="";
        $custname="";
        $jobtitle="";
        $contact="";
        $city="";
        $address="";
        $phone="";
        $zipcode="";
        $industry="";
        $taxno="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT custid,custname,jobtitle,contact,city,address,phone,zipcode,industry,taxno FROM customer where custid='$custid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $custid=$row['custid'];
                  $custname=$row['custname'];
                  $jobtitle=$row['jobtitle'];
                  $contact=$row['contact'];
                  $city=$row['city'];
                  $address=$row['address'];
                  $phone=$row['phone'];
                  $zipcode=$row['zipcode'];
                  $industry=$row['industry'];
                  $taxno=$row['taxno'];
              }
                $op=2;
      }


      echo "<form action=customer.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>客戶代號</label>
              <input type='text' class='form-control' name=custid id='custid' placeholder='請輸入客戶代號' value=$custid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>客戶寶號</label>
              <input type='text' class='form-control' name=custname id='custname' placeholder='請輸入客戶寶號' value=$custname>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>職稱</label>
              <input type='text' class='form-control' name=jobtitle id='jobtitle' placeholder='請輸入職稱' value=$jobtitle>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>聯絡人</label>
              <input type='text' class='form-control' name=contact id='contact' placeholder='請輸入聯絡人' value=$contact>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>縣市</label>
              <input type='text' class='form-control' name=city id='city' placeholder='請輸入縣市' value=$city>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>地址</label>
              <input type='text' class='form-control' name=address id='address' placeholder='請輸入地址' value=$address>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>電話</label>
              <input type='text' class='form-control' name=phone id='phone' placeholder='請輸入電話' value=$phone>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>郵遞區號</label>
              <input type='text' class='form-control' name=zipcode id='zipcode' placeholder='請輸入郵遞區號' value=$zipcode>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產業別</label>
              <input type='text' class='form-control' name=industry id='industry' placeholder='請輸入產業別' value=$industry>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>統一編號</label>
              <input type='text' class='form-control' name=taxno id='taxno' placeholder='請輸入統一編號' value=$taxno>
            </div>
            ";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='customer.php';
       </script>";
}

    if(isset($_REQUEST['op']))
    {
      $op=$_REQUEST['op'];   

      
      switch ($op)
      {
        case 1:  //修改
              $custid=$_REQUEST['custid']; 
               display_form($op,$custid);
              break;      
        case 2:  //修改資料
                  $custid=$_REQUEST['custid'];
                  $custname=$_REQUEST['custname'];
                  $jobtitle=$_REQUEST['jobtitle'];
                  $contact=$_REQUEST['contact'];
                  $city=$_REQUEST['city'];
                  $address=$_REQUEST['address'];
                  $phone=$_REQUEST['phone'];
                  $zipcode=$_REQUEST['zipcode'];
                  $industry=$_REQUEST['industry'];
                  $taxno=$_REQUEST['taxno'];

                  $sql="update customer
                          set custid='$custid',
                              custname='$custname',
                              jobtitle='$jobtitle',
                              contact='$contact',
                              city='$city',
                              address='$address',
                              phone='$phone',
                              zipcode='$zipcode',
                              industry='$industry',
                              taxno='$taxno'
                        where custid='$custid'";
                  include("connectdb.php");
                  #include('dbutil.php');
                  execute_sql($sql);
                  pageBack();
              break;
        case 3: //新增
               $custid="";
                display_form($op,$custid);
              break;
        case 4: //新增資料
              $custid=$_REQUEST['custid'];
              $custname=$_REQUEST['custname'];
              $jobtitle=$_REQUEST['jobtitle'];
              $contact=$_REQUEST['contact'];
              $city=$_REQUEST['city'];
              $address=$_REQUEST['address'];
              $phone=$_REQUEST['phone'];
              $zipcode=$_REQUEST['zipcode'];
              $industry=$_REQUEST['industry'];
              $taxno=$_REQUEST['taxno'];

              $sql="insert into customer (custid,custname,jobtitle,contact,city,address,phone,zipcode,industry,taxno) values ('$custid','$custname','$jobtitle','$contact','$city','$address','$phone','$zipcode','$industry','$taxno')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $custid=$_REQUEST['custid'];              
            
              $sql="delete from customer where custid='$custid'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }
  ?>


    <p align=right>
    <a href=customer.php?op=3><button type='button' class='btn btn-success'>新增</button></a>  </p>
    <table class="example">
  	<thead>
  		<tr>
  			<td>客戶代號</td>
             <td>客戶寶號</td> 
             <td>職稱</td>
             <td>聯絡人</td>  
             <td>縣市</td>
             <td>地址</td>  
             <td>電話</td>
             <td>郵遞區號</td>  
             <td>產業別</td>
             <td>統一編號</td>  
             <td> 編輯</td>			
             <td> 刪除</td>			
  		</tr>
  	</thead>
  	<tbody>

    <?php


    
    include("connectdb.php");
    $sql = "SELECT custid,custname,jobtitle,contact,city,address,phone,zipcode,industry,taxno FROM customer";

    $result =$connect->query($sql);

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
        $custid=$row['custid'];
        $custname=$row['custname'];
        $jobtitle=$row['jobtitle'];
        $contact=$row['contact'];
        $city=$row['city'];
        $address=$row['address'];
        $phone=$row['phone'];
        $zipcode=$row['zipcode'];
        $industry=$row['industry'];
        $taxno=$row['taxno'];

        echo "<tr><TD>$custid<td> $custname<TD>$jobtitle<td> $contact<TD>$city<td> $address<TD>$phone<td> $zipcode<TD>$industry<td> $taxno";    
        echo "<TD><a href=customer.php?op=1&custid=$custid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
        echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$custname]嗎?'))location='customer.php?custid=$custid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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