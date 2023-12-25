<?php
include_once "db.php";

$schools=$GraduateSchool->all();
$options="";

foreach($schools as $school){
    $options.="<option value='{$school['id']}'>{$school['county']}{$school['name']}</option>";
}

echo $options;

?>