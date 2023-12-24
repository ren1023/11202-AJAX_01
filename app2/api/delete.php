<?php
//處理刪除資料的請求
include_once "db.php";

if(isset($_POST['id'])){
    $Student->del($_POST['id']);    //當此動作完成後，會自動回傳給前端，告知前端，此動作已完成
}

?>