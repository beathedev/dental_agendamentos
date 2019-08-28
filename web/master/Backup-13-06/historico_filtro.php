<?php
ob_start();
session_start();
?>
<!DOCTYPE HTML>
<html lang="pt-br">
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
  border-right: 2px solid #FFFFFF;
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
    border-right: 2px solid #333333;
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



@media print{
.content-main{
  overflow: hidden; 
}

.preto{
  background-color: black;
}
#botao{
  display: none;
}

@page {size: landscape}
}

</style>


</style>    
        <div class="content-main" >
    <table class="greyGridTable" >  
<input type="submit"  id="botao" onclick="printDiv()" value="Imprimir" />
<A HREF="historico.php" class="btn btn-default">Voltar</A>
    <script type="text/javascript">
function printDiv() {
    
window.onload = window.print();

}
</script>  

<?php

include_once("../conexao.php");

?>


<br><br>
<thead>
<tr>
<th>Data e Hora</th>
<th>Usuário</th>
<th>Descriçao</th>
</tr>
</thead>
<tbody>
 <?php $usuario_nome = $_POST['usuario_nome'];

$sql = "SELECT * from historico  where usuario = '$usuario_nome'";
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


</table>
</div>
</head>
</html>