<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
  #header('location: ../login.php');
}

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


  }


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
include_once('menu_vendedor.php');
?>


        <div id="page-wrapper-md-12" class="gray-bg dashbard-1">    

       <div class="content-main">
 <center><h3>Formulário de Edição</h3><br></center>
    <div class="content-top">
      <center>
      <div class="grid-form">
    <div class="grid-form1">


    
      <?php 
if(isset($_GET['editar'])){
echo '<h3 id="forms-example" class="">Preencha os campos abaixo:</h3>';
 $PK_codagend = $_GET['PK_codagend'];
$FK_coduser= $_SESSION['coduser'];


$seltop = "SELECT * from agend where PK_codagend='$PK_codagend'";
$quiery = mysqli_query($conexao, $seltop);
while ($dados = mysqli_fetch_assoc($quiery)) {
  # code...

$FK_codrotav = $dados['FK_codrotav'];
$obs = $dados['obs'];
$status = $dados['status'];
$dataabertura = $dados['dataabertura'];
$dataentrega = $dados['dataentrega'];
#$turno = $_POST['turno'];
$volume = $dados['volume'];
$cliente = $dados['cliente'];
$endereco = $dados['endereco'];
$almoco = $dados['almoco'];


$bairro = $dados['bairro'];
#$quantidade = $_POST['quantidade'];
#$cf = $_POST['cf'];
$nomevendedor = $dados['nomevendedor'];

$seltop2 = "SELECT * from rotavend where PK_codrotav='$FK_codrotav'";
$quiery2 = mysqli_query($conexao, $seltop2);
while ($dados2 = mysqli_fetch_assoc($quiery2)){
$area = $dados2['FK_nomerota'];
}




}
}          // ... validações, inserts, updates, etc...
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


    <label for="exampleInputEmail1">  Entrega</label>
<input type="date" style="width:132px;font-size:12px;" class="form-control" id="exampleInputEmail1"name="dataentrega" value="<?=$dataentrega?>"  READONLY>
</div>
<!-- F INLINE DATAS -->

<BR>
    <div class="form-group">

<!-- Nome do cliente -->
 <label for="exampleInputEmail1">  Nome do Cliente</label> <input type="text" class="form-control" id="exampleInputName" name="cliente" placeholder="Insira o nome" value="<?=$cliente?>" >
<br>  <!-- F Nome do cliente -->
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
        <input type="text"  style="width:500px;" class="form-control1" id="inputError1" value="Selecione algum pedido.">
      </div>'; 
}elseif($conta_linha == $tamanho) {
echo  '<div class="form-group has-error">
        <input type="text"  style="width:500px;" class="form-control1" id="inputError1" value="Não é Possivel Apagar Todos os Pedidos, Para isso, Exclua o Agendamento">
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
header('Refresh: 1; url=meusagends.php');
  }
// se n der certo
else{
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um Erro Durante a Exclusaão dos Pedidos, tente novamente..">
      </div>'; 
header('Refresh: 1; url=meusagends.php');


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
  <input type="submit" class="btn btn-default" name="atualiza" class="btn btn-default" value="Confirmar Edição"/>
  <input type="submit" class="btn btn-default" name="apaga_agend" class="btn btn-default" value="Apagar Agendamento"/>
</div>
<br><br>
<?php

//Apaga Agendamento
if(isset($_POST['apaga_agend'])){
$PK_codagend = $_POST['PK_codagend'];
$FK_coduser= $_SESSION['coduser'];
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

//Pega o cod do agend
$select_agend = "SELECT * from agend where PK_codagend='$PK_codagend'";
$queryagend =  mysqli_query($conexao, $select_agend);
while ($linhaz = mysqli_fetch_assoc($queryagend)) {
$FK_codagend = $linhaz['PK_codagend'];
$PK_codrotav=$linhaz['FK_codrotav'];

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
header('Refresh: 1; url=meusagends.php');


}else{
    echo  '<div class="form-group has-error">
        <input type="text"  style="width:500px;height:200px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante a Exclusão do Aagendamento, Tente Novamente..">
      </div>';

}

$selectt =mysqli_query($conexao, "SELECT * from agend where PK_codagend='$FK_codagend'");
$quantidade = mysqli_num_rows($selectt);
$upp = "UPDATE rotavend set quantidadeagend='$quantidade' where PK_codrotav='$PK_codrotav'";
$query_upp= mysqli_query($conexao, $upp);

}// fim do apaga agendamento

//atualizar agendamento
if(isset($_POST['atualiza'])){
$PK_codagend = $_POST['PK_codagend'];
$FK_coduser= $_SESSION['coduser'];
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

$sql_atualiza = "UPDATE agend set obs='$obs', volume='$volume', dataabertura='$dataabertura', dataentrega='$dataentrega', cliente='$cliente', endereco='$endereco', bairro='$bairro', status='$status', almoco='$almoco' WHERE dataentrega = '$dataentrega' and PK_codagend =  '$PK_codagend'  ";
$resultado = mysqli_query($conexao, $sql_atualiza);
if($resultado == true)
{
    echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Agendamento Atualizado com Sucesso!" readonly> 
      </div>';
header('Refresh: 1; url=meusagends.php');


}else{
 '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante a Edição de Agendamento, Tente Novamente..">
      </div>';
  // header('Refresh: 2; url=meusagends.php');
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
	
	if($pedidos[$i] > 0){
$sql_atualizal = "UPDATE agend set status = 1 WHERE dataentrega = '$dataentrega' and PK_codagend =  '$PK_codagend'  ";
$query_atualizal = mysqli_query($conexao, $sql_atualizal);

	}
	
///Insere os pedidos e o codigo de agendamento
  $inserir = "INSERT INTO ped(pedidos, valor, FK_codagend) VALUES ('$pedidos[$i]','$valor[$i]','$PK_codagend')";
  $qqnome = mysqli_query($conexao, $inserir);
  if($qqnome == true){
    echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Pedido Inserido com Sucesso!" readonly> 
      </div>';
header('Refresh: 1; url=meusagends.php');
      ;
  }else{
 echo  '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante a Inserção de Pedidos, Tente Novamente..">
      </div>';
  // header('Refresh: 2; url=meusagends.php');
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
header('Refresh: 1; url=meusagends.php');
}else{
echo  '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante a Edição de Pedidos, Tente Novamente..">
      </div>';
  // header('Refresh: 2; url=meusagends.php');
    }
// fim do pedido existente


}





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