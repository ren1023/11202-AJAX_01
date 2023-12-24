<?php
include_once "db.php";
//處理查詢資料的請求
switch($_GET['do']){
    case "all":
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($Student->all());
    break;
    case 'sex':
        $users=$Student->q("select `name`,`uni_id`,`school_num`,`birthday` from `students` where substr(`uni_id`,2,1)='{$_GET['value']}'");

        header('Content-Type: application/json; charset=utf-8');        
        echo json_encode($users);
    break;
    case 'class':
        
        $stnums=$ClassStudent->all(['class_code'=>$_GET['value']]);
        //dd($stnums);
        $nums=[];
        foreach($stnums as $st){
            $s=$Student->find(['school_num'=>$st['school_num']]);
            if(!empty($s)){
                $nums[]=$s['id'];
            }
        }
        $in=join(',',$nums);
        $users=$Student->q("select `name`,`uni_id`,`school_num`,`birthday` from `students` where `id` in($in)");

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($users);
            
    break;
    case 'classes':
        $classes=$Class->q("select `code`,`name` from `classes`");
        header('Content-Type: application/json; charset=utf-8');        
        echo json_encode($classes);
    break;
}

?>