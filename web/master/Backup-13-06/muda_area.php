<title>Dental MV - Admin</title><?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
	header('location: ../index.php');
}
	include_once("../conexao.php");
date_default_timezone_set('America/Sao_Paulo');
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
<title>Dental MV - Admin</title>
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

if(isset($_POST['alterar'])){
 $codigo = $_POST['alterar'];
 $area_t = implode(',', $codigo); //Codigo agendamento




ECHO'<form action="muda_area_2.php" method="POST">
<input type="hidden" name="codigos" value="'.$area_t.'">';?>
		<div class="content-top">
        <center><h3>Escolha uma Data:</h3><br>
      <input type="date" class="form-control" id="exampleInputEmail1" value="<?=$data_rota?>" name="data_nova" style="width:132px;font-size:12px;" value="">
      <?php
$sql_u = mysqli_query($conexao, "SELECT * FROM area WHERE status='1' order by codarea asc");
$contar_2 = mysqli_num_rows($sql_u);
while($ll = mysqli_fetch_assoc($sql_u)){
$PK_nomerota = $ll['PK_nomerota'];
$PK_codarea = $ll['codarea'];
echo'<input type="hidden" name="PK_codarea[]" value="'.$PK_codarea.'">';
echo'<input type="hidden" name="pknm[]" value="'.$PK_nomerota.'">';}

      ?>
      <br>
      <input type="hidden" value="<?=$contar_1?>" name="contar_1">
<input type="hidden" value="<?=$contar_2?>" name="contar_2">
      <input type="submit" value="Enviar" class="btn btn-default" name="enviar">
        </center>
</form>



<?php
}else{
	 echo  '<center><div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Parar alterar é necessário selecionar ao menos um agendamento.">
      </div><a href="lista_agend.php" class="btn btn-default">Voltar</a>
</center><br><br>
      '; 
}
?>

</div>
  <br> <br> <br> <br><br> <br> <br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br>
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