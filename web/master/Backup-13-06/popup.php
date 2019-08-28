<?php

if(isset($_POST['criar'])){
session_start();

$codusuario = $_SESSION['coduser'];

$nomerota1= $_POST['area']; //array
$area_t = $_POST['area_t']; //string
$vagas = $_POST['vagas2'];
$data = $_POST['data2'];


//procura o usuario q ativou o popup
$update = "UPDATE usuario set rotinha_ok = 1 where PK_coduser ='$codusuario'";
$update_query = mysqli_query($conexao, $update);
if($update_query == true){

//procura os usuarios q nao ativaram o botao
$select_usu = "SELECT * from usuario where rotinha_ok = 0"; 
$query_usu = mysqli_query($conexao, $select_usu);
$contar = mysqli_num_rows($query_usu);
if($contar > 0){

// busca as rotinhas  do dia pra exibir pros usuarios q nao apertaram o botao
$select_rotas = mysqli_query($conexao, "SELECT * from rotinha where FK_datarg='$data_rota'
					ORDER BY PK_codrotinha DESC LIMIT 1");

while ($recebe = mysqli_fetch_array($select_rotas)){
// $nomerota = $l['FK_nomerota'];
	$PK_rotinha = $recebe['PK_rotinha'];
	$qtd_rotinha = $recebe['qtd_rotinha'];
	$rotas = $recebe['rotas'];
	$limite_agend = $recebe['limite_agend'];
	$rotinha_ok = $recebe['rotinha_ok'];
}


if($select_rotas == true){
echo'
<script language="javascript">
alert("Rotinha '.$rotas.' foi aberta com '.$limite_agend.'vagas até às 15h"); 
</script>';

}

// }
}
}
}
   header("Location: index.php");



?>
