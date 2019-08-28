<?php
require_once("../conexao.php");
$PK_databloq = $_POST['inidate'];
$datadestino = $_POST['fimdate'];

$delete_data = "DELETE FROM datas_bloq where PK_databloq = '$PK_databloq'";
$query_delete_data = mysqli_query($conexao, $delete_data);
#header("Location: gerar_rotag.php");
if($query_delete_data == true){
  echo "foi";

}
?>