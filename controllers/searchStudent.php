<? include $_SERVER['DOCUMENT_ROOT']."/models/model.php";

if (isset($_POST['search'] )){
       $dataPost = $_POST['search'];
       $Query = "SELECT `id`,`name`, `sername` FROM `student` WHERE `name` LIKE '%".$dataPost. "%' OR `sername` LIKE '%".$dataPost. "%' LIMIT 0, 10";
       $ExecQuery = MySQLi_query($link, $Query);
       while ($Result = MySQLi_fetch_array($ExecQuery)) {   
           
            $a3 = '<a class="searchPayElementDBa" alt='.$Result['id'].' onclick="fill(this)">'.$Result['name'].' '.$Result['sername'].'</li></a>';
            echo $a3;
            
       }


    //    $a1 = '<ul>';
    //    while ($Result = MySQLi_fetch_array($ExecQuery)) {   
           
    //        $a2 = '<li onclick="fill('.$Result['id'].')"';
    //         $a3 = '<a>'.$Result['name'].' '.$Result['sername'].'</li></a></ul>';
    //         echo $a1.$a2.$a3;
            
    //    }
       
    
    }

    ?>