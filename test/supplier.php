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

head("供應商資料", $header_other);
menu($username,$select='supplier');

  
  function display_form($op,$supplierid)
  {

    
      if ($op==3)
      {
        $supplierid="";
        $suppliername="";
        $jobtitle="";
        $city="";
        $address="";
        $phone="";
        $zipcode="";
        $contact="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT supplierid,suppliername,jobtitle,city,address,phone,zipcode,contact FROM supplier where supplierid='$supplierid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $supplierid=$row['supplierid'];
                  $suppliername=$row['suppliername'];
                  $jobtitle=$row['jobtitle'];
                  $city=$row['city'];
                  $address=$row['address'];
                  $phone=$row['phone'];
                  $zipcode=$row['zipcode'];
                  $contact=$row['contact'];
              }
                $op=2;
      }


      echo "<form action=supplier.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>供應商代號</label>
              <input type='text' class='form-control' name=supplierid id='supplierid' placeholder='請輸入供應商代號' value=$supplierid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>供應商寶號</label>
              <input type='text' class='form-control' name=suppliername id='suppliername' placeholder='請輸入供應商寶號' value=$suppliername>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>職稱</label>
              <input type='text' class='form-control' name=jobtitle id='jobtitle' placeholder='請輸入職稱' value=$jobtitle>
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
              <label for='exampleFormControlInput1' class='form-label'>聯絡人</label>
              <input type='text' class='form-control' name=contact id='contact' placeholder='請輸入聯絡人' value=$contact>
            </div>
            ";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='supplier.php';
       </script>";
}

    if(isset($_REQUEST['op']))
    {
      $op=$_REQUEST['op'];   

      
      switch ($op)
      {
        case 1:  //修改
              $supplierid=$_REQUEST['supplierid']; 
               display_form($op,$supplierid);
              break;      
        case 2:  //修改資料
                  $supplierid=$_REQUEST['supplierid'];
                  $suppliername=$_REQUEST['suppliername'];
                  $jobtitle=$_REQUEST['jobtitle'];
                  $city=$_REQUEST['city'];
                  $address=$_REQUEST['address'];
                  $phone=$_REQUEST['phone'];
                  $zipcode=$_REQUEST['zipcode'];
                  $contact=$_REQUEST['contact'];

                  $sql="update supplier
                          set supplierid='$supplierid',
                              suppliername='$suppliername',
                              jobtitle='$jobtitle',
                              city='$city',
                              address='$address',
                              phone='$phone',
                              zipcode='$zipcode',
                              contact='$contact'
                        where supplierid='$supplierid'";
                  include("connectdb.php");
                  #include('dbutil.php');
                  execute_sql($sql);
                  pageBack();
              break;
        case 3: //新增
               $supplierid="";
                display_form($op,$supplierid);
              break;
        case 4: //新增資料
              $supplierid=$_REQUEST['supplierid'];
              $suppliername=$_REQUEST['suppliername'];
              $jobtitle=$_REQUEST['jobtitle'];
              $city=$_REQUEST['city'];
              $address=$_REQUEST['address'];
              $phone=$_REQUEST['phone'];
              $zipcode=$_REQUEST['zipcode'];
              $contact=$_REQUEST['contact'];

              $sql="insert into supplier (supplierid,suppliername,jobtitle,city,address,phone,zipcode,contact) values ('$supplierid','$suppliername','$jobtitle','$city','$address','$phone','$zipcode','$contact')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $supplierid=$_REQUEST['supplierid'];              
            
              $sql="delete from supplier where supplierid='$supplierid'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }else{
      echo '
      <p align=right>
    <a href=supplier.php?op=3><button type="button" class="btn btn-success">新增</button></a>  </p>
    <table class="example">
  	<thead>
  		<tr>
  			<td>供應商代號</td>
             <td>供應商寶號</td> 
             <td>職稱</td>
             <td>縣市</td>
             <td>地址</td>  
             <td>電話</td>
             <td>郵遞區號</td>  
             <td>聯絡人</td>
             <td> 編輯</td>			
             <td> 刪除</td>			
  		</tr>
  	</thead>
  	<tbody>
      ';
      include("connectdb.php");
      $sql = "SELECT supplierid,suppliername,jobtitle,city,address,phone,zipcode,contact FROM supplier";
  
      $result =$connect->query($sql);
  
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
          $supplierid=$row['supplierid'];
          $suppliername=$row['suppliername'];
          $jobtitle=$row['jobtitle'];
          $city=$row['city'];
          $address=$row['address'];
          $phone=$row['phone'];
          $zipcode=$row['zipcode'];
          $contact=$row['contact'];
  
          echo "<tr><TD>$supplierid<td> $suppliername<TD>$jobtitle<td>$city<TD> $address<td>$phone<TD> $zipcode<td>$contact";    
          echo "<TD><a href=supplier.php?op=1&supplierid=$supplierid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
          echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$suppliername]嗎?'))location='supplier.php?supplierid=$supplierid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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