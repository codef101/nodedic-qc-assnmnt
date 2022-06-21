<?php
function deleteTableRow($conn,$tableName,$id){
    $sql="DELETE FROM {$tableName} WHERE id = {$id}";
    $query = mysqli_query($conn,$sql);
    return $query;
}
?>
