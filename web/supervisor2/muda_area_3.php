<?php
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

?>
<?php
$temErro = false;
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');

}
?>



        <div id="page-wrapper" class="gray-bg dashbard-1">

<?php

if(isset($_POST['enviar'])){
$data_rota = $_POST['dataentrega'];// data


/// areas, pk cod rotav
$nomerota = $_POST['area'];
$nomes = implode(',', $nomerota);
$explode = explode(',', $nomes);

$area = $explode[0];
$PK_codrotav = $explode[1];


$codigos = $_POST['codigos']; // codigo agenda
$explode2 = explode(',', $codigos);//codigos agenda
?>



       <form  method="POST" readonly>
         <div class="content-main"> 


		<div class="content-top">
			      <center>
  	<h3>Informaçoes:</h3><br>
<input type="hidden" name="" value="<?=$data_rota?>">
<input type="hidden" name="" value="<?=$area?>">
<input type="hidden" name="" value="<?=$PK_codrotav?>">
<?php

for($i = 0 ; $i < count($explode2) ; $i ++){

$select = mysqli_query($conexao,"SELECT * from agend where PK_codagend = '$explode2[$i]'");
while ($rotaantiga = mysqli_fetch_assoc($select)) {
$PK_codrotav_old = $rotaantiga['FK_codrotav'];//codigo antigo

//passa agends pra rota nova 
$update2 = mysqli_query($conexao, "UPDATE agend set FK_codrotav ='$PK_codrotav', dataentrega='$data_rota' where PK_codagend='$explode2[$i]'"); 


//conta a qntd de agendamento na rota velha
$select3 = mysqli_query($conexao, "SELECT * from agend where FK_codrotav='$PK_codrotav_old'");
$contar_velhos = mysqli_num_rows($select3);//conta agends na rota velhas


//update na qntd velha
$update = mysqli_query($conexao,"UPDATE rotavend set quantidadeagend='$contar_velhos' where PK_codrotav = '$PK_codrotav_old'");

//conta agends na rota nova
$select2 = mysqli_query($conexao,"SELECT * from agend where FK_codrotav = '$PK_codrotav'");
$contar_novas = mysqli_num_rows($select2);

//update na quantidade da rota nova
$update3 = mysqli_query($conexao,"UPDATE rotavend set quantidadeagend='$contar_novas' where PK_codrotav='$PK_codrotav'");
if($update3 == true){
    echo  ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Alteraçao concluída com sucesso!" readonly> 
      </div>';
    header('Refresh: 1; url=lista_agend.php');
}else{
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um Erro, tente novamente.." readonly>
      </div>'; 
}


}//while
}//for
}//isset
?>
    </center>



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