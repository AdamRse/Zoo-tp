<?php
function transformArrayToSqlWhere($array, $tableUpdate){
    $sql = "UPDATE $tableUpdate SET ";
        foreach($array as $col => $val){
            if($col != "id")
                $sql .= "$col = :$col, ";
        }
    return substr($sql, 0, -2)." WHERE id = :id";
}