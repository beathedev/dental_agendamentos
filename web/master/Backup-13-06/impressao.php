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
table.greyGridTable tr{
  border-top: 2px solid #0FA791;
  border-bottom: 2px solid #333333;
}
table.greyGridTable thead th{
  border-top: 2px solid #0FA791;
  border-bottom: 2px solid #0FA791;
  border-right: 2px solid #0FA791;
}
table.greyGridTable tbody td{
  
  border-right: 2px solid #333333;
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

    <script type="text/javascript">
function printDiv() {
    
window.onload = window.print();

}
</script>  

<?php

include_once("../conexao.php");

$codrotageral = $_POST['codrotageral'];
$PK_datarg = $_POST['PK_datarg'];
$entregador_imprimir = $_POST['entregador_imprimir'];

if(isset($_POST['imprimiu']) && $entregador_imprimir == "Todos"){
$select="SELECT * FROM rotageral WHERE PK_datarg='$PK_datarg'";
$query = mysqli_query($conexao, $select);
while($recebe = mysqli_fetch_assoc($query)){
$FK_datarg = $recebe['PK_datarg'];
$codrotageral = $recebe['codrotageral'];
$qtdrotav = $recebe['qtdrotav'];



$select2 = "SELECT * from rotavend where FK_datarg='$FK_datarg' and turno = 'Manhã'";
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
<form method="POST">
<thead>
<tr class="nomerota" >
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




$select="SELECT * FROM rotageral WHERE PK_datarg='$PK_datarg'";
$query = mysqli_query($conexao, $select);
while($recebe = mysqli_fetch_assoc($query)){
$FK_datarg = $recebe['PK_datarg'];
$codrotageral = $recebe['codrotageral'];
$qtdrotav = $recebe['qtdrotav'];



$select2 = "SELECT * from rotavend where FK_datarg='$FK_datarg' and turno = 'Tarde'";
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
<form method="POST">
<thead>
<tr class="nomerota" >
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



$select="SELECT * FROM rotageral WHERE PK_datarg='$PK_datarg'";
$query = mysqli_query($conexao, $select);
while($recebe = mysqli_fetch_assoc($query)){
$FK_datarg = $recebe['PK_datarg'];
$codrotageral = $recebe['codrotageral'];
$qtdrotav = $recebe['qtdrotav'];



$select2 = "SELECT * from rotavend where FK_datarg='$FK_datarg' and turno = 'Horário Comercial'";
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
<form method="POST">
<thead>
<tr class="nomerota" >
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




}//fim do isset


if(isset($_POST['imprimiu']) && $entregador_imprimir != "Todos"){


$select="SELECT * FROM rotageral WHERE PK_datarg='$PK_datarg'";
$query = mysqli_query($conexao, $select);
while($recebe = mysqli_fetch_assoc($query)){
$FK_datarg = $recebe['PK_datarg'];
$codrotageral = $recebe['codrotageral'];
$qtdrotav = $recebe['qtdrotav'];



$select2 = "SELECT * from rotavend where FK_datarg='$FK_datarg' and entregador='$entregador_imprimir' and Turno = 'Manhã'";
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
<form method="POST">
<thead>
<tr class="nomerota" >
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














// 
}// quantidade agend
}// fim do while AGEND 1

}// while agend
}// while rotavend
}// while rotag




$select="SELECT * FROM rotageral WHERE PK_datarg='$PK_datarg'";
$query = mysqli_query($conexao, $select);
while($recebe = mysqli_fetch_assoc($query)){
$FK_datarg = $recebe['PK_datarg'];
$codrotageral = $recebe['codrotageral'];
$qtdrotav = $recebe['qtdrotav'];



$select2 = "SELECT * from rotavend where FK_datarg='$FK_datarg' and entregador='$entregador_imprimir' and turno='Tarde'";
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
<form method="POST">
<thead>
<tr class="nomerota" >
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














// 
}// quantidade agend
}// fim do while AGEND 1

}// while agend
}// while rotavend
}// while rotag




$select="SELECT * FROM rotageral WHERE PK_datarg='$PK_datarg'";
$query = mysqli_query($conexao, $select);
while($recebe = mysqli_fetch_assoc($query)){
$FK_datarg = $recebe['PK_datarg'];
$codrotageral = $recebe['codrotageral'];
$qtdrotav = $recebe['qtdrotav'];



$select2 = "SELECT * from rotavend where FK_datarg='$FK_datarg' and entregador='$entregador_imprimir' and turno='Horário Comercial'";
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
<form method="POST">
<thead>
<tr class="nomerota" >
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














// 
}// quantidade agend
}// fim do while AGEND 1

}// while agend
}// while rotavend
}// while rotag




















}//fim do isset









?>
</table>
</div>
</head>
</html>