<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
  header('location: ../index.php');
}

ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

  include_once("../conexao.php");
$PK_codagend ='';
$FK_coduser= '';
$FK_codrotav = '';
$obs ='';
$status ='';
$dataabertura ='';
$dataentrega = '';
#$turno = $_POST['turno'];
$volume = '';
$cliente = '';
$endereco = '';
$area = '';
$bairro ='';
$pedido_a = '';
$PK_codagend2 ='';
$ped ='';
$val = '';
$PK_codped2 = '';
$alterar = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $PK_codagend = filter_input(INPUT_POST, 'PK_codagend');
    $FK_coduser = filter_input(INPUT_POST, 'FK_coduser');
    $FK_codrotav = filter_input(INPUT_POST, 'FK_codrotav');
    $obs = filter_input(INPUT_POST, 'obs');
    $status = filter_input(INPUT_POST, 'status');
    $dataabertura = filter_input(INPUT_POST, 'dataabertura');
    $dataentrega = filter_input(INPUT_POST, 'dataentrega');
    $volume = filter_input(INPUT_POST, 'volume');
    $cliente = filter_input(INPUT_POST, 'cliente');
    $endereco = filter_input(INPUT_POST, 'endereco');
    $area = filter_input(INPUT_POST, 'area');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $pedido_a = filter_input(INPUT_POST, 'pedido_a');
    $PK_codagend2 = filter_input(INPUT_POST, 'PK_codagend2');
    $ped = filter_input(INPUT_POST, 'ped');
    $val = filter_input(INPUT_POST, 'val');
    $PK_codped2 = filter_input(INPUT_POST, 'PK_codped2');
    $cliente_old = filter_input(INPUT_POST, 'cliente_old');
    $endereco_old = filter_input(INPUT_POST, 'endereco_old');
    $bairro_old = filter_input(INPUT_POST, 'bairro_old');
    $dataentrega_old = filter_input(INPUT_POST, 'dataentrega_old');
    $volume_old = filter_input(INPUT_POST, 'volume_old');
    $status_old = filter_input(INPUT_POST, 'status_old');
    $alterar = filter_input(INPUT_POST, 'alterar');
  }

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Dental MV - Admin</title>
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


<script src="js/skycons.js"></script>
<!--//skycons-icons-->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
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


        <div id="page-wrapper" class="gray-bg dashbard-1">    

       <div class="content-main">
 <center><h3>Formulário de Edição</h3><br></center>
    <div class="content-top">
      <center>
      <div class="grid-form">
    <div class="grid-form1">


    
      <?php 



echo '<h3 id="forms-example" class="">Preencha os campos abaixo:</h3>';



 $alterar = $_GET['alterar'];


$alterar2 = explode(',', $alterar);

$conta = count($alterar2);


// if(isset($_POST['alterar'])){
// if($conta != 1){
//  echo  '<div class="form-group has-error">
//         <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Só se pode editar um agendamento por vez." readonly>
//       </div>';


// }else{ // }



$string = implode(',', $alterar2);




 $array = explode(',', $string);
  $PK_codagend =  $array[0];
 $cliente_old =  $array[1];
 $endereco_old = $array[2];
 $bairro_old =  $array[3];
 $obs_old =  $array[4];
 $dataentrega_old =  $array[5];
 $status_old =  $array[6];
 $volume_old =  $array[7];
// echo 
// '<form method="POST" id="form_envia">
// <input type="text" name="cliente_old" value="'.$cliente_old.'">
// <input type="text" name="endereco_old" value="'.$endereco_old.'">
// <input type="text" name="bairro_old" value="'.$bairro_old.'">
// <input type="text" name="obs_old" value="'.$obs_old.'">
// <input type="text" name="dataentrega_old" value="'.$dataentrega_old.'">
// <input type="text" name="status_old" value="'.$status_old.'">
// <input type="text" name="volume_old" value="'.$volume_old.'">
// </form>';


$selectt = mysqli_query($conexao, "SELECT * from agend where PK_codagend='$PK_codagend'");
while($dados = mysqli_fetch_assoc($selectt)){


$FK_coduser= $dados['coduser'];
$FK_codrotav = $dados['FK_codrotav'];
$obs = $dados['obs'];
$status = $dados['status'];
$dataabertura = $dados['dataabertura'];
$dataentrega = $dados['dataentrega'];
#$turno = $_POST['turno'];
$volume = $dados['volume'];
$cliente = $dados['cliente'];
$endereco = $dados['endereco'];
$area = $dados['area'];
$bairro = $dados['bairro'];




$select_b2 = mysqli_query($conexao, "SELECT * from usuario where PK_coduser = '$FK_coduser'");
while($data1 = mysqli_fetch_assoc($select_b2)){
$vendedor = $data1['username'];
}

$nomeuser = $_SESSION['username'];

if($status == 1){
$status = "Possui Pedido";
}else{
$status = "Caixão";
}


if($volume == 1){
$volume = "Possui Volume";
}else{
$volume = "N/";
}




$selectt2 = mysqli_query($conexao, "SELECT * from rotavend where PK_codrotav='$FK_codrotav'");
while($dados2 = mysqli_fetch_assoc($selectt2)){
$area = $dados2['FK_nomerota'];
}//while
}//while



 ?>

<form action="" method="POST" role="form" autocomplete="off">
<!-- INLINE DATAS -->
 <div class="form-inline">
        <input type="hidden" style="width:130px,font-size:12px;" class="form-control" id="exampleInputEmail1" name="PK_codagend" placeholder="Área" value="<?=$PK_codagend?>" readonly/>
       <label for="exampleInputEmail1">Area</label>
    <input type="text" style="width:130px,font-size:12px;" class="form-control" id="exampleInputEmail1" name="area" placeholder="Área" value="<?=$area?>" readonly/>
    <input type="hidden" name="FK_codrotav" value="<?=$FK_codrotav?>">
    <label for="exampleInputEmail1">Abertura</label> 
    <input type="date" class="form-control" id="exampleInputEmail1" name="dataabertura" style="width:132px;font-size:12px;" value="<?=$dataabertura?>" READONLY>
    <label for="exampleInputEmail1">Entrega</label>
<input type="date" style="width:132px;font-size:12px;" class="form-control" id="exampleInputEmail1"name="dataentrega" value="<?=$dataentrega?>"  READONLY>
</div>
<!-- F INLINE DATAS -->

<BR>
<div class="form-group">
<!-- Nome do cliente -->
 <label for="exampleInputEmail1">Nome do Cliente</label> <input type="text" class="form-control" id="exampleInputName" name="cliente" placeholder="Insira o nome" value="<?=$cliente?>" >
 <BR>

 <label> Selecione o Vendedor
 <select name="FK_coduser">
<br>  <!-- F Nome do cliente -->
<?php

$entregador_ = "SELECT * from agend where  PK_codagend = '$PK_codagend'";
$query_entregador_ = mysqli_query($conexao, $entregador_);
//Procura se existe nome de vendedor na rota:
while($recebe_entreg = mysqli_fetch_assoc($query_entregador_)){
$PK_coduser = $recebe_entreg['FK_coduser'];

$entregadorR = "SELECT * from usuario where PK_coduser='$PK_coduser'";
$query_entregaR = mysqli_query($conexao, $entregadorR);
while($recebbeA = mysqli_fetch_assoc($query_entregaR)){
$entregador_2 = $recebbeA['username'];
}

echo $entregador_2;}

// se tiver vazio aparece a opçao de escolher o entregador:
if($PK_coduser  == null ){

echo'<option id="some_op">Escolher Entregador</option>';

// se nao aparece o nome do entregador já preenchido:
}else{
echo'<option value="'.$PK_coduser.'">'.$entregador_2.'</option>';
}

// e puxa o nome do resto dos entregadores
$entregador = "SELECT * from usuario where niveluser = 'vendedor' and status = 1 and username != '$entregador_2'";
$query_entrega = mysqli_query($conexao, $entregador);
while($recebbe = mysqli_fetch_assoc($query_entrega)){
$entregador = $recebbe['username'];
$PK_coduser = $recebbe['PK_coduser'];

echo '<option value="'.$PK_coduser.'">'.$entregador.'</option>';
}// fim while entregadores.

echo'</th></select></h5>';



?>

</label>
</div>
    <!-- OBS -->
    <div class="form-inline">
    <label for="exampleInputEmail1">Observação</label>
    <br>
<div id="text_area">
<TEXTAREA name="obs"><?php echo $obs ?></TEXTAREA> 
</div>

  <label>Horário de Almoço
<div id="text_area2">
<TEXTAREA name="almoco" style="width:120px"><?php echo $almoco ?></TEXTAREA>
</div>
</label>
</div>
 <!-- F das OBS -->
<br> 
<!-- Endereço e Bairro INLINE -->
    <div class="form-inline">
    <div class="form-group">
  <label for="exampleInputEmail1">Endereço</label>
  <input type="text" class="form-control"  style="width: 350px;" id="exampleInputEmail1" name="endereco" placeholder="Endereço" value="<?=$endereco?>" >
    <label for="exampleInputEmail1">Bairro</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="bairro" placeholder="Bairro" value="<?=$bairro?>">
</div>
  <!-- F ENDEREÇO E BAIRRO INLINE -->
<br>
<script>
    $(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
        $(this).parents('.entry:first').remove();

        e.preventDefault();
        return false;
    });
});

</script>
    <style>
    .entry:not(:first-of-type)
    {
        margin-top: 3px;
        margin-right: 3px;
        margin-right: 3px; 

    }

    .glyphicon
    {
        font-size: 10px;
    }


</style>
<?php


$sql_consulta = "SELECT * from ped where FK_codagend = '$PK_codagend'";
$query = mysqli_query($conexao, $sql_consulta);
$rowcount=mysqli_num_rows($query);
if($rowcount > 0){

while($linhas = mysqli_fetch_assoc($query)){
 $PK_codped = $linhas['PK_codped'];
$FK_codagend = $linhas['FK_codagend'];
$pedidos = $linhas['pedidos'];
$valor = $linhas['valor'];
//tabela ped
echo'
<br>
 <div class="form-inline">
 <input type="radio" name="pedido_apag[]" value="'.$PK_codped.'*'.$pedidos.'*'.$valor.'*'.$FK_codagend.'">
    <input type="hidden" style="width:10px,font-size:12px;" class="form-control" id="some" name="PK_codagend2[]" placeholder="" value="'.$FK_codagend.'" />
    <input type="hidden" style="width:10px,font-size:12px;" class="form-control" id="some" name="PK_codped2[]" placeholder="" value="'.$PK_codped.'" />
    <label for="exampleInputEmail1"> Nº Pedido</label> 
<input type="text" class="form-control" id="some" name="pedido_var[]" style="width:132px;font-size:12px;" value="'.$pedidos.'" >
    <label for="exampleInputEmail1">Valor</label>
<input type="text" style="width:132px;font-size:12px;" class="form-control" id="some" name="valor_var[]" value="'.$valor.'" ></div>
<br>
';
}// fim do while de pedidos
  echo'<br><input type="submit" name="apagar" class="btn btn-default" id="some" value="Apagar"><br><br>';

}
if(isset($_POST['apagar'])){
$pedido_a = $_POST['pedido_apag'];
// if(empty($pedido_a)){
//   echo  '<div class="form-group has-error">
//         <input type="text"  style="width:500px;" class="form-control1" id="inputError1" 
//           value="Para apagar, é preciso selecionar um pedido">
//       </div>'; 
// }  
   //pega checkbox
$pedsapaga = implode('*', $_POST['pedido_apag']);

$explode = explode('*', $pedsapaga);
$PK_codped2 = $explode[0];
$ped = $explode[1];
$val = $explode[2];
$PK_codagend2 = $explode[3];



   #echo $item

   //implode
   #echo $item

$select = "SELECT * from ped where FK_codagend='$PK_codagend2'";
$queryselect = mysqli_query($conexao, $select);
$conta_linha = mysqli_num_rows($queryselect);
$tamanho = count($pedido_a);

//compara o tamanho de qntd de pedidos com a do formulario

if($tamanho == 0){// se for igual, nao pode excluir

echo  '<div class="form-group has-error">
        <input type="text"  style="width:500px;" class="form-control1" id="inputError1" value="Selecione algum pedido." readonly>
      </div>'; 
}elseif($conta_linha == $tamanho) {
echo  '<div class="form-group has-error">
        <input type="text"  style="width:500px;" class="form-control1" id="inputError1" value="Não é Possivel Apagar Todos os Pedidos, Para isso, Exclua o Agendamento" readonly>
      </div>'; 
}else{// se nao for, a exclusao ocorre normalmente


///deleta os pedidos de acordo com o cod agendamento
  $deleta = "DELETE FROM  ped  where PK_codped='$PK_codped2'";
  $qqnome2 = mysqli_query($conexao, $deleta);
  
// se der certo
if($qqnome2 == true){
    echo  ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Pedido Excluído com Sucesso!." readonly> 
      </div>';
$dataact = date("d-m-Y");
$horaact = date("H:i:s");
$data2 = new DateTime($FK_datarg);
$data_ = $data2->format("d-m-Y");
$nomeuser = $_SESSION['username'];

$descricao =" deletou o seguinte pedido: - Pedido: ".$ped." - Valor: ".$val." - Cliente: ".$cliente." - Vendedor: ".$vendedor." - Endereço: ".$endereco;


$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");
// termina aqui



header('Refresh:2; url= edit_agend_admin.php?alterar='.$PK_codagend);


  }
// se n der certo
else{
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um Erro Durante a Exclusão dos Pedidos, tente novamente.." readonly>
      </div>'; 
header('Refresh: 2; url=lista_agend.php');

       }
}

}
?>

<br><br>
<input type="hidden" name="status" value="<?=$status?>">
   <div class="form-inline">
  <div class="row">
        <div class="control-group" id="fields">
            <label for="exampleInputEmail1">Pedidos</label>
          <div class="controls"> 
                    <div class="entry input-group col-xs-3">
                        <input class="form-control" name="ped[]" type="number"  placeholder="Código do pedido" />
                        <input class="form-control" name="valorped[]" type="number" placeholder="Valor" 
                        step="0.01"/>
                        <br>
                        <br>
                        <br>
                        <br>
                <button class="btn btn-success btn-add" style="" type="button" value="">
                                <span class="glyphicon glyphicon-plus" ></span> Adicionar pedidos
                            </button>
                    </div>                        



          
            <br>
           <!-- <small>Aperte <span class="glyphicon glyphicon-plus gs"></span> para adicionar mais um pedido</small>
-->

</div>
</div>
</div>
</div> 
<?php
//campo volume
if($volume == 0){
echo '<p><input type="hidden" value="0" name="volume">Sem Volume</p>
<br>
<label>
Clique aqui para tornar volume:
<input type="checkbox" value="1" name="volume">
</label>
</td>';
}  
else{
echo'<p><input type="hidden" value="1" name="volume">Possui Volume</p>
<br>
<label>
Clique aqui para remover volume:
<input type="checkbox" value="0" name="volume">
</label>
</td>';
}

?>
<br>
  <input type="submit" class="btn btn-default" name="atualiza" class="btn btn-default" value="Confirmar Edição" onclick="enviar2();"/>
  <?php echo'<input type="button" name="view"  id="'.$PK_codagend.'"  class="btn btn-default view_data" value="Apagar Agendamento"/>';?>

 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Deseja mesmo apagar esse agendamento?</h4>  

                </div>  

                <div class="modal-body" id="employee_detail">  

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  

                </div>  
           </div>  
      </div>  
 </div>

</div>
<br><br>
<?php

//Apaga Agendamento
if(isset($_POST['apaga_agend'])){
$PK_codagend = $_POST['PK_codagend'];
$FK_coduser= $_POST['FK_coduser'];
$FK_codrotav = $_POST['FK_codrotav'];
$obs = $_POST['obs'];
$status = $_POST['status'];
$dataabertura = $_POST['dataabertura'];
$dataentrega = $_POST['dataentrega'];
$volume = $_POST['volume'];
$cliente = $_POST['cliente'];
$endereco = $_POST['endereco'];
$area = $_POST['area'];
$bairro = $_POST['bairro'];
$valor = $_POST['valorped'];



$dataact = date("d-m-Y");
$horaact = date("H:i:s");

//PEDIDO
$pedsapaga = implode('*', $_POST['pedido_apag']);
$explode = explode('*', $pedsapaga);
$PK_codped2 = $explode[0];
$ped = $explode[1];


//data formataçoes #1
$data2 = new DateTime($dataentrega);
$data_ = $data2->format("d-m-Y");

// echo $data_rota2;
// echo $data_;
$nomeuser = $_SESSION['username'];
/* 
ped n ta exibindo
*/
$descricao = " apagou o seguinte agendamento: Nome do cliente: ".$cliente." - Data de entrega: ".$data_. " - Endereço: ".$endereco." - Pedido: ".$ped;




$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");







//Pega o cod do agend
$select_agend = "SELECT * from agend where PK_codagend='$PK_codagend'";
$queryagend =  mysqli_query($conexao, $select_agend);
while ($linhaz = mysqli_fetch_assoc($queryagend)) {
$FK_codagend = $linhaz['PK_codagend'];
$PK_codrotav=$linhaz['FK_codrotav'];
$FK_codrotinha=$linhaz['FK_codrotinha'];
}

//deleta o ped de acordo com o agendamento
$deleta_ped = "DELETE FROM  ped  where FK_codagend='$FK_codagend'";
$query_ped = mysqli_query($conexao, $deleta_ped);


//dleta do agendamento de acordo com o cod do agendamento
$deleta_agend = "DELETE FROM  agend  where PK_codagend='$FK_codagend'";
$query_agend = mysqli_query($conexao, $deleta_agend);
if($query_agend == true)
{
    echo  ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Agendamento Apagado com Sucesso!" readonly> 
      </div>';




header('Refresh: 2; url=lista_agend.php');

}else{
    echo  '<div class="form-group has-error">
        <input type="text"  style="width:500px;height:200px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante a Exclusão do Aagendamento, Tente Novamente.." readonly> 
      </div>';

}

$selectt =mysqli_query($conexao, "SELECT * from agend where PK_codagend='$FK_codagend'");
$quantidade = mysqli_num_rows($selectt);
$upp = "UPDATE rotavend set quantidadeagend='$quantidade' where PK_codrotav='$PK_codrotav'";
$query_upp= mysqli_query($conexao, $upp);

$selecttt =mysqli_query($conexao, "SELECT * from agend where FK_codrotinha='$FK_codrotinha'");
$quantidade2 = mysqli_num_rows($selecttt);

$upp = "UPDATE rotinha set qtd_rotinha='$quantidade2' where PK_codrotinha='$FK_codrotinha'";
$query_upp= mysqli_query($conexao, $upp);



}// fim do apaga agendamento

//atualizar agendamento
if(isset($_POST['atualiza'])){
$PK_codagend = $_POST['PK_codagend'];
$FK_coduser= $_POST['FK_coduser'];

  

 $cliente_old =  $_POST['cliente_old'];
 $endereco_old =  $_POST['endereco_old'];
 $bairro_old =   $_POST['bairro_old'];
 $obs_old =   $_POST['obs_old'];
 $dataentrega_old =   $_POST['dataentrega_old'];
 $status_old =   $_POST['status_old'];
 $volume_old =   $_POST['volume_old'];


echo $cliente_old;
// termina aqui

$FK_codrotav = $_POST['FK_codrotav'];
$obs = $_POST['obs'];
$status = $_POST['status'];
$dataabertura = $_POST['dataabertura'];
$dataentrega = $_POST['dataentrega'];
$volume = $_POST['volume'];
$cliente = $_POST['cliente'];
$endereco = $_POST['endereco'];
$area = $_POST['area'];
$bairro = $_POST['bairro'];
$valor = $_POST['valorped'];
$almoco = $_POST['almoco'];
//atualizar agendamento

$sql_atualiza = "UPDATE agend set FK_coduser='$FK_coduser', obs='$obs', volume='$volume', dataabertura='$dataabertura', dataentrega='$dataentrega', cliente='$cliente', endereco='$endereco', bairro='$bairro', status='$status', almoco='$almoco' WHERE dataentrega = '$dataentrega' and PK_codagend =  '$PK_codagend'  ";
$resultado = mysqli_query($conexao, $sql_atualiza);
if($resultado == true)
{
    echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Agendamento Atualizado com Sucesso!" readonly> 
      </div>';

//aqui  - funcionou

$dataact = date("d-m-Y");
$horaact = date("H:i:s");
$data2 = new DateTime($dataentrega);
$data_ = $data2->format("d-m-Y");
$nomeuser = $_SESSION['username'];


if($status == 1){
$status = "Possui Pedido";
}else{
$status = "Caixão";
}


if($volume == 1){
$volume = "Possui Volume";
}else{
$volume = "N/";
}


 $descricao ="alterou as informações do  agendamento: - Cliente: ".$cliente." - Vendedor: ".$vendedor." - Endereço: ".$endereco." - Bairro: ".$bairro." - Obs: ".$obs."  Data de Entrega: ".$data_." - Status: ".$status." - Volume: ".$volume."";



$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");


// header('Refresh: 2; url=lista_agend.php');

}else{
 '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante a Edição de Agendamento, Tente Novamente.." readonly>
      </div>';
// header('Refresh: 2; url=lista_agend.php');
    }

// novos pedidos
///inserir pedidos novos no mesmo agendamento
 echo'  <br>';
   $pedidos = $_POST['ped'];
   #print_r($pedidos);
   //implode
   $item = implode(' - ', $_POST['ped']);
   #echo $item
if($item > 0){
for ($i=0; $i<count($pedidos); $i++){
///Insere os pedidos e o codigo de agendamento
  $inserir = "INSERT INTO ped(pedidos, valor, FK_codagend) VALUES ('$pedidos[$i]','$valor[$i]','$PK_codagend')";
  $qqnome = mysqli_query($conexao, $inserir);
  if($qqnome == true){
    echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Pedido Inserido com Sucesso!" readonly> 
      </div>';



if($status == 1){
$status = "Possui Pedido";
}else{
$status = "Caixão";
}


if($volume == 1){
$volume = "Possui Volume";
}else{
$volume = "N/";
}

 $descricao =" inseriu um novo pedido: - Pedido: ".$pedidos[$i]." - Valor: ".$valor[$i]." - Cliente: ".$cliente." - Vendedor: ".$vendedor." - Endereço: ".$endereco." - Bairro: ".$bairro." - Obs: ".$obs."  Data de Entrega: ".$data_." - Status: ".$status." - Volume: ".$volume;



$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");
// termina aqui



// header('Refresh: 2; url=lista_agend.php');
      ;
  }else{
 echo  '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante a Inserção de Pedidos, Tente Novamente.." readonly>
      </div>';
header('Refresh: 2; url=lista_agend.php');
  }

}
}
// fim dos novos pedidos

// atualizar pedido existente
$ped = $_POST['pedido_var'];
$val = $_POST['valor_var'];
$PK_codped2 = $_POST['PK_codped2'];

  
 echo'  <br>';
   $ped = $_POST['pedido_var'];
   //implode
   $itempedexistente = implode(' - ', $_POST['pedido_var']);
   #echo $item

for ($i=0; $i<count($ped); $i++){
$sql_atualiza = "UPDATE ped set pedidos='$ped[$i]', valor='$val[$i]' WHERE PK_codped = '$PK_codped2[$i]'";
$resultado = mysqli_query($conexao, $sql_atualiza);
}
if($resultado == true)
{
    echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Pedido Editado com Sucesso!" readonly> 
      </div>';
// header('Refresh: 2; url=lista_agend.php');
}else{
echo  '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante a Edição de Pedidos, Tente Novamente.." readonly>
      </div>';
  // header('Refresh: 2; url=meusagends.php');
    }
// fim do pedido existente



}


// }else{
//   echo  '<div class="form-group has-error">
//         <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Para editar um agendamento é necessário seleciona-lo." readonly>
//       </div>';
// }


?>

</form>

</div>
      </div>

    <div class="clearfix"> </div>

          <center>
<br>
      <!--<input type="submit"  name="enviar3" class="btn btn-default" value="Criar">
-->
        </center>
    </div>
</form>
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

<script>
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var PK_codagend = $(this).attr("id");  
           $.ajax({  
                url:"modal_apagaragendamento.php",  
                method:"post",  
                data:{PK_codagend:PK_codagend},  
                success:function(data){  
                     $('#employee_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 }); 
</script>


<!--    <script type="text/javascript">
function enviar2(){
    form=document.getElementById('form_envia');
    form.submit();
    form.action='edit_agend_admin.php';
}

</script>  -->
    <!---->
<div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
      </div>
    </div>
    <div class="clearfix"> </div>
       </div>
     </div>
<!---->
<!--scrolling js-->
  <script src="js/jquery.nicescroll.js"></script>
  <script src="js/scripts.js"></script>
  <!--//scrolling js-->
  <script src="js/bootstrap.min.js"> </script>
</body>
</html>