
<?php
    include_once("../conexao.php");


if(date('N') > 4 ){
$data = new DateTime(date("Y-m-d"));
$data->modify('+3 day');
$data_rota=$data->format('Y-m-d');
$data_rota_layout=$data->format('d-m-Y');
}elseif(date('N') <= 4 ){
$data = date ("Y-m-d");
$inicio= $data;
$dia_seguinte=1;
$data_termino = new DateTime($inicio);
$data_termino->add(new DateInterval('P'.$dia_seguinte.'D'));
$data_rota=$data_termino->format("Y-m-d");
$data_rota_layout=$data_termino->format('d-m-Y');
}

$codusuario = $_SESSION['coduser'];


//comando rotinha popup
//procura se alguem ativou o botao
// $select_usu1 = "SELECT * from usuario where rotinha_ok = 1";
// $query_usu1 = mysqli_query($conexao, $select_usu1);
// $conta = mysqli_num_rows($query_usu1);// procura algum resultado

// //resultado encontrado:
// if($conta > 0){

// //seleciona todos os usuarios que nao visualizaram o botao
// $select_usu = "SELECT * from usuario where rotinha_ok = 0";
// $query_usu0 = mysqli_query($conexao, $select_usu);
// $conta2 = mysqli_num_rows($query_usu0);


$select_rotas = "SELECT * from rotinha where FK_datarg='$data_rota' and rotinha_ok='0'
					ORDER BY PK_codrotinha DESC";
$query_rota = mysqli_query($conexao, $select_rotas);
$cont = mysqli_num_rows($query_rota);


if($cont > 0){

$sele =mysqli_query($conexao, "SELECT * from usuario where rotinha_ok='0' and PK_coduser='$codusuario'");
$cont2 = mysqli_num_rows($sele);

$rotas_array = Array();
$limiteagend_array = Array();


if($cont2 > 0){

while($recebe = mysqli_fetch_assoc($query_rota)){
	$PK_rotinha = $recebe['PK_codrotinha'];
$pega_rota = "SELECT * FROM rotinha where PK_codrotinha='$PK_rotinha'";

$querry = mysqli_query($conexao, $pega_rota);
while($recebe2 = mysqli_fetch_assoc($querry)){
	// $nomerota = $recebe['FK_nomerota'];
	// $limiteagend = $recebe['limiteagend'];
	$PK_rotinha = $recebe2['PK_codrotinha'];
	$qtd_rotinha = $recebe2['qtd_rotinha'];
	$rotas = $recebe2['rotas'];
	$limite_agend = $recebe2['limite_rotinha'];
	$rotinha_ok = $recebe2['rotinha_ok'];

// loop
for($i = 0; $i <count($rotas); $i++) {

// valor sendo armazenado no array
$rotas_array[]=$rotas.' com '.$limite_agend.' vagas   \n';


}



}// while rotinha
}//while codigo





$implode = implode('*', $rotas_array);

$frase   = str_replace('*', '', $implode);




echo'
<script language="javascript">
alert("Rotinha Abertas:\n '.$frase.'\n\n até às 15h."); 
</script>';



$update = "UPDATE usuario set rotinha_ok='1' where PK_coduser = '$codusuario'";
$query_up = mysqli_query($conexao, $update);

}elseif($cont2 == 0){

}

}
//apos exibir o alert, o campo é setado para 0 novamente até alguém ativar o botao novamente


?>