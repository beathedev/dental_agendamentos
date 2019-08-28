<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
	header('location: ../index.php');
}
	include_once("../conexao.php");
date_default_timezone_set('America/Sao_Paulo');
$i=0;

?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Dental MV - Supervisor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery.min.js"> </script>
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);
			if (!screenfull.enabled) {
				return false;
			}
			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
		});
		</script>

<!---->

<!--pie-chart-->
<script src="js/pie-chart.js" type="text/javascript"></script>
<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->
</head>
<body>
<style type="text/css">
	input[type=date]::-webkit-inner-spin-button { 
    -webkit-appearance: none;
    cursor:pointer;
    display:block;
    width:8px;
    color: #333;
    text-align:center;
    position:relative;
}

</style>	  	 
<div id="wrapper">
<?php
include_once('menu.php');
include_once('../graficos.php');


$temErro = false;
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');

}


if(isset($_POST['enviar'])){
	$pknm = $_POST['pknm'];
	$implodepknm = implode(',', $pknm);
	$PK_codarea = $_POST['PK_codarea'];

	$contar_1 = $_POST['contar_1'];
	$contar_2 = $_POST['contar_2'];
// Ele pega a quantidade de agendamentos na rota vend
$dataentrega = $_POST['data_nova'];
$codigos = $_POST['codigos'];


$verificarotinha = "SELECT * from rotinha where FK_datarg = '$dataentrega'";
$resultrotinha = mysqli_query($conexao, $verificarotinha); 
$contar_rotinha = mysqli_num_rows($resultrotinha);
while($linhas = mysqli_fetch_array($resultrotinha)){
$PK_codrotinha = $linhas['PK_codrotinha'];
}



//conta quantidade de rota v:
$sql = "SELECT * from rotavend where FK_datarg = '$dataentrega'";
$result = mysqli_query($conexao, $sql);
$contador=mysqli_num_rows($result);
// $areasr=mysqli_fetch_row($result);


//insere valor do contador na rota:
$sql2 = "UPDATE rotageral SET qtdrotav='{$contador}' WHERE PK_datarg='{$dataentrega}' ";
$result = mysqli_query($conexao, $sql2);
}

$sql_rg = "SELECT * from rotageral where PK_datarg='{$dataentrega}'";
$query_rg = mysqli_query($conexao, $sql_rg);
while ($t = mysqli_fetch_assoc($query_rg)) {
	$contar_1 = $t['qtdrotav'];
}


 ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">
<?php

//Verica se a rota está bloqueada
$verifica_bloqueio = "SELECT * from rotavend where FK_datarg = '$dataentrega'";
$resultblock = mysqli_query($conexao, $verifica_bloqueio); 
while($linhas = mysqli_fetch_array($resultblock)){
$FK_nomerota = $linhas['FK_nomerota'];
$rotinha = $linhas['FK_codrotinha'];
}


if($contar_rotinha > 0){ 
echo'<center>';
echo'<form action="index_vendedor_rotinha.php" method="POST">';
echo'<input type="hidden" name="dataentrega" value="'.$dataentrega.'">';
echo'<br>';
echo'<input type="submit" name="enviarrt" class="btn btn-default" value="Registrar na Rotinha">
</center></form>';
exit;
 }   
else{    
?>
<form action="muda_area_3.php" method="POST">
<center><h3>Selecione uma Data e uma Área:</h3><br>
<input type="date" name="dataentrega" value="<?=$dataentrega?>" readonly></center>
<div class="content-top">
<table>
	<script type="text/javascript">
		
	</script>
<tr>
<?php 
//teste
$i = 0;
$aumenta = 0; 




if(isset($_POST['enviar'])){





if($contador > 0){



for ($io = 0; $io < count($pknm); $io++){ 

// 	echo "<br>contagem 1:";
// echo $io;
$sql_consulta = "SELECT * from rotavend where  FK_datarg = '$dataentrega' 
					and FK_nomerota ='$pknm[$io]' ORDER BY FK_nomerota ASC";
$result = mysqli_query($conexao, $sql_consulta);
if(mysqli_num_rows($result) > 0){
while($linhas = mysqli_fetch_array($result)){
// 	echo "<br>contagem 2:";
// echo $io;	
$nomerota[$io] = $linhas['FK_nomerota']; // valor da consulta de rota
$PK_codrotav = $linhas['PK_codrotav'];

$limite_agds = $linhas['limiteagend'];
$quantidadeagend = $linhas['quantidadeagend'];
$turno = $linhas['turno'];
//$i = 1; 
$quantidadeagend_total = $limite_agds;
$contap = 100 / $quantidadeagend_total;
$conta = $contap * $quantidadeagend;
$aumenta = $aumenta + 1;





echo'
<div class="col-md-6 ">
<div class="content-top-1">
<div class="col-md-6 top-content">
<input type="hidden" name="codigos" value="'.$codigos.'">
<input type="hidden" name="data_rota" value="'.$data_rota.'">
<input type="hidden" name="quantidadeagend'.$aumenta.'" value="'.$quantidadeagend.'">
<input type="hidden" name="quantidadeagend_total'.$aumenta.'" value="'.$quantidadeagend_total.'">
<h5 name='.$nomerota[$io].'>'.$nomerota[$io].'<input type="radio" name="area[]" value="'.$nomerota[$io].','.$PK_codrotav.'"/></h5>
<p>';
//Turno
if($turno == 1){
echo'                                             
<h6 class="bk"> Tarde</h4>
';
}else{
echo'                                             
<h6 class="bk"> Manhã</h6>
';
}//fim do turno

echo '</p>';
echo'<p>'.$quantidadeagend.' / '.$quantidadeagend_total.' vagas</p>';
echo'</div>
<div class="col-md-6 top-content1">	   
<div id="demo-pie-'.$aumenta.'" class="pie-title-center" data-percent="'.$conta.'">
<span class="pie-value"></span></div>
</div>
<div class="clearfix"> </div>
</div></div>';

if( $i%2 == 0 ) {
$i++;
}//separa coluna

}//while rotav
}else{
	// echo "<br> contagem 2:";
	// echo $io;	
	$nomerota[$io] = "nn tem";
}
}//for 

// $explode = explode(',', $nomerota);
$implode = implode(',', $nomerota);
// echo '<br> imp';
// var_dump($implode);
// echo '<br>';
// var_dump($implodepknm);
// echo '<br>';
//ADD areas novas ou ativadas
if($implode == $implodepknm){
	// echo "Areas = Rotas Vend <br>";
}else{
	// echo "Areas != Rotas Vend <br>";
	// echo count($pknm);
	$cnm = count($pknm);
	for($iar = 0; $iar < $cnm; $iar ++){
		
		// echo "<br> contagem"; echo $iar;
		// echo "<br>"; echo $pknm[$iar];
		// echo "<br>"; echo $nomerota[$iar];
		// echo "<br>";

		if($pknm[$iar] == $nomerota[$iar]){
			// echo $pknm[$iar];
			// echo " = ";
			// echo $nomerota[$iar];
		}else{
			// echo $pknm[$iar];
			// echo " diferente de ";
			// echo $nomerota[$iar];
			$rmito = mysqli_query($conexao, "INSERT INTO rotavend(FK_datarg, FK_nomerota)
											VALUES('$dataentrega','$pknm[$iar]')");
			if($rmito){ echo '<br>'.$pknm[$iar].' foi inserida';}
			else{echo'<br>Deu ruim';}
		}
		echo '<br>';
	}
}
// }//while area
}else{ //quando não existe rotaG no dia
// contador

// cria rota geral
$sql_insere = "INSERT INTO rotageral(PK_datarg) VALUES ('$dataentrega')";
$result_insere = mysqli_query($conexao, $sql_insere);

// pega o nome das rotas ativas
$sql_consulta = "SELECT PK_nomerota from area WHERE status='1'";
$results = mysqli_query($conexao, $sql_consulta); 
while ($linhass = mysqli_fetch_array($results)) {
$PK_nomerota2 =$linhass['PK_nomerota'];//variavel com o nome de rotas ativas


$sql_inseree = "INSERT INTO rotavend(FK_datarg, FK_nomerota) VALUES ('$dataentrega', '$PK_nomerota2')";
$result_inseree = mysqli_query($conexao, $sql_inseree);
}// area  

	$sql_consultaa = "SELECT * from rotavend where FK_datarg = '$dataentrega'";
	$resultaa = mysqli_query($conexao, $sql_consultaa); 
	while($linhas = mysqli_fetch_array($resultaa)){ 
	$nomerota = $linhas['FK_nomerota'];
	$quantidadeagend = $linhas['quantidadeagend'];
	$quantidadeagend_total = $linhas['limiteagend'];
	$nomerota2 = $linhas['FK_nomerota'];
	$PK_nomerota3 = $linhass['PK_nomerota'];


	$contap = 100 / $quantidadeagend_total;
	$conta = $contap * $quantidadeagend;
	$aumenta = $aumenta + 1;

echo'<div class="col-md-6 ">
<div class="content-top-1">
<div class="col-md-6 top-content">
<input type="hidden" name="codigos" value="'.$codigos.'">
<input type="hidden" name="data_rota" value="'.$data_rota.'">
<input type="hidden" name="quantidadeagend'.$aumenta.'" value="'.$quantidadeagend.'">
<input type="hidden" name="quantidadeagend_total'.$aumenta.'" value="'.$quantidadeagend_total.'">
<h5 name='.$nomerota[$io].'>'.$nomerota[$io].$PK_codrotav.'<input type="radio" name="area[]" value="'.$nomerota[$io].','.$PK_codrotav.'"/></h5>
<p>'.$quantidadeagend.' / '.$quantidadeagend_total.' vagas</p></div>

<div class="col-md-6 top-content1">	   
<div id="demo-pie-'.$aumenta.'" class="pie-title-center" data-percent="'.$conta.'">
<span class="pie-value"></span></div>
</div>
<div class="clearfix"> </div>
</div></div>';


if( $i%2 == 0 ) {
$i++;
}//divsor de colunas]


}// while rotavend

}// fim do contador


}
}


?>	
</div>
<div class="clearfix"> </div>
</div>
<div class="clearfix"> </div>
<center>
<br>
<a href="teste_verifica.php" class="btn-default"> Voltar</a>
<input type="submit"  name="enviar" class="btn btn-default" value="Criar">
</center>
</div>
</form>
<div class="content-mid">
</div>
</div>
</div>	
<div class="clearfix"> </div>
</div>
</div>
</div>
<div class="clearfix"> </div>
</div><div class="copy">
<p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
</div></div>
<div class="clearfix"> </div>
</div></div>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"> </script>
</body>
</html>