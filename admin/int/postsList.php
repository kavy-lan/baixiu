<?php 
    include '../../functions.php';
    if($_SERVER['REQUEST_METHOD']=='GET'){

        $page=isset($_GET['page'])?$_GET['page']:1;
        $pageSize=10;
        $count = select("select count(*) as dataCount from posts");
       $pageCount = ceil($count[0]['dataCount']/$pageSize);
       $offset = ($page-1)*$pageSize;
        $res=select("select p.title,p.slug,p.created,p.status,p.id,c.name from posts as p left join categories as c on p.category_id=c.id limit $offset, $pageSize");
       
        if($res){
            $arr=array(
                "code"=>200,
                "msg"=>"读取成功",
                "pageCount"=>$pageCount,
                "data"=>$res
            );
            echo json_encode($arr);
        }else{
             $arr=array(
                "code"=>201,
                "msg"=>"读取失败",
               
            );
            echo json_encode($arr);
            
        }
    }


 ?>