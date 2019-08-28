<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
	header('location: ../index.php');
}
    include_once("../conexao.php");
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
<link href="css/tabela.css" rel="stylesheet"> 
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
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');

}
    // ... validações, inserts, updates, etc...
function exibir_dados() {
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
}
?>


        <div id="page-wrapper" class="gray-bg dashbard-1">

         <div class="content-main">
         	<div class="table-responsive">

<center>


           <a href="index.php" class="btn btn-default" style="width:195px;"> Voltar </a><br><br>
<table class="greyGridTable" >
<thead>
<tr>
<th>#</th>
<th>Area</th>
<th>Status</th>


</tr>
</thead>

<tbody>
 <?php

$sql = "SELECT * from area ORDER BY PK_nomerota DESC";
$query = mysqli_query($conexao, $sql);
while($linhas = mysqli_fetch_assoc($query)){
$PK_nomerota = $linhas['PK_nomerota'];
$codarea = $linhas['codarea'];
$status = $linhas['status'];

echo '    
<form method="POST" id="formDel">
<tr>
<td><input type="text" name="codarea" value="'.$codarea.'" readonly="readonly"></td>
<td><input type="text" name="area" value="'.$PK_nomerota.'"   readonly="readonly" style="margin-top:10px;"></td>';

if($status == 1){
echo'
<td>Ativo</td>';
}else{
echo'
<td>Inativo</td>';
}

echo'</tr>';
echo '</td></form>';

}




if(isset($_POST['enviar'])){
$status = $_POST['status'];
$codarea = $_POST['codarea'];
$FK_nomerota = $_POST['area'];

echo'
<form method="POST" id="formConfirm">
<input type="hidden" name="codarea" value="'.$codarea.'" readonly="readonly">
<input type="hidden" name="area" value="'.$FK_nomerota.'" readonly="readonly">
<input type="hidden" name="status" value="'.$status.'" readonly="readonly">
</form>';


$sl = mysqli_query($conexao, "SELECT * FROM rotavend 
		WHERE FK_nomerota = '$FK_nomerota' and FK_datarg >= '$data_rota'");
while($sla = mysqli_fetch_assoc($sl)){
	$codrv = $sla['PK_codrotav'];
	$quantidadeagend = $sla['quantidadeagend'];
	$FK_datarg = $sla['FK_datarg'];
	$FK_nomerota = $sla['FK_nomerota'];

	$slag = mysqli_query($conexao, "SELECT * FROM agend WHERE FK_codrotav = '$codrv'");
	$numsla = mysqli_num_rows($slag);
	while($slagg = mysqli_fetch_assoc($slag)){
		$codagend = $slagg['PK_codagend']; 
	}//while agend
	}// while rotavend

//contador
if($numsla > 0){
echo'
<script>
var x;
var r=confirm("Você está prestes a inativar uma area que possui agendamento!\nDeseja mesmo fazer isso?");
if (r==true)
  {
  form=document.getElementById("formConfirm");
  form.target="";
  form.action="lista_area_up.php";
  form.submit();
  }
</script>';

}else{//else contador

echo'
<script>

var x;
var r=confirm("Você está prestes a inativar uma area\n Deseja mesmo fazer isso?");
if (r==true)
  {
  form=document.getElementById("formConfirm");
  form.target="";
  form.action="lista_area_up.php";
  form.submit();
  }
</script>';


}// fim else contador


}// fim isset
?>
</div>
</div>
</tbody>
</table>
</center>


  		<!--banner-->	
		<!--//banner-->
		<!--content-->
		<div class="content-top">



</div>

	<div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
	    </div>
		</div>
		<div class="clearfix"> </div>
       </div>
     </div>	</div>
			</div>

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


	 
		<!---->

<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="js/bootstrap.min.js"> </script>
</body>
</html>

