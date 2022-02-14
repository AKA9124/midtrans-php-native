<?php
include "koneksi.php";
$query = mysqli_query($conn, "UPDATE transaksi set order_id='$_POST[order_id]' where id_transaksi='1'");  
if($query){
echo json_encode(array('message'=>'Data successfully Edit.'));
}else{
echo json_encode(array('message'=>'Data failed to Edit.'));
}
?>