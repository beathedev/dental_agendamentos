<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
	header('location: ../index.php');
  }include_once("../conexao.php");



?>

<!DOCTYPE HTML>
<html>
<head>
<title>Dental MV - Supervisor</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords"/>

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

<!----->

<!--pie-chart--->
<?php
include_once('../graficos.php');
?>
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
?>
<?php
$temErro = false;
$dataentrega = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $dataentrega = filter_input(INPUT_POST, 'dataentrega');
}// ... validações, inserts, updates, etc...

if(isset($_POST['enviar'])){
// Ele pega a quantidade de agendamentos na rota vend
$dataentrega = $_POST['dataentrega'];
/*$sql = "SELECT `quantidadeagend` FROM `rotavend` WHERE `FK_datarg` = '$dataentrega'";
$result = mysqli_query($conexao, $sql); // Realiza Query
while($linhas = mysqli_fetch_assoc($result)){
$quantidadeagend = $linhas['quantidadeagend'];
// Transforma consulta em array
$array = explode(',', $quantidadeagend);
var_dump($array);
  echo '<br/>';
  */

$verifica_bloqueio = "SELECT bloqueado from rotavend where FK_datarg = '$dataentrega'";
$result = mysqli_query($conexao, $verifica_bloqueio); 
while($linhas = mysqli_fetch_array($result)){
$bloqueado = $linhas['bloqueado'];
}

//conta quantidade de rota v:
$sql = "SELECT * from rotavend where FK_datarg = '$dataentrega'";
  $result = mysqli_query($conexao, $sql); // Realiza Query
  $contador=mysqli_num_rows($result);
  $areasr=mysqli_fetch_row($result);
  echo $contador;
  echo '"contador"<br/>';

//insere valor do contador na rota:
$sql2 = "UPDATE rotageral SET qtdrotav='{$contador}' WHERE PK_datarg='{$dataentrega}' ";
  $result = mysqli_query($conexao, $sql2);
}

// 
/*$sql3 = "SELECT qtdrotav from rotageral where PK_datarg = '$dataentrega'";
  $result = mysqli_query($conexao, $sql3); // Realiza Query
  $qtdrotav=mysqli_num_rows($result);
  echo $qtdrotav;
  echo '<br/>';
*/
//teste
/*$sql_ahhh = "SELECT * from rotavend where FK_datarg = '$dataentrega'";
  $result = mysqli_query($conexao, $sql_ahhh);
  $a = mysqli_fetch_assoc($conexao, $sql_ahhh);
#for ($i2=0; $i2 < ; $i2++) { 
	#$a[$i2] = 
#}*/
 ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">	


		
       <form action="cadastrar_agend_admin.php" method="POST">
         <div class="content-main">
         	<?php
         		if($bloqueado == 1 ){
echo '<center><div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Essa Rota Já Foi Bloqueada">
      </div>
<a href="cadastrar_agend.php" class="btn btn-default">Voltar</a>
      </center><br><br><br><br><br>


<div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
	    </div>
		</div>
		<div class="clearfix"> </div>
       </div>
     </div>

      ';
      
}else{
     
?>
 <center><h3>Selecione uma Data e uma Área:</h3><br>
 	<input type="date" name="dataentrega" value="<?=$dataentrega?>" readonly></center>
		<!--banner-->	
		<!--//banner-->
		<!--content-->
<div class="content-top">
	<table>
	 <tr>
<?php 
//teste
$i = 0;
$aumenta = 0; 
if(isset($_POST['enviar'])){
$sql_consulta = "SELECT * from rotavend where  FK_datarg = '$dataentrega'";
$result = mysqli_query($conexao, $sql_consulta);

if($contador > 0){
while($linhas = mysqli_fetch_array($result)){
$nomerota = $linhas['FK_nomerota'];
$quantidadeagend = $linhas['quantidadeagend'];
$quantidadeagend_total = $linhas['limiteagend'];

//$i = 1; 
$contap = 100 / $quantidadeagend_total;
$conta = $contap * $quantidadeagend;


$aumenta = $aumenta + 1;

echo'

<div class="col-md-6 ">
<div class="content-top-1">
<div class="col-md-6 top-content">

<h5 name='.$nomerota.'>'.$nomerota.'<input type="radio" name="area" value="'.$nomerota.'"/></h5>
<p>'.$quantidadeagend.' / '.$quantidadeagend_total.' vagas</p>


</div>

<div class="col-md-6 top-content1">	   
<div id="demo-pie-'.$aumenta.'" class="pie-title-center" data-percent="'.$conta.'">
<span class="pie-value"></span></div>
</div>
<div class="clearfix"> </div>
</div></div>';
 	if( $i%2 == 0 ) {


	$i++;

	}
	}
}else{
	// cria rota geral
$sql_insere = "INSERT INTO rotageral(PK_datarg) VALUES ('$dataentrega')";
$result_insere = mysqli_query($conexao, $sql_insere);

	// pega o nome da rota
$sql_consulta = "SELECT PK_nomerota from area";
$results = mysqli_query($conexao, $sql_consulta); 
while ($linhass = mysqli_fetch_array($results)) {
	$PK_nomerota =$linhass['PK_nomerota'];


	$sql_inseree = "INSERT INTO rotavend(FK_datarg, FK_nomerota) VALUES ('$dataentrega', '$PK_nomerota')";
	$result_inseree = mysqli_query($conexao, $sql_inseree);

	$sql_consultaa = "SELECT * from rotavend where  FK_datarg = '$dataentrega'";
	$resultaa = mysqli_query($conexao, $sql_consultaa); }
	while($linhas = mysqli_fetch_array($resultaa)){
	$nomerota = $linhas['FK_nomerota'];
	$quantidadeagend = $linhas['quantidadeagend'];
	$quantidadeagend_total = 7;
	$contap = 100 / $quantidadeagend_total;
	$conta = $contap * $quantidadeagend;


$aumenta = $aumenta + 1;

echo'<div class="col-md-6 ">
<div class="content-top-1">
<div class="col-md-6 top-content">
<h5 name='.$nomerota.'>'.$nomerota.'<input type="radio" name="area" value="'.$nomerota.'"/></h5>
<p>'.$quantidadeagend.' / '.$quantidadeagend_total.' vagas</p>


</div>

<div class="col-md-6 top-content1">	   
<div id="demo-pie-'.$aumenta.'" class="pie-title-center" data-percent="'.$conta.'">
<span class="pie-value"></span></div>
</div>
<div class="clearfix"> </div>
</div></div><br>';


 if( $i%2 == 0 ) {



$i++;
}
}


}

}
}
?>
		
</div>
<div class="clearfix"> </div>
		

		


</div>


		



		<div class="clearfix"> </div>

					<center>
<br>
      <input type="submit"  name="enviar" class="btn btn-default" value="Criar">
     		</center>
		</div>
	</form>


		<!---->
	
  
		<div class="content-mid">
			
			
	    </div>
	</div>
	</div>

		
			<div class="clearfix"> </div>
		</div>
		<!----->
		<!--<div class="content-bottom">
			
			<div class="clearfix"> </div>
		</div>-->

				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<!--//content-->
<br><br><br><br><br>
	 
		<!---->
<div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
	    </div>
		</div>
		<div class="clearfix"> </div>
       </div>
     </div>
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="js/bootstrap.min.js"> </script>
</body>
</html>

