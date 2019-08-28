<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
	header('location: ../index.php');
}
  include_once("../conexao.php");
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Dental MV - Vendedor</title>
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

<!----->

<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->
</head>
<body>
<?php
		$dataabertura=$_POST['dataabertura'];
		$dataentrega=$_POST['dataentrega'];
		$nomecli=$_POST['nomecli'];

		if(isset($_POST['addboxao'])){
			//CODIGO INSERT;
		}
?>

	<form method="POST" action="">
		<input type="text" name="dataabertura" value="<?php echo $dataabertura; ?>"/>
		<input type="text" name="dataentrega" value="<?php echo $dataentrega; ?>"/>
		<input type="text" name="nomecli" value="<?php echo $nomecli; ?>"/>
    <div class="form-group">
    <label for="exampleInputEmail1">Quantidade de Pedidos</label>
   <input type="number" class="form-control" id="exampleInputEmail1" name="qtdped" placeholder="Insira a quantidade de pedidos.."> 
   <input type="submit"  name="enviar2" class="btn btn-default" value="Criar"/>
    </div></form>
<?php
      if(isset($_POST['enviar2'])){

        $qtdped = $_POST['qtdped'];
        $i=0;
        while ($i<=($qtdped-1)){
          echo'
          <form method="POST">
          <div class="form-group">
              <label for="exampleInputEmail1">Insira o Numero do Pedido</label>
              <input type="number" class="form-control" id="exampleInputEmail1" name="nped" placeholder="numero do pedido">
              </div>';
          $i = $i + 1;
        }
        $dataabertura=$_POST['dataabertura'];
		$dataentrega=$_POST['dataentrega'];
		$nomecli=$_POST['nomecli'];
		$qtdped=$_POST['qtdped'];
		$nped=$_POST['nped'];
        echo '	<form method="POST" action="">
		<input type="text" name="dataabertura" value="'.$dataabertura.'"/>
		<input type="text" name="dataentrega" value="'.$dataentrega.'"/>
		<input type="text" name="nomecli" value="'.$nomecli.'"/>
		<input type="text" name="nped" value="'.$qtdped.'"/>
    <div class="form-group">
   <input type="submit"  name="enviar3" class="btn btn-default" value="Cadastrar"/>
    </div></form>';
}if(isset($_POST['enviar3'])){
$nped = $_POST['nped'];
echo $nped;
      }
      elseif(isset($_POST['submitao'])){
      	header('finalped.php');
      }
    ?>

  

<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="js/bootstrap.min.js"> </script>

</body>
</html>

