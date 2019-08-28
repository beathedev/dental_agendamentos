<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
	header('location: ../index.php');
}
	include_once("../conexao.php");
date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Dental MV - Admin</title>
<meta http-equiv="refresh" content="60">
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

?>
<?php
$temErro = false;
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');

}
?>


        <div id="page-wrapper" class="gray-bg dashbard-1">

         <div class="content-main"> 


<?php
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
// echo $data_rota;
}

$sql_data = mysqli_query($conexao, "SELECT * from datas_bloq WHERE PK_databloq = '$data_rota'");
if(mysqli_num_rows($sql_data) > 0){
while($result_data = mysqli_fetch_assoc($sql_data)){
  $PK_databloq = $result_data['PK_databloq'];
  $datadestino = $result_data['datadestino'];
  $data_rota = $datadestino;
  $a = date($data_rota);
  $dia_seguinte=0;
  $data_termino = new DateTime($data_rota);
  $data_termino->add(new DateInterval('P'.$dia_seguinte.'D'));
  $data_rota=$data_termino->format("Y-m-d");
  $data_rota_layout=$data_termino->format('d-m-Y');
}
}
?>

		<div class="content-top">

        <center><h3>Rotas do dia:</h3><br>
        <input type="text" class="form-control" id="exampleInputEmail1"  style="width:132px;font-size:12px;" value="<?=$data_rota_layout?>" readonly>
        </center>

      <input type="hidden" class="form-control" id="exampleInputEmail1" name="data"  style="width:132px;font-size:12px;" value="<?=$data_rota?>" readonly>

<?php
$aumenta = 0;
// seleciona a rotav pela data
$sql_consulta = "SELECT * from rotavend where FK_datarg = '$data_rota'";
$result = mysqli_query($conexao, $sql_consulta); 
while($recebe = mysqli_fetch_assoc($result)){
$bloqueado =$recebe['bloqueado'];
}// while recebe
$contador_rotas=mysqli_num_rows($result);
if($contador_rotas > 0){
$sql_rotinha = "SELECT * from rotinha where FK_datarg = '$data_rota'";
$sql_rotinha_query = mysqli_query($conexao, $sql_rotinha);
$conta_rotinha = mysqli_num_rows($sql_rotinha_query);

//se exister vai aparecer a opçao de bloquear e o status das rotas:
echo '<br>';
echo '<center>';
echo'<a href="alterar_limite.php" class="btn btn-default">Alterar limite de vagas</a>';

if($bloqueado == 0){

echo '<style type="text/css">#some{ display:none;}</style>
<input type="submit" name="bloquear" class="btn btn-default" value="Bloquear Rota"> ';
}else{
	echo '<input type="submit" name="enviar" class="btn btn-default" value="Criar Rotinha"> ';
echo ' <input type="submit" name="desbloquear" class="btn btn-default" value="Desbloquear Rota"> ';



if($conta_rotinha > 0){
echo '<br><br><P>'.$conta_rotinha.' rotinha(s) foram criadas <br><a href="rotinhas.php"  class="btn btn-default" value=""> Ver Rotinhas </a>
<style type="text/css">
	.some2{
		display: none;
	}
	#some3{
	visibility:hidden;
}
</style>


';
}//rotinha











}// bloqueado

echo '<br>';echo '<br>';

echo '</center>';


$sqll = "SELECT * from area where status = 1 ORDER BY PK_nomerota ASC";
$result_sqll = mysqli_query($conexao, $sqll); 
while($rota = mysqli_fetch_array($result_sqll)){
 $PK_nomerota = $rota['PK_nomerota'];

$sql_consulta2 = "SELECT * from rotavend where FK_datarg = '$data_rota' and FK_nomerota='$PK_nomerota' ORDER BY FK_nomerota ASC";
$result2 = mysqli_query($conexao, $sql_consulta2); 


while($linhas = mysqli_fetch_array($result2)){
$nomerota = $linhas['FK_nomerota'];
$quantidadeagend = $linhas['quantidadeagend'];
$limiteagend = $linhas['limiteagend'];
$contap = 100 / $limiteagend;
$conta = $contap * $quantidadeagend;

$i = 1; 
$aumenta = $aumenta + 1;

echo'<div class="col-md-6 ">
<div class="content-top-1">
<div class="col-md-6 top-content">
<h5 name='.$nomerota.'>'.$nomerota.'<input type="checkbox"  id="some" name="area[]" value="'.$nomerota.'"/></h5>
<p>'.$quantidadeagend.' <span class="some2">/ '.$limiteagend.' vagas </span>';
if($conta_rotinha > 0 && $bloqueado == 1){
	echo'<p>Agendamento(s)';
}

echo'
</p>
</div>

<div class="col-md-6 top-content1" id="some3" >    
<div  id="demo-pie-'.$aumenta.'" class="pie-title-center" data-percent="'.$conta.'" >
<span class="pie-value"></span></div>
</div>
<div class="clearfix"> </div>
</div></div>
';
if( $i%2 == 0 ) {
echo '<div class="col-md-6">';
echo '</form>';

$i++;
}
}
}// fim do while*
}//contador
else{
	echo "<center><br>Nenhuma rota criada ainda</center>";
}
?>



</div>
  <br> <br> <br> <br><br> <br> <br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br>  <br> <br> <br> <br><br> <br> <br> <br><br> <br>
 <br>
	<div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
	    </div>
		</div>
		<div class="clearfix"> </div>
       </div>
     </div>	</div>
	</div>
	<div class="content-mid">		
	</div>
	</div>
	</div>
	<div class="clearfix"> </div>
	</div>
	</div>
</div>
<div class="clearfix"> </div>
</div>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"> </script>
</body>
</html>