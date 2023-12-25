<?php
include_once "db.php";

//處理查詢資料的請求
switch($_GET['do']){ 
    case 'all': //收到index.html的 do=all的參數
        header('Content-Type: application/json; charset=utf-8'); //宣告回傳的資料要用json
        echo json_encode($Student->all());  //將搜尋的結果，轉成json格式，傳給前端
    break;
    case 'sex':
        $users=$Student->q("select `id`,`name`,`uni_id`,`school_num`,`birthday` from `students` where substr(`uni_id`,2,1)='{$_GET['value']}'"); //uni_id欄位，從第二個字，取一個字的值。

        header('Content-Type: application/json; charset=utf-8');        
        echo json_encode($users);
    break;
    case 'class':
        
        $stnums=$ClassStudent->all(['class_code'=>$_GET['value']]);//透過從index.html傳來的一年一班，去撈班級代號
        //dd($stnums);
        $nums=[];
        foreach($stnums as $st){
            $s=$Student->find(['school_num'=>$st['school_num']]);//拿從班級資料的班級代號，再去學生資料表中，找到該班級的學生，再將這個學生的id放到$nums[]這個陣列中。
            if(!empty($s)){
                $nums[]=$s['id'];//將id欄位的資料，存在陣列中
            }
        }
        $in=join(',',$nums);// 再將陣列中的數字以"，"號，分隔開來，提供給下一個查詢中的in資料，做in的條件查詢。
        $users=$Student->q("select `id`,`name`,`uni_id`,`school_num`,`birthday` from `students` where `id` in($in)");

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($users);
            
    break;
    case 'classes':
        $classes=$Class->q("select `code`,`name` from `classes`");//取得所有班級相關資料，&#39=',單引號 
        header('Content-Type: application/json; charset=utf-8');        
        echo json_encode($classes);
    break;
}

?>