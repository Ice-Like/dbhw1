<?php
include("auth.php");
include("template.php");

$header_other='
';

head("進銷存系統",$header_other);
menu($username);
content();

function content(){
    echo'
    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <h6 class="border-bottom pb-2 mb-0">近期登入資訊</h6>
        
    ';
    include("connectdb.php");
    $sql = "SELECT username,lastlogin,gender FROM user ORDER BY lastlogin DESC";

    $result =$connect->query($sql);
    $c = 0;
    while ($row = $result->fetch_assoc()) {
        if($c < 10){
            $username=$row['username'];
            $lastlogin=$row['lastlogin'];
            $gender=$row['gender'];
            echo '
            <div class="d-flex text-muted pt-3">
            ';
            if($gender==1){
                echo '<svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>';
            }else{
                echo '<svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>';
            }
            echo '
              <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="d-block text-gray-dark">@'.$username.'</strong>
                '.$lastlogin.'
              </p>
            </div>';
        }
        $c = $c + 1;
    }
    echo '
    </div>';
}

footer();
?>