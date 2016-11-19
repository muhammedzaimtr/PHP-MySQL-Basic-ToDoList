<?php

include "init.php";
if($_POST){
    $Note   = trim(strip_tags($_POST["note"]));
    if($Note == ""){
        echo "warning";
    }else{
        $ekle = $db->prepare("insert into notes(note) values (?)");
        $ekle->execute([$Note]);
        if($ekle->rowCount() > 0){
            echo "success";
        }else{
            echo "warning";
        }
    }

}else{
    header("location:index.php");
}

 ?>
