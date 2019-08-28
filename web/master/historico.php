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
    input[type=date]::-webkit-inner-spin-button { 
    -webkit-appearance: none;
    cursor:pointer;
    display:block;
    width:8px;
    color: #333;
    text-align:center;
    position:relative;
}

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
input[type="text"]{
  width: 150px;
  height: 20px;
  text-align: center;
  padding: 0px;
  /*border: none;*/
}
input[type="text"].cnomerota{
  width: 250px;
  height: 30px;
  
}
input[type="text"].cf{
  width: 60px;
  height: 20px;
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


        <div id="page-wrapper" class="gray-bg dashbard-1">

         <div class="content-main">
<center>
<br>
<h2>Histórico</h2>

<div class="table-responsive">
<a href="index.php" class="btn btn-default" style="width:195px;"> Voltar </a><br><br> 
    <table class="greyGridTable" > 


<form method="POST" id="form1"  style="background-color:white;border-top:4px #0E9A81 solid;">
</form>
<br><br>
<thead>
<tr>
<th>Data e Hora</th>
<th>Usuário</th>
<th>Descriçao</th>
</tr>
</thead>
<tbody>
 <?php

echo '
<form action="historico_filtro.php" method="POST">
<label>Filtrar (por usuário)</label>


<select name="usuario_nome">';
$sql2 = "SELECT * from usuario  ORDER BY PK_coduser DESC";
$query2 = mysqli_query($conexao, $sql2);
while($linhas2 = mysqli_fetch_assoc($query2)){
$nome = $linhas2['username']; 
$codigo = $linhas2['PK_coduser']; 
echo '<option value="'.$nome.'">'.$nome.'</option>';
}
echo'
<br>
<input type="submit" class="btn btn-default" name="envio">
</select>
</form>
<br>
<br><br>
<br>';

$sql = "SELECT * from historico  ORDER BY PK_codact DESC";
$query = mysqli_query($conexao, $sql);

while($linhas = mysqli_fetch_assoc($query)){
$descricao = $linhas['descricao'];
$data = $linhas['dataact'];
$hora = $linhas['horaact'];
$usuario = $linhas['usuario'];


$data_nova = new DateTime($data);

$data__oficial = $data_nova->format('d/m/Y');

echo'<tr >
<td  style="border-bottom:1px solid black;">'.$data__oficial.' - <br>'.$hora.'</td>
<td  style="border-bottom:1px solid black;">'.$usuario.'</td>';

echo '<td style="border-bottom:1px solid black;">'.$descricao.'</td>';
echo'

</tr>
';
}//while









?>
</div>

</tbody>
</table>

</div>
  <br> <br> <br> <br><br> <br> <br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br>  <br> <br> <br> <br><br> <br> <br> <br><br> <br>
 <br>
  <div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
      </div>
    </div>
    <div class="clearfix"> </div>
       </div>
     </div> </div>
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