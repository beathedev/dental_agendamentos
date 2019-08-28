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
?>


        <div id="page-wrapper" class="gray-bg dashbard-1">

         <div class="content-main">
         	<div class="table-responsive">

<center>
           <a href="cadastros.php" class="btn btn-default" style="width:195px;"> Voltar </a><br><br>
<table class="greyGridTable" >
<thead>
<tr>
<th>Código Usuário</th>
<th>Nível do Usuário</th>
<th>Usuário</th>
<th>Senha</th>
<th colspan="2">Status</th>

</tr>
</thead>

<tbody>
 <?php
 exibir_dados();

function exibir_dados(){
$conexao = mysqli_connect("localhost", "root", "", "projeto2test");
$sql = "SELECT * from usuario ORDER BY PK_coduser DESC";
$query = mysqli_query($conexao, $sql);
while($linhas = mysqli_fetch_assoc($query)){
$PK_coduser = $linhas['PK_coduser'];
$niveluser = $linhas['niveluser'];
$username = $linhas['username'];
$senha = $linhas['senha'];
$status = $linhas['status'];
echo '    <form method="POST" action="result_usu.php">
<tr>
<td><input type="text" name="PK_coduser" value="'.$PK_coduser.'" readonly="readonly"></td>
<td><input type="text" name="niveluser" value="'.$niveluser.'" readonly="readonly"></td>
<td><input type="text" name="username" value="'.$username.'" readonly="readonly"></td>
<td><input type="text" name="senha" value="'.$senha.'"   readonly="readonly"></td>
<td>';

if($status == 1){
echo '<input type="text" name="status" value="Ativo" readonly="readonly">';
}  
else{
echo '<input type="text" name="status" value="Inativo" readonly="readonly">';
}
echo'</td><td>';

if($status == 1){
echo '
<input type="submit" name="enviar" class="btn btn-sm btn-default" style="margin-top:9px;" value="Inativar">
<input type="submit" name="editar" value="Editar" style="margin-top:9px;" class="btn btn-sm btn-default" readonly="readonly">';
}  
else{
echo '
<input type="submit" name="enviar2" class="btn btn-sm btn-default" style="margin-top:9px;" value="Ativar">';
}

echo '</td></form>';

echo'</tr>';
}
}
 ?>




</tbody>

</table>
</center>
</div>
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

