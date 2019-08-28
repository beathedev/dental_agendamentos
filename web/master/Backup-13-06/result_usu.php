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
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">
<center>
<table class="greyGridTable" style="width: 80%;">
<?php
	include_once("../conexao.php");



if(isset($_POST['enviar'])){
	$PK_coduser = $_POST['PK_coduser'];
$niveluser = $_POST['niveluser'];
$username = $_POST['username'];
$senha = $_POST['senha'];
$status = $_POST['status'];
$inativado = 0;
$editar = "UPDATE usuario SET status='$inativado' WHERE PK_coduser='$PK_coduser'";
$result = mysqli_query($conexao, $editar); 
if($result == 1 ){
	echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Usuário Inativo com Sucesso" readonly> 
      </div>';

$descricao = "alterou o seguinte usuario: ".$username." para inativado";


$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");


}else{
	echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um Erro, tente novamente.." readonly>
      </div>'; 
}
}

?>
<?php
if(isset($_POST['enviar2'])){
	$PK_coduser = $_POST['PK_coduser'];
$niveluser = $_POST['niveluser'];
$username = $_POST['username'];
$senha = $_POST['senha'];
$status = $_POST['status'];
$ativado = 1;
$editar = "UPDATE usuario SET status='$ativado' WHERE PK_coduser='$PK_coduser'";
$result = mysqli_query($conexao, $editar); 
if($result == 1 ){
	echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Usuário Ativado com Sucesso" readonly> 
      </div>';



$descricao = "alterou o seguinte usuario: ".$username." para ativo";


$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");




  }else{
	echo "";
}
}

if(isset($_POST['editar'])){

$PK_coduser2 = $_POST['PK_coduser'];
$niveluser2 = $_POST['niveluser'];
$username2 = $_POST['username'];
$senha2 = $_POST['senha'];
$status2 = $_POST['status'];

	echo' <div class="grid-form">
 		<div class="grid-form1">
 		<h3 id="forms-example" class="">Cadastrar Usuário</h3>
<form action="" method="POST">
<input type="hidden" value="'.$PK_coduser2.'" name="PK_coduser">
  <div class="form-group">
    <label for="exampleInputEmail1">Nome do Usuário</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="" value="'.$username2.'">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Senha do Usuário</label>
    <input type="text" name="senha" class="form-control" id="exampleInputPassword1" placeholder="" value="'.$senha2.'">
  </div>
<div class="form-group">
	<div class="col-sm">
<p> Escolha o Nível do Usuario: </p>';
ECHO'<div class="radio block">';

if($niveluser2 == "vendedor"){
echo'
<label><input type="radio" name="niveluser" value="vendedor" checked="checked"> Vendedor</label></div>';
}else{
echo'
<label><input type="radio" name="niveluser" value="vendedor"> Vendedor</label></div>';
}
ECHO'<div class="radio block">';
if($niveluser2 == "supervisor"){
echo'
<label><input type="radio" name="niveluser" value="supervisor" checked="checked"> Supervisor</label></div>';
}else{
echo'
<label><input type="radio" name="niveluser" value="supervisor"> Supervisor</label></div>';
}
ECHO'<div class="radio block">';
if($niveluser2 == "administrador"){
echo'
<label><input type="radio" name="niveluser" value="administrador" checked="checked"> Administrador</label></div>';
}else{
echo'
<label><input type="radio" name="niveluser" value="administrador"> Administrador</label></div>';
}
ECHO'<div class="radio block">';
if($niveluser2 == "entregador"){
echo'
<label><input type="radio" name="niveluser" value="entregador" checked="checked"> Entregador</label></div>';
}else{
echo'
<label><input type="radio" name="niveluser" value="entregador"> Entregador</label></div>';
}
if($niveluser2 == "master"){
echo'
<label><input type="radio" name="niveluser" value="master" checked="checked"> Master</label></div>';
}else{
echo'
<label><input type="radio" name="niveluser" value="master"> Master</label></div>';
}

echo'
<input type="submit" name="salvaredit" value="Salvar" class="btn btn-default">
</form>
</div>
  </div>
  	</div>
  </div>			
</div> <div class="clearfix"> </div>';
}



$dataact = date("d-m-Y");
$horaact = date("H:i:s");
$nomeuser = $_SESSION['username'];

if(isset($_POST['salvaredit'])){




$PK_coduser = $_POST['PK_coduser'];
$niveluser = $_POST['niveluser'];
$username = $_POST['username'];
$senha = $_POST['senha'];

$ativado = 1;

$sel = mysqli_query($conexao, "SELECT * from usuario where PK_coduser='$PK_coduser'");
while($dados = mysqli_fetch_assoc($sel)){
$username_ = $dados['username'];
$niveluser_ = $dados['niveluser'];}

  $descricao = "alterou o seguinte usuário: - Usuário: ".$username_.", - Nivel: ".$niveluser_.", para: - Usuário: ".$username.", - Nivel: ".$niveluser." - Senha: ".$senha."";




$editar = "UPDATE usuario SET niveluser='$niveluser', username='$username', senha='$senha' WHERE PK_coduser='$PK_coduser'";
$result = mysqli_query($conexao, $editar); 
if($result == 1 ){
	echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Usuário editado com sucesso" readonly> 
      </div>';





$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");








}else{
	echo "";
}
}

?>
	   <a href="lista_usu.php" class="btn btn-lg btn-default" style="width:195px;"> Voltar </a>
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
