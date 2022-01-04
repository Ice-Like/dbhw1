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

head("員工基本資料", $header_other);
menu($username,$select='employee');
?>
    
    <div class="container">

  <?php
  
  function display_form($op,$empid)
  {

    
      if ($op==3)
      {
        $empid="";
        $empname="";
        $jobtitle="";
        $deptid="";
        $city="";
        $address="";
        $phone="";
        $zipcode="";
        $monthsalary="";
        $annualleave="";
        $op=4;

      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT empid,empname,jobtitle,deptid,city,address,phone,zipcode,monthsalary,annualleave FROM employee where empid='$empid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                  $empid=$row['empid'];
                  $empname=$row['empname'];
                  $jobtitle=$row['jobtitle'];
                  $deptid=$row['deptid'];
                  $city=$row['city'];
                  $address=$row['address'];
                  $phone=$row['phone'];
                  $zipcode=$row['zipcode'];
                  $monthsalary=$row['monthsalary'];
                  $annualleave=$row['annualleave'];
              }
                $op=2;
      }


      echo "<form action=employee.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
              <input type='text' class='form-control' name=empid id='empid' placeholder='請輸入員工代號' value=$empid>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>員工名稱</label>
              <input type='text' class='form-control' name=empname id='empname' placeholder='請輸入員工名稱' value=$empname>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>現任職稱</label>
              <input type='text' class='form-control' name=jobtitle id='jobtitle' placeholder='請輸入現任職稱' value=$jobtitle>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>部門代號</label>
              <input type='text' class='form-control' name=deptid id='deptid' placeholder='請輸入部門代號' value=$deptid>
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
              <label for='exampleFormControlInput1' class='form-label'>月薪資</label>
              <input type='text' class='form-control' name=monthsalary id='monthsalary' placeholder='請輸入月薪資' value=$monthsalary>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>年假天數</label>
              <input type='text' class='form-control' name=annualleave id='annualleave' placeholder='請輸入年假天數' value=$annualleave>
            </div>
            ";
      echo " <div class='col-auto'>
              <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
              <button type='reset' class='btn btn-primary mb-3'>重新輸入</button>                            
            </div>";
      echo "</form>";

  }

function pageBack(){
    echo "<script>window.location.href='employee.php';
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
                  $empname=$_REQUEST['empname'];
                  $jobtitle=$_REQUEST['jobtitle'];
                  $deptid=$_REQUEST['deptid'];
                  $city=$_REQUEST['city'];
                  $address=$_REQUEST['address'];
                  $phone=$_REQUEST['phone'];
                  $zipcode=$_REQUEST['zipcode'];
                  $monthsalary=$_REQUEST['monthsalary'];
                  $annualleave=$_REQUEST['annualleave'];

                  $sql="update employee
                          set empid='$empid',
                              empname='$empname',
                              jobtitle='$jobtitle',
                              deptid='$deptid',
                              city='$city',
                              address='$address',
                              phone='$phone',
                              zipcode='$zipcode',
                              monthsalary='$monthsalary',
                              annualleave='$annualleave'
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
              $empname=$_REQUEST['empname'];
              $jobtitle=$_REQUEST['jobtitle'];
              $deptid=$_REQUEST['deptid'];
              $city=$_REQUEST['city'];
              $address=$_REQUEST['address'];
              $phone=$_REQUEST['phone'];
              $zipcode=$_REQUEST['zipcode'];
              $monthsalary=$_REQUEST['monthsalary'];
              $annualleave=$_REQUEST['annualleave'];

              $sql="insert into employee (empid,empname,jobtitle,deptid,city,address,phone,zipcode,monthsalary,annualleave) values ('$empid','$empname','$jobtitle','$deptid','$city','$address','$phone','$zipcode','$monthsalary','$annualleave')";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;      
        case 5: //刪除資料              
              $empid=$_REQUEST['empid'];              
            
              $sql="delete from employee where empid='$empid'";
              include("connectdb.php");
              #include('dbutil.php');
              execute_sql($sql);
              pageBack();
              break;

      }      
  
    }else{
      echo '
      <p align=right>
    <a href=employee.php?op=3><button type="button" class="btn btn-success">新增</button></a>  </p>
    <table class="example">
  	<thead>
  		<tr>
  			<td>員工代號</td>
             <td>員工名稱</td> 
             <td>現任職稱</td>
             <td>部門代號</td>  
             <td>縣市</td>
             <td>地址</td>  
             <td>電話</td>
             <td>郵遞區號</td>  
             <td>月薪資</td>
             <td>年假天數</td>  
             <td> 編輯</td>			
             <td> 刪除</td>			
  		</tr>
  	</thead>
  	<tbody>
      ';
      include("connectdb.php");
      $sql = "SELECT empid,empname,jobtitle,deptid,city,address,phone,zipcode,monthsalary,annualleave FROM employee";
  
      $result =$connect->query($sql);
  
      /* fetch associative array */
      while ($row = $result->fetch_assoc()) {
          //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
          $empid=$row['empid'];
          $empname=$row['empname'];
          $jobtitle=$row['jobtitle'];
          $deptid=$row['deptid'];
          $city=$row['city'];
          $address=$row['address'];
          $phone=$row['phone'];
          $zipcode=$row['zipcode'];
          $monthsalary=$row['monthsalary'];
          $annualleave=$row['annualleave'];
  
          echo "<tr><TD>$empid<td> $empname<TD>$jobtitle<td> $deptid<TD>$city<td> $address<TD>$phone<td> $zipcode<TD>$monthsalary<td> $annualleave";    
          echo "<TD><a href=employee.php?op=1&empid=$empid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
          echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$empname]嗎?'))location='employee.php?empid=$empid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
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