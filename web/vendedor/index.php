<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
	header('location: ../login.php');
}
  include_once("../conexao.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Dental MV - Vendedor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Dental MV - Vendedor" />

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
include_once('menu_vendedor.php');
?>
<?php
$temErro = false;
$dataentrega = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataentrega = filter_input(INPUT_POST, 'dataentrega');
}
?>


<div id="page-wrapper-md-12" class="gray-bg dashbard-1">	

		
<form action="index_vendedor.php" method="POST">
 <div class="content-main">

 <center>

<?php
//comando pula dia

date_default_timezone_set('America/Sao_Paulo');

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

$sql_data = mysqli_query($conexao, "SELECT * from datas_bloq WHERE data = '$data_rota'");
if(mysqli_num_rows($sql_data) > 0){
while($result_data = mysqli_fetch_assoc($sql_data)){
  $coddatabloq = $result_data['coddatabloq'];
  $data = $result_data['data'];
  $datafinal =$result_data['datafinal'];

  $data_rota = $datafinal;
  $dataentrega = $data_rota;
}
}
// uahsuashuashaush

$sql_areabloq = mysqli_query($conexao, "SELECT * from area_bloq where status=0 group by FK_nomerota ");
while($bloq = mysqli_fetch_assoc($sql_areabloq)){
 $nomerotass = $bloq['FK_nomerota'];

$sql_u = mysqli_query($conexao, "SELECT * FROM area WHERE status='1'  order by codarea asc");
$contar_2 = mysqli_num_rows($sql_u);
// echo'<form action="index_vendedor.php" method="POST">';
while($ll = mysqli_fetch_assoc($sql_u)){
 $PK_nomerota = $ll['PK_nomerota'];
$PK_codarea = $ll['codarea'];
echo'<input type="hidden" name="PK_codarea[]" value="'.$PK_codarea.'">';
echo'<input type="hidden" name="pknm[]" value="'.$PK_nomerota.'">';
echo'<input type="hidden" name="pknm2[]" value="'.$nomerotass.'">';

$sql_consulta1 = "SELECT * from rotavend where FK_datarg = '$dataentrega' and FK_nomerota ='$PK_nomerota' ORDER BY FK_nomerota ASC";
$resulta2 = mysqli_query($conexao, $sql_consulta1);
while($lll = mysqli_fetch_assoc($resulta2)){
$FK_nomerota = $lll['FK_nomerota'];
// echo'<input type="text" name="FK_nomerota_5[]" value="'.$FK_nomerota.'">';
}
}
}

// echo'</form>';
//consulta na rota todas as areas que possuem a area ativa.
$sql_consulta = "SELECT * from rotavend where FK_datarg = '$dataentrega' and FK_nomerota ='$PK_nomerota' ORDER BY FK_nomerota ASC";
$result = mysqli_query($conexao, $sql_consulta);
?>
<div class="content-top">

<h3>Selecione uma Data:</h3><br>
<input type="date" class="form-control" id="datepicker" name="dataentrega"  style="width:132px;font-size:12px;" value="<?=$data_rota?>" ></center>
		
<div class="col-md-6">
</div>
	
<div class="clearfix"> </div>
<br>
<input type="hidden" value="<?=$contar_1?>" name="contar_1">
<input type="hidden" value="<?=$contar_2?>" name="contar_2">
<center><input type="submit"  name="enviar" class="btn btn-default" value="Verificar">	</center>

</br></br></br></br>
</br></br></br></br>
</br></br>

</div>
	
</form>
<div class="content-mid">
</div></div></div>

<div class="clearfix"> </div>
	</div></div></div>
<div class="clearfix"> </div>
</div>
		<!--//content-->

<div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
	    </div>
		</div>
		<div class="clearfix"> </div>
       </div>
     </div>
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="js/bootstrap.min.js"> </script>

</body>
</html>

