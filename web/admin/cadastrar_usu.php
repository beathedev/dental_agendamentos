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
<title>Dental MV - Admin</title>
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
?>
<?php
$temErro = false;
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');

}
    // ... validações, inserts, updates, etc...
?>


        <div id="page-wrapper" class="gray-bg dashbard-1">

       <form action="" method="POST">
         <div class="content-main">
 		
  		<!--banner-->	
		<!--//banner-->
		<!--content-->
		<div class="content-top">
			
		
 	<div class="grid-form">
 		<div class="grid-form1">
 		<h3 id="forms-example" class="">Cadastrar Usuário</h3>

  <div class="form-group">
    <label for="exampleInputEmail1">Nome do Usuário</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Senha do Usuário</label>
    <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="">
  </div>
<div class="form-group">
	<div class="col-sm">
<p> Escolha o Nível do Usuario: </p>
<div class="radio block">
<label><input type="radio" name="nivel" value="vendedor"> Vendedor</label></div>
<div class="radio block">
<label><input type="radio" name="nivel" value="supervisor"> Supervisor</label></div>
<div class="radio block">
<label><input type="radio" name="nivel" value="administrador"> Administrador</label></div>
<label><input type="radio" name="nivel" value="entregador"> Entregador</label></div>

</div>
  </div>
  	</div>
  </div>

				
</div>
		

			 <div class="clearfix"> </div>
			


	


		



<div class="clearfix"> </div>

<center>
<br>
      <input type="submit"  name="cadastrar" class="btn btn-default" value="Cadastrar">
      <a href="cadastros.php" class="btn btn-default"> Voltar </a>
      </form><br>

    <br>
   <?php

if(isset($_POST['cadastrar'])){
$username =	$_POST['username'];
$senha = 	$_POST['senha'];
$nivel =	$_POST['nivel'];
if (!isset($_POST['username']) || empty($_POST['senha']) || empty($_POST['nivel'])){

echo '      <div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Por Favor, preencha todos os campos!">
      </div>';
 unset ($_POST['username']);
 unset ($_POST['senha']);
 unset ($_POST['nivel']);

}
else{

$verifica = "SELECT * FROM usuario where (username = '$username')";

$verifica_resultado = mysqli_query($conexao, $verifica);

if (mysqli_num_rows($verifica_resultado) > 0) {
 
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Esse Nome de Usuário Já Foi Cadastrado.">
      </div>';

} else {



$sql_inserir = "INSERT into usuario(niveluser, username, senha, status) VALUES ('$nivel','$username','$senha', 1)";
$resultado = mysqli_query($conexao, $sql_inserir);
if($resultado > 0 ){

echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Usuário Cadastrado com Sucesso!" readonly> 
      </div>';


$dataact = date("d-m-Y");
$horaact = date("H:i:s");
$nomeuser = $_SESSION['username'];


$descricao = "inseriu um novo usuário: - Nome: ".$username." - Cargo: ".$nivel." - Senha: ".$senha."";



$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");
// termina aqui



}else{
echo '       <div class="form-group has-error">
        <input type="text" class="form-control1"  style="width:500px; text-align:center;" id="inputError1" value="Cadastro Não Concluido, Tente Novamente.">
      </div>';






}
}
}
}

?>	
	

 <br>
</center>
</div>

</form>
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

