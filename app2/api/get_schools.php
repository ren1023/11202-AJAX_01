<?php
include_once "db.php";
$schools=$GraduateSchool->all();
$options="";
if(isset($_GET['id'])){
    $user=$Student->find($_GET['id']);  //如果有id，則去撈學生的資料
}
foreach($schools as $school){
    $selected=(isset($user) && ($user['graduate_at']==$school['id']))?'selected':'';  //如有撈出學生資料，而且 學生資料的畢業學校id等於 畢業學校的id，就在option中的這個選項加入selected，表示已有選中
    $options.="<option $selected value='{$school['id']}'>{$school['county']}{$school['name']}</option>";
}

echo $options;

?>