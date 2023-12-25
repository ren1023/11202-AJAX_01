<?php
include_once "db.php";
$input=$_GET['input'];

$res=$Student->q("select `id`,`name` from `students` where `name` like '%$input%' limit 6");
foreach($res as $r){
    echo "<div class='m-2 border-bottom p-2'>";
    echo $r['name'];
    echo "</div>";
}