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
<title>Dental MV - Vendedor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
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
<?php
include_once('../graficos.php');
?>
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
$temErro = false;
$dataentrega = '';
$bloqueado = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $dataentrega = filter_input(INPUT_POST, 'dataentrega');
}// ... validações, inserts, updates, etc...

if(isset($_POST['enviar'])){
// Ele pega a quantidade de agendamentos na rota vend
$dataentrega = $_POST['dataentrega'];

      
//conta quantidade de rota v:
$sql = "SELECT * from rotavend where FK_datarg = '$dataentrega'";
  $result = mysqli_query($conexao, $sql); // Realiza Query
  $contador=mysqli_num_rows($result);
  $areasr=mysqli_fetch_row($result);


//insere valor do contador na rota:
$sql2 = "UPDATE rotageral SET qtdrotav='{$contador}' WHERE PK_datarg='{$dataentrega}' ";
  $result = mysqli_query($conexao, $sql2);
}

 ?>
<div id="page-wrapper" class="gray-bg dashbard-1">	


<form action="muda_area_3.php" method="POST">
<div class="content-main">

 <center><h3>Selecione uma Data e uma Área:</h3><br>
 <input type="date" name="dataentrega" value="<?=$dataentrega?>" readonly></center>

<div class="content-top">
	<table>
	 <tr>
<?php 
//teste

$area = $_POST['area'];
$explode2 = explode(',', $area);

$arrayzao = $_POST['PK_codrotinha'];
$implode = implode(',', $arrayzao);

$explode = explode(',', $implode);

$PK_codrotinha = $explode[0];
$dataentrega = $explode[1];
$rotinha = "rotinha";
 $codigos = $_POST['codigos_'];

echo ' <center>
<div class="form-inline">
<label for="exampleInputEmail1"><h4><b>Escolha uma Área:</b></label>';
 $count = count($explode2);
for($i = 0; $i < $count; $i++) { 
echo' 
<input type="radio" name="area[]" value="'.$explode2[$i].','.$rotinha.','.$PK_codrotinha.'">'.$explode2[$i].'';
}


echo'<input type="hidden" name="dataentrega" value="'.$dataentrega.'">';
echo'<input type="hidden" name="PK_codrotinha" value="'.$PK_codrotinha.'">';
echo'<input type="hidden" name="codigos" value="'.$codigos.'">';
// echo'<br>PK_codrotav<input type="text" name="PK_codrotav" value="'.$PK_codrotav.'">';

echo'</center></div></h4>';
echo'<br>';






?>

</div><div class="clearfix"> </div>
</div><div class="clearfix"> </div>

<center>
<br>
	<a href="index.php" class="btn-default"> Voltar</a>
    <input type="submit"  name="enviar" class="btn btn-default" value="Criar">	
</center>
</div>
</form>

<div class="content-mid"></div>
</div></div><div class="clearfix"> </div></div>
</div></div><div class="clearfix"> </div></div>
		<div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
	    </div>
		</div>
		<div class="clearfix"> </div>
       </div>
     </div>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<script src="js/bootstrap.min.js"> </script>
</body>
</html>

