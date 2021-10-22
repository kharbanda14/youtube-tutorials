<?php 
    if(isset($_GET['filter'])){
        $filter = trim($_GET['filter']);
        if(!empty($_GET['filter'])){
            $con = mysqli_connect('localhost','root','','tutorial');
            if($filter == 'all'){
                $stmnt = $con->prepare('select * from staff');
            }else {
                $stmnt = $con->prepare('select * from staff where type=?');
                $stmnt->bind_param('s',$filter);
            };
            $stmnt->execute();
            $stmnt->store_result();
            $stmnt->bind_result($id,$fname,$lname,$type);
            $final = array();
            while($stmnt->fetch()){
                $each = array(
                    'id'=>$id,
                    'fname'=>$fname,
                    'lname'=>$lname,
                    'type'=>$type
                );
                array_push($final,$each);
            };
            echo json_encode($final);
            $stmnt->close();
            $con->close();
        };
    };
?>