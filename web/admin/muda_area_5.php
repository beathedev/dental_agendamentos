
<?php

ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
    header('location: ../login.php');
}
  include_once("../conexao.php");
// esse aq  funciona alterar


?>

<!DOCTYPE HTML>
<html>
<head>
<title>Dental MV</title>

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
  

   table.greyGridTable {
  border: 0px solid #FFFFFF;

  width: 100%;
  text-align: center;
  border-collapse: collapse;

}
    #oi{
        color: black;
    }
table.greyGridTable td, table.greyGridTable th {
  border: 1px solid #FFFFFF;
  padding: 3px 4px;
}
table.greyGridTable tbody{
    border-left: 2px solid #333333;
    border- right: 2px solid #333333;
    border-bottom: 0px solid #333333;

}
table.greyGridTable tbody td {
  font-size: 13px;
  border-bottom: none;
}
table.greyGridTable td:nth-child(even) {
  background: #EBEBEB;
}
table.greyGridTable thead {
  background: #FFFFFF;
  border: 2px solid #333333;
  border-bottom: none; 
}
table.greyGridTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #333333;
  text-align: center;
  
}
table.greyGridTable thead th:first-child {
  border-left: none;
}
table.greyGridTable thead tr.nomerota {
  border-top: 4px solid #0FA791;
  border-bottom: 1px solid #333333;
}

table.greyGridTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #333333;
  border-top: 4px solid #333333;
}
table.greyGridTable tfoot td {
  font-size: 14px;
}


}

</style>         
<div id="wrapper">
<?php
include_once('menu.php');
?>
<?php
$temErro = false;
$dataentrega = '';
$area = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataentrega = filter_input(INPUT_POST, 'dataentrega');
    $area = filter_input(INPUT_POST, 'area');

}
    // ... validações, inserts, updates, etc...
?>
<div id="wrapper">
<?php
include_once('menu.php');
include_once('../graficos.php');

?>
<?php
$temErro = false;
$codigo = '';
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');
 $codigo = filter_input(INPUT_POST, 'codigo');

}



?>



        <div id="page-wrapper" class="gray-bg dashbard-1">
 <div class="content-main"> 


		<div class="content-top">
			      <center>

<table class="greyGridTable" > 



<?php

if(isset($_POST['codigo'])){
$codigo = $_POST['codigo'];

$array = explode(',', $codigo);
}

echo'
<thead>
<tr class="nomerota">
<th colspan="100%">
</th>
</tr>
<thead>
<tr>
<th>Cliente</th>
<th>endereco</th>
<th>bairro</th>
<th>dataentrega</th>
<th>&darr;</th>
</tr>
</thead>';
for ($i=0; $i <count($array) ; $i++) { 




$select = mysqli_query($conexao, "SELECT * from agend where PK_codagend = '$array[$i]'");
while ($dados = mysqli_fetch_array($select)){

	
	   $cliente = $dados['cliente'];
	   $endereco = $dados['endereco'];
	   $dataentrega = $dados['dataentrega'];
	   $bairro = $dados['bairro'];
	   $FK_codrotav = $dados['FK_codrotav'];
	   $PK_codagend = $dados['PK_codagend'];


echo' 
<form method="POST">
<tbody>
<tr>
<input type="HIDDEN" class="form-control" value="'.$codigo.'" name="codigo">

<input type="HIDDEN" class="form-control" value="'.$PK_codagend.'" name="PK_codagend">

<td>'.$cliente.'</td>
<td>'.$endereco.'
<br>
<input type="text" class="form-control" placeholder="Digite o novo endereço" name="novo_endereco">
</td>

<td>'.$bairro.'
<br>
<input type="text" class="form-control" placeholder="Digite o novo bairro" name="novo_bairro"> 
</td>


<td>'.$dataentrega.'</td>

<td><input type="submit" class="btn btn-default" value="Enviar" name="atualiza"></td>
</tr>
</tbody>
</form>';

if(isset($_POST['atualiza'])){


 $PK_codagend = $_POST['PK_codagend'];
 $novo_endereco = $_POST['novo_endereco'];
 $novo_bairro = $_POST['novo_bairro'];
 $codigo = $_POST['codigo'];

$update2 = "UPDATE agend set endereco = '$novo_endereco', bairro='$novo_bairro' where PK_codagend='$PK_codagend'";
$query = mysqli_query($conexao, $update2);


if($query == true){

    echo  ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Alteraçao concluída com sucesso!" readonly> 
      </div>';

	echo'<form action="muda_area_5.php" method="POST" id="my_form"> <input type="hidden" value="'.$codigo.'" name="codigo"> </form>';
	// echo '<script>document.getElementById("my_form").submit();</script>';
ECHO '<script>$(function() {
  setTimeout(function() {
   $("#my_form").submit();
  }, 1200);
});</script>';


}else{


}



}//isset


}

}

?>


</table>

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