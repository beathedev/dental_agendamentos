<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
    header('location: ../index.php');
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<title>Dental MV - Supervisor</title>

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

<!--modal window -->

           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<!--            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
 -->           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  




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
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');

}
    // ... validações, inserts, updates, etc...
?>

<div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
     <center>        
      <div class="table-responsive">
        
    <table class="greyGridTable" >   
    


    <script type="text/javascript">
function printDiv() {
    
window.onload = window.print();

}
</script>  

<?php

include_once("../conexao.php");

if(date('N') > 4 ){
$data = new DateTime(date("Y-m-d"));
$data->modify('+3 day');
$data_rota=$data->format('Y-m-d');
$data_rota_layout=$data->format('d-m-Y');
}elseif(date('N') <= 4 ){
$data = date ("Y-m-d");
$inicio= $data;
$dia_seguinte=1;
$data_termino = new DateTime($inicio);
$data_termino->add(new DateInterval('P'.$dia_seguinte.'D'));
$data_rota=$data_termino->format("Y-m-d");
$data_rota_layout=$data_termino->format('d-m-Y');
// echo $data_rota;
}
$sql_data = mysqli_query($conexao, "SELECT * from datas_bloq WHERE PK_databloq = '$data_rota'");
if(mysqli_num_rows($sql_data) > 0){
while($result_data = mysqli_fetch_assoc($sql_data)){
  $PK_databloq = $result_data['PK_databloq'];
  $datadestino = $result_data['datadestino'];
 $data_rota = $datadestino;
}}

$sql1 = "SELECT * from rotageral WHERE PK_datarg = '$data_rota'";  //puxando rota geral pela data 
$query1 = mysqli_query($conexao, $sql1);
while($linhas1 = mysqli_fetch_array($query1)){
$PK_datarg = $linhas1['PK_datarg'];
$codrotageral = $linhas1['codrotageral'];
}

echo'Data: <input type="date" name="" value="'.$data_rota.'" readonly 
      style="border:none; background-color:#F3F3F4; margin-bottom:20px;"/>';

echo'  <thead>
<tr class="nomerota" >

<form action="impressao.php" method="POST">
<input type="HIDDEN" value="'.$PK_datarg.'" name="PK_datarg"> 
<input type="HIDDEN" value="'.$codrotageral.'" name="codrotageral">
<div style="style="background-color:white;width:40%; height:50%;">
<label>Filtrar
<select name="entregador_imprimir"></label>
<option value="Todos">Todos</option>
';


// e puxa o nome do resto dos entregadores
$entregador = "SELECT * from usuario where niveluser = 'entregador' and status = 1 and username != '$entregador_2'";
$query_entrega = mysqli_query($conexao, $entregador);
while($recebbe = mysqli_fetch_assoc($query_entrega)){
$entregador = $recebbe['username'];
echo '<option value="'.$entregador.'">'.$entregador.'</option>';
}// fim while entregadores.

echo'</select></div>';



      echo'
<input type="submit" class="btn btn-default" name="imprimiu" id="botao" value="Imprimir">
</form>';


$select="SELECT * FROM rotageral WHERE PK_datarg='$data_rota'";
$query = mysqli_query($conexao, $select);
while($recebe = mysqli_fetch_assoc($query)){

$FK_datarg = $recebe['PK_datarg'];
$codrotageral = $recebe['codrotageral'];
$qtdrotav = $recebe['qtdrotav'];



$select2 = "SELECT * from rotavend where FK_datarg='$FK_datarg'";
$query2 = mysqli_query($conexao, $select2);
while($recebe2 = mysqli_fetch_assoc($query2)){
    $PK_codrotav = $recebe2['PK_codrotav'];
    $FK_nomerota = $recebe2['FK_nomerota'];
    $quantidadeagend = $recebe2['quantidadeagend'];
    $bloqueado = $recebe2['bloqueado'];
    $entregador = $recebe2['entregador'];
    $transporte = $recebe2['transporte'];
    $turno = $recebe2['turno'];
    $FK_datarg = $recebe2['FK_datarg'];
    if($quantidadeagend < 1){   }
    elseif($quantidadeagend >= 1){ 

echo'
<form method="POST" action="impressao.php" id="form1">
<thead>
<tr class="nomerota" >
<input type="hidden" name="PK_datarg" value="'.$FK_datarg.'"/>
<input type="hidden" name="PK_codrotava" value="'.$PK_codrotav.'"/>

<input type="hidden" name="PK_codrotava" value="'.$PK_codrotav.'"/>
<th colspan="5">
<h4>'.$FK_nomerota.'</h4>
</th>';


//Transporte
if($transporte == 1){
echo'                                             
<th colspan="2"><h5>Transporte: Carro </h5>';
}else{
echo'                                             
<th colspan="2"><h5>Transporte: Moto </h5>';
}
echo'</th>';

echo'<th colspan="2"><h5> Entregador: '.$entregador.'</h5></th>';


//Turno
echo'                                             
<th colspan="2"><h5>Turno: '.$turno.'</h5></th>
';


//Cabeça da Tabela
echo'
     <th colspan="100%">
            <tr>
            <th>VL</th>
            <th>Cliente</th>
            <th>OBS/PGT</th>
            <th>Endereço</th>
            <th>Bairro</th>
            <th>QTD</th>
            <th>Pedidos</th>
            <th>Valor</th>
            <th>Vendedor</th>
            <th>CF</th>
            <th>PED</th>
            </tr>
            </thead>

';




 $select3 = "SELECT * from agend WHERE FK_codrotav = '$PK_codrotav' ORDER BY cliente DESC";  //puxando agendamentos dessas rotas de vendedores
        $query3 = mysqli_query($conexao, $select3);
        $cont3 = mysqli_num_rows($query3);
        while($recebe3 = mysqli_fetch_array($query3)){
            $PK_codagend = $recebe3['PK_codagend'];
         $FK_coduser = $recebe3['FK_coduser'];
            $obs = $recebe3['obs'];
            $status = $recebe3['status'];
            $dataabertura = $recebe3['dataabertura'];
           $dataentrega = $recebe3['dataentrega'];
            $volume = $recebe3['volume'];
            $cliente = $recebe3['cliente'];
            $endereco = $recebe3['endereco'];
            $bairro = $recebe3['bairro'];
            $quantidade = $recebe3['quantidade'];
            $cf = $recebe3['cf'];

 

// Select Ped
            $sqlp1 = "SELECT * from ped WHERE FK_codagend = '$PK_codagend'";
            $queryp1 = mysqli_query($conexao, $sqlp1);


//Select nome do vendedor
            $sqlp3 = "SELECT * from usuario WHERE PK_coduser = '$FK_coduser'";
            $queryp3 = mysqli_query($conexao, $sqlp3);
            while($recebb = mysqli_fetch_assoc($queryp3)){
              $nome_vendedor = $recebb['username'];
            

            echo' 
            </th>
            <tbody>
            <tr class="mudae">';
  if($volume == 0){ echo '<td>N/</td>'; }
else{ echo '<td class="preto" style="background-color:black;width:1px;"></td>'; }
            echo'
            <td>'.$cliente.'</td>
            <td>'.$obs.'</td>
            <td>'.$endereco.'</td>
            <td>'.$bairro.'</td>
            <td>'.$quantidade.'</td>
            ';





echo'<td>';
                
                    while ($linhasp1 = mysqli_fetch_array($queryp1)){
                            echo $linhasp1['pedidos'];
                            echo"; ";}

                    $sqlp2 = "SELECT valor FROM ped WHERE FK_codagend = '$PK_codagend'";
                    $queryp2 = mysqli_query($conexao, $sqlp2);
                    echo'</td> <td>';
                    while ($linhasp2 = mysqli_fetch_assoc($queryp2)){
                            echo $linhasp2['valor'];
                            echo "; ";
                        }//}


echo'
</td>
<td>'.$nome_vendedor.'</td>
';
echo'<td>'.$cf.'</td>';

echo'<td>';
echo'<style>.amarelo{background-color:yellow; width:100%;}</style>';
$contae = mysqli_num_rows($queryp1);
                            if ($contae < 1){
                                echo '<section class="amarelo"> Caixao </p>';
                            }else{
                                echo $contae;
                            }
echo'</td></form>';


//// isso aq tem a ver com repetente:

}// quantidade agend
}// fim do while AGEND 1

}// while agend
}// while rotavend
}// while rotag




// 










?>
</table>


<script type="text/javascript">
   function enviar(){
  form=document.getElementById('form1');
        form.action='impressao.php';
        form.target='';
        form.submit();
}

</script>
</div>
</head>
</html>