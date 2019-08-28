<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
header('location: ../index.php');}
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
include_once("../conexao.php");

$dataentrega = $_POST['dataentrega'];
$rotinha_existe = $_POST['rotinha'];
$area = '';
$nomecli = '';
$endereco = '';
$bairro = '';
$texto_outro = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataentrega = filter_input(INPUT_POST, 'dataentrega');
    $nomecli = filter_input(INPUT_POST, 'nomecli');
    $endereco = filter_input(INPUT_POST, 'endereco');
    $area = filter_input(INPUT_POST, 'area');

    $bairro = filter_input(INPUT_POST, 'bairro');
    $texto_outro = filter_input(INPUT_POST, 'texto_outro');
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
<script src="../mask.js"></script>
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
    <script>
  var mask = function (val) {
    val = val.split(":");
    return (parseInt(val[0]) > 19)? "HZ:M0" : "H0:M0";
}

pattern = {
    onKeyPress: function(val, e, field, options) {
        field.mask(mask.apply({}, arguments), options);
    },
    translation: {
        'H': { pattern: /[0-2]/, optional: false },
        'Z': { pattern: /[0-3]/, optional: false },
        'M': { pattern: /[0-5]/, optional: false }
    },
    placeholder: 'hh:mm'
};

$(document).ready(function () {
  $("#QuantidadeHoras").mask(mask, pattern);
});
</script>

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
       <div class="content-main" id="some">
<?php
  if(isset($_POST['enviar'])){

    $areast = $_POST['area'];
    $explode_area = explode(',', $areast);
    $qntd = $explode_area[1];
    $limiteagend = $explode_area[2];
    $area = $explode_area[0];

    if($qntd >= $limiteagend) {

  
echo '<center><div class="form-group has-error" id="mover">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Limite de agendamentos alterado" readonly>
      </div></center>
      ';

}else{  }}
?>
 <center><h3>Formulário de Venda</h3><br></center>
    <div class="content-top">
      <center>
      <div class="grid-form">
    <div class="grid-form1">


    <h3 id="forms-example" class="">Preencha os campos abaixo:</h3>
<form action="" method="POST"  id="form_1" role="form" autocomplete="off">
<!-- INLINE DATAS -->                
 <div class="form-inline">

<?php
      echo' <label for="exampleInputEmail1">Area</label>
    <input type="text" style="width:130px,font-size:12px;" class="form-control" id="exampleInputEmail1" name="area" placeholder="Área" value="'.$area.'" readonly/>';
    ?>


    <label for="exampleInputEmail1">Abertura</label> 
<?php
echo'<input type="hidden" name="qntd" value="'.$qntd.'">
<input type="hidden" name="limiteagend" value="'.$limiteagend.'">';

 $dataabertura = date ("Y-m-d");echo '<input type="date" class="form-control" id="exampleInputEmail1"name="dataabertura" style="width:132px;font-size:12px;" value="'.$dataabertura.'" READONLY>'; ?>  
    <label for="exampleInputEmail1">  Entrega</label>
     <?php

    echo '<input type="date" style="width:132px;font-size:12px;" class="form-control" id="exampleInputEmail1"name="dataentrega" value="'.$dataentrega.'" READONLY>';
?>  
</div>
<!-- F INLINE DATAS -->

<BR>
    <div class="form-group">
<?php
if($rotinha_existe == "rotinha"){

  $area = $_POST['area'];
  $explode = explode(',', $area);

echo ' 

<div class="form-inline">
<label for="exampleInputEmail1">Escolha uma Área:</label>';

for($i = 0, $count = count($explode); $i < $count; $i++) {
echo' 
<input type="radio" name="area" value="'.$explode[$i].'">'.$explode[$i].'';
}

echo'</div>';
echo'<br><br>';
}

echo '<label for="exampleInputEmail1"> Vendedor: </label>
<select name="vendedorA">';

// $vendedor_ = "SELECT * from agend where PK_cod = '$FK_datarg' and PK_codrotav = '$PK_codrotav'";
// $query_vendedor_ = mysqli_query($conexao, $vendedor_);
// //Procura se existe nome de vendedor na rota:
// while($recebe_vendedor = mysqli_fetch_assoc($query_vendedor_)){
// $vendedor_2 = $recebe_entreg['vendedor'];
// echo $vendedor_2;}

// se tiver vazio aparece a opçao de escolher o entregador:
if($vendedor_2  == null ){

echo'<option id="some_op">Escolher Vendedor</option>';

// se nao aparece o nome do entregador já preenchido:
}
else{
echo'<option value="'.$vendedor_2.'">'.$vendedor_2.'</option>';
}

// e puxa o nome do resto dos entregadores
$vendedor = "SELECT * from usuario where niveluser = 'vendedor' and status = 1 and username != '$vendedor_2'";
$query_vendedor = mysqli_query($conexao, $vendedor);
while($recebbe = mysqli_fetch_assoc($query_vendedor)){
$vendedor = $recebbe['username'];
$cod_vendedor = $recebbe['PK_coduser'];
echo '<option value="'.$cod_vendedor.'">'.$vendedor.'</option>';
}// fim while entregadores.

echo'
</select>
';
?>
<br/><br/><br/>
<!-- Nome do cliente -->
 <label for="exampleInputEmail1">  Nome do Cliente</label> <input type="text" class="form-control" id="exampleInputName" name="nomecli" placeholder="Insira o nome" value="<?=$nomecli?>" required>
<br>  <!-- F Nome do cliente -->
</div>
    <!-- OBS -->
    <div class="form-inline">

  
  <label for="exampleInputEmail1">Forma de pagamento</label><br/>
  <div class="checkbox">
    <label>
      <input type="radio" name="obs"  value="cheque"> Cheque
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="radio" name="obs"  value="dinheiro"> Dinheiro
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="radio" name="obs"  value="boleto"> Boleto
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="radio" name="obs"  value="cartao"> Cartão
    </label>
  </div>
  <div class="checkbox">
      <label>
      <input type="radio" name="obs"  value="Carteira"> Carteira
    </label>
  </div>
  <br/><br/>
  <label for="exampleInputEmail1">Observação</label>
    <br>
     <div class="checkbox">
    <label>
      <input type="radio" name="obs_nf"  value="notafiscal"> Nota Fiscal     
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="obss" id="outro" onclick="aparece();" value=""> Outro
    </label>
  </div>
  <style type="text/css">
    #text_area{
    display: none;}

  </style>
  
<div id="text_area">
<TEXTAREA name="outros"></TEXTAREA> 
<a onclick="fechar();">FECHAR</a>
</div>
  
  </div>
<br><!-- <style>
  #ch_almo{
    display: none;
  }

</style> -->
<!--Horario de Almoço-->
<label for="exampleInputEmail1">Horário de almoço? </label>
   Sim <input type="radio" name="almo" id="almo" onclick="aparece2();" checked="checked" value="SIM">
   Não <input type="radio" name="almo" id="almo2" onclick="fechar2();" value="NÃO">
  <div class="form-inline" id="ch_almo" >
     
    <label for="exampleInputEmail1">De: </label>
    <input type="text" id="tx_nome" class="form-control" name="hra" OnKeyPress="formatar('##:##', this)" 
      style="width:20px,font-size:12px;" maxlength="5"  />



    <label for="exampleInputEmail1">Até: </label>
    <input type="text" id="tx_nome" class="form-control" name="hrb" OnKeyPress="formatar('##:##', this)"  onblur="validarDados('ate', document.getElementById('tx_nome').value);" 
      style="width:20px,font-size:12px;" id="exampleInputEmail1"  maxlength="5" />
    </div>
   <br>  



<!--FIM Horario de Almoço-->
    <script>

$('#addped').click(function(){
    $('tx_nome').each(function() {
        if(!$(this).val()){
            alert('Some fields are empty');
           return false;
        }
    });
});


    function fechar(){
    document.getElementById("text_area").style.display="none";
        document.getElementById("outro").checked = false;
    // Coloque o que você quer ocultar dentro de uma <div> e subsititua o nome formulario pelo que você desejar
    }
    function aparece(){
    document.getElementById("text_area").style.display="block";
    document.getElementById("outro").checked = true;
    }
    function fechar2(){
    document.getElementById("ch_almo").style.display="none";
        document.getElementById("almo").checked = false;
    // Coloque o que você quer ocultar dentro de uma <div> e subsititua o nome formulario pelo que você desejar
    }
    function aparece2(){
    document.getElementById("ch_almo").style.display="block";
    document.getElementById("almo").checked = true;
    }

    </script>
<!-- Endereço e Bairro INLINE -->
    <div class="form-inline">
          <div class="form-gro">
  <label for="exampleInputEmail1">Endereço</label>
  <input type="text" class="form-control"  style="width: 350px;" id="exampleInputEmail1" name="endereco" placeholder="Endereço" value="<?=$endereco?>" required>
    <label for="exampleInputEmail1">Bairro</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="bairro" placeholder="Bairro" value="<?=$bairro?>"/>
    </div>
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
    }</style>

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
</div></div></div></div>
<input type="checkbox" name="volume" value="1"> Volume</div>
<input type="submit"  class="btn btn-default" id="addped" name="addped" class="btn btn-default" value="Registrar"/>



</div>
<?php
// Pega as variaveis
if(isset($_POST['addped'])){
 //if(!empty($_POST['obs'])){}
    
$qntd = $_POST['qntd'];
$limiteagend = $_POST['limiteagend'];
$area = $_POST['area'];
$almo = $_POST['almo'];
$hra = $_POST['hra'];
$hrb = $_POST['hrb'];

if($almo == "SIM"){
  if(empty($hra) || empty($hrb)){
    $hrt = "NÃO";
  }else{
    $hrta = $hra . " - ";
    $hrt = $hrta . $hrb;
  }
}
elseif($almo == "NÃO"){
  $hrt = $almo;
}
$dataabertura =  $_POST['dataabertura'];
$dataentrega =  $_POST['dataentrega'];
$nomecli =  $_POST['nomecli'];
$FK_coduser= $_SESSION['coduser'];
$volume =  $_POST['volume'];
$endereco = $_POST["endereco"];
$bairro = $_POST["bairro"];
$valor = $_POST['valorped'];
$cod_vendedorA = $_POST['vendedorA'];
// puxa as obs em array separando com o implode
   $checkbox = $_POST['obs'];
   //implode
  // ECHO $itens = implode(' - ', $_POST['obs']);

// puxa o pedido em array separando com o implode
 echo'  <br>';
   $pedidos = $_POST['ped'];
   //implode

$item = implode(' - ', $_POST['ped']);
$obs1 = $_POST['obs'];
$obs2 = $_POST['obs_nf'];
$itens = $obs1.' - '.$obs2;

$outros = $_POST['outros'];



//Puxa o codigo da rota v 
$sql_codrotav = "SELECT PK_codrotav from rotavend where FK_datarg =  '$dataentrega' and FK_nomerota='$area'";
$query = mysqli_query($conexao, $sql_codrotav);
if($query > 0){
while($linhas = mysqli_fetch_assoc($query)){
$FK_codrotav = $linhas['PK_codrotav'];
}
}

//Verifica se existe algum campo do ped preenchido

if($item == 0){//Se algum campo dos pedidos estiver vazio é caixão
$sql_inserir = "INSERT into agend(FK_coduser, FK_codrotav, dataabertura, dataentrega, cliente, endereco, bairro, volume, obs, FK_codrotinha, almoco, autorizado, outros) VALUES ('$cod_vendedorA','$FK_codrotav', '$dataabertura', '$dataentrega','$nomecli', '$endereco', '$bairro', '$volume', '$itens', '$FK_codrotinha', '$hrt', 'Sim', '$outros')";
$resultado2 = mysqli_query($conexao, $sql_inserir);
  if($resultado2 > 0){
echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Caixão Cadastrado com Sucesso!" readonly> 
      </div>';
      
    header("Refresh: 2; url=index.php");
  }else{
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante o agendamento, tente novamente.." readonly>
      </div>';
}

}else{//Se nao for caixao:

$status = 1;
$sql_inserir = "INSERT into agend(FK_coduser, FK_codrotav, status, dataabertura, dataentrega, volume, cliente, obs, endereco, bairro, almoco, autorizado, outros) VALUES ('$cod_vendedorA','$FK_codrotav','$status', '$dataabertura', '$dataentrega', '$volume', '$nomecli', '$itens' , '$endereco', '$bairro', '$hrt', 'Sim', '$outros')";
$resultado = mysqli_query($conexao, $sql_inserir);
  if($resultado > 0){
echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Agendamento Cadastrado com Sucesso!" readonly> 
      </div>';
   header("Refresh: 2; url=index.php");
  }else{
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante o agendamentooo, tente novamente.." readonly>
      </div>';
}

// Pega o Cod do agendamento
for ($i=0; $i<count($pedidos); $i++){


$sql = "SELECT PK_codagend from agend 
          where cliente = '$nomecli' AND dataentrega = '$dataentrega' AND FK_coduser = '$cod_vendedorA' 
          ORDER BY PK_codagend DESC LIMIT 1";
$query = mysqli_query($conexao, $sql);
if($query > 0){
while($linhas = mysqli_fetch_assoc($query)){
$PK_codagend = $linhas['PK_codagend'];
}

//Insere os pedidos e o codigo de agendamento
  $inserir = "INSERT INTO ped(pedidos, valor, FK_codagend) VALUES ('$pedidos[$i]','$valor[$i]','$PK_codagend')";
  $qqnome = mysqli_query($conexao, $inserir);
}else{
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreuu um erro durante o agendamento, tente novamente.." readonly>
      </div>';
}
}//fim do for
}


// Contador de quantidade de agend:
$sql = "SELECT * from agend where FK_codrotav = '$FK_codrotav'";
  $result = mysqli_query($conexao, $sql); // Realiza Query
  $rowcount=mysqli_num_rows($result);

  //verificar limite
$sqla2 = "SELECT * from rotavend where PK_codrotav = '$FK_codrotav'";
$resulta2 = mysqli_query($conexao, $sqla2); // Realiza Query
while($rlimit = mysqli_fetch_assoc($resulta2)){
    $limitee = $rlimit['limiteagend'];
  }
  if($rowcount <= $limitee){
  $sql = "UPDATE rotavend SET quantidadeagend='{$rowcount}' WHERE PK_codrotav='{$FK_codrotav}' ";
  $result = mysqli_query($conexao, $sql);

}elseif($rowcount > $limitee){
  $limitee = $rowcount;
  $sqla3 = "UPDATE rotavend SET quantidadeagend='$rowcount', limiteagend='$limitee' WHERE PK_codrotav='{$FK_codrotav}' ";
  $resulta3 = mysqli_query($conexao, $sqla3);
}

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

$vendedorF = "SELECT * from usuario where PK_coduser = '$vendedorA' and status = 1";
$query_vendedorF = mysqli_query($conexao, $vendedorF);
while($recebbeF = mysqli_fetch_assoc($query_vendedorF)){
$vendedorF = $recebbe['username'];
}
$descricao = "criou um agendamento: - Cliente: ".$cliente." - Vendedor: ".$vendedorF." - Endereço: ".$endereco." - Bairro: ".$bairro." - Obs: ".$obs."  Data de Entrega: ".$data_." - Status: ".$status." - Volume: ".$volume;



$ins_act = mysqli_query($conexao, "INSERT INTO historico(dataact, horaact, usuario, descricao) VALUES ('$dataact', '$horaact','$nomeuser','$descricao')");
// termina aqui




}// fim do isset

?>
</form>
</div></div>
<div class="clearfix"> </div>
<center>
<br>
</center></div>
<div class="content-mid">   
</div></div></div> 
<div class="clearfix"> </div></div>
</div></div>
<div class="clearfix"> </div></div>
<div class="copy">
<p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
</div></div>
<div class="clearfix"> </div></div></div>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.min.js"></script>
</body>
</html>