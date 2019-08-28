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


// echo "cod";
// $PK_codrotinha = $_POST['PK_codrotinha'];
// echo $PK_codrotinha[0];
// Pegar o codrotinha certo
$nomecli = '';
$endereco = '';
$bairro = '';
$texto_outro = '';
$arearv = '';
// $nomerotinha = '';
$areast = '';
$rotinha_existe = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataentrega = filter_input(INPUT_POST, 'dataentrega');
    $nomecli = filter_input(INPUT_POST, 'nomecli');
    $endereco = filter_input(INPUT_POST, 'endereco');
    $areast = filter_input(INPUT_POST, 'areast');
    $PK_codrotinha = filter_input(INPUT_POST, 'PK_codrotinha');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $texto_outro = filter_input(INPUT_POST, 'texto_outro');
    $arearv = filter_input(INPUT_POST, 'arearv');
    // $nomerotinha = filter_input(INPUT_POST, 'nomerotinha');
    $rotinha_existe = filter_input(INPUT_POST, 'rotinha_existe');

  }



$dataentrega = $_POST['dataentrega'];
$rotinha_existe = $_POST['rotinha_existe'];

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
//echo 'area1:'.$areast;
include_once('menu_vendedor.php');


     $areast = $_POST['areast'];

    $explode_area = explode(',', $areast);
    $explode_area2 = explode('*', $areast);
    $qntd = $explode_area2[1];
    $limiteagend = $explode_area2[2];
    $area = $explode_area2[0];
    //echo '<br>area2:'.$area;

    if($qntd >= $limiteagend) {
echo '<center><div class="form-group has-error" id="mover">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Essa Rota Não Possui Mais Vagas" readonly>
      </div></center>
<style>
#some{
  display:none;
}
#mover{

  display: flex;
  justify-content: center;
  flex-direction: column;
  height: 400px;

}

</style>
      ';

      
}else{  }
?>
        <div id="page-wrapper-md-12" class="gray-bg dashbard-1">    
       <div class="content-main" id="some">

 <center><h3>Formulário de Venda</h3><br></center>
    <div class="content-top">
      <center>
      <div class="grid-form">
    <div class="grid-form1">


    <h3 id="forms-example" class="">Preencha os campos abaixo:</h3>
<form action="" method="POST" id="forme"   role="form" autocomplete="off">
<!-- INLINE DATAS -->                
 <div class="form-inline">

<?php
      echo' 
      <label for="exampleInputEmail1">Area st</label>
    <input type="hidden" style="width:130px,font-size:12px;" class="form-control" id="exampleInputEmail1" name="areast" placeholder="Área" value="'.$areast.'" readonly/>
    <input type="text" style="width:130px,font-size:12px;" class="form-control" id="exampleInputEmail1" name="rotinha_existe" placeholder="Rotinha Existe" value="'.$rotinha_existe.'" readonly/>   
    <label for="exampleInputEmail1">Area</label>
    <input type="text" style="width:130px,font-size:12px;" class="form-control" id="exampleInputEmail1" name="nomerotinha" placeholder="Área" value="'.$area.'" readonly/>';
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

  // $area = $_POST['area'];
  // $explode_a = explode('*', $area);
  $explode = explode(',', $area);

echo ' 

<div class="form-inline">
<label for="exampleInputEmail1"><h4><b>Escolha uma Área:</b></label>';
 $count = count($explode);
for($i = 0; $i < $count; $i++) {
echo' 
<input type="radio" name="arearv" value="'.$explode[$i].'">'.$explode[$i].'';
}

echo'</div></h4>';
echo'<br>';
}


?>
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

 <style type="text/css">
    #text_area{
    display: none;}

  </style>

  <div class="checkbox">
    <label>
      <input type="checkbox" name="obss" id="outro" onclick="aparece();" value=""> Outro
    </label>
  </div>
  
  </div>
<div id="text_area">
<TEXTAREA name="outros"></TEXTAREA> 
<a onclick="fechar();">Fechar</a>
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
      style="width:20px,font-size:12px;" maxlength="5"/>
    <label for="exampleInputEmail1">Até: </label>
    <input type="text" id="tx_nome" class="form-control" name="hrb" OnKeyPress="formatar('##:##', this)" 
      style="width:20px,font-size:12px;" id="exampleInputEmail1"  maxlength="5" />
    </div>
   <br>  
<!--FIM Horario de Almoço-->
    <script>
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
                        <input class="form-control" name="valorped[]" type="number" placeholder="Valor" step="0.01"/>
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
<input type="submit"  class="btn btn-default" name="addped" class="btn btn-default" value="Registrar"/>



</div>
<?php
// Pega as variaveis
if(isset($_POST['addped'])){



  //if(!empty($_POST['obs'])){}
    


$qntd = $_POST['qntd'];
$limiteagend = $_POST['limiteagend'];
$arearv = $_POST['arearv'];
// $nomerotinha = $_POST['nomerotinha'];
    $almo = $_POST['almo']; //hr almoço
    if($almo == "SIM"){
    $hra = $_POST['hra'];
    $hrb = $_POST['hrb'];
    $hrta = $hra . " - ";
    $hrt = $hrta . $hrb;
    }
    elseif($almo == "NÃO"){
      $hrt = $almo;
    } //hr almoço
$dataabertura =  $_POST['dataabertura'];
$dataentrega =  $_POST['dataentrega'];
$nomecli =  $_POST['nomecli'];
$FK_coduser= $_SESSION['coduser'];
$volume =  $_POST['volume'];
$endereco = $_POST["endereco"];
$bairro = $_POST["bairro"];
$valor = $_POST['valorped'];
$outros = $_POST['outros'];
// puxa as obs em array separando com o implode
   $checkbox = $_POST['obs'];
   //implode
   //$itens = implode(' - ', $_POST['obs']);
$obs1 = $_POST['obs'];
$obs2 = $_POST['obs_nf'];
$itens = $obs1.' - '.$obs2;


// puxa o pedido em array separando com o implode
 echo'  <br>';
   $pedidos = $_POST['ped'];
   //implode
   $item = implode(' - ', $_POST['ped']);



//Puxa o codigo da rota v 
$sql_codrotav = "SELECT * from rotavend where FK_datarg =  '$dataentrega' and FK_nomerota='$arearv'";
$query = mysqli_query($conexao, $sql_codrotav);
if($query > 0){
while($linhas = mysqli_fetch_assoc($query)){
$FK_codrotav = $linhas['PK_codrotav'];
$FK_codrotinha = $linhas['FK_codrotinha'];
}
}

//Verifica se existe algum campo do ped preenchido



if($item == 0){//Se algum campo dos pedidos estiver vazio é caixão
$sql_inserir = "INSERT into agend(FK_coduser, FK_codrotav, dataabertura, dataentrega, cliente, endereco, bairro, volume, obs, FK_codrotinha, almoco, outros) VALUES ('$FK_coduser','$FK_codrotav', '$dataabertura', '$dataentrega','$nomecli', '$endereco', '$bairro', '$volume', '$itens', '$FK_codrotinha', '$hrt', '$outros')";
$resultado2 = mysqli_query($conexao, $sql_inserir);
  if($resultado2 > 0){
echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Caixão Cadastrado com Sucesso!" readonly> 
      </div>';
    header("Refresh: 4; url=index.php");
  }else{
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante o agendamento, tente novamente..">
      </div>';
}

}else{//Se nao for caixao:

$status = 1;
$sql_inserir = "INSERT into agend(FK_coduser, FK_codrotav, status, dataabertura, dataentrega, volume, cliente, obs, endereco, bairro, FK_codrotinha, almoco, outros) VALUES ('$FK_coduser','$FK_codrotav','$status', '$dataabertura', '$dataentrega', '$volume', '$nomecli', '$itens' , '$endereco', '$bairro','$FK_codrotinha', '$hrt', '$outros')";
$resultado = mysqli_query($conexao, $sql_inserir);
  if($resultado > 0){
echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Agendamento Cadastrado com Sucesso!" readonly> 
      </div>';
   header("Refresh: 4; url=index.php");
  }else{
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante o agendamentooo, tente novamente..">
      </div>';
}

// Pega o Cod do agendamento
for ($i=0; $i<count($pedidos); $i++){
$sql = "SELECT * from agend 
          where cliente = '$nomecli' AND dataentrega = '$dataentrega' 
          AND FK_coduser = '$FK_coduser' ORDER BY PK_codagend DESC LIMIT 1";
$query = mysqli_query($conexao, $sql);
if($query > 0){
while($linhas = mysqli_fetch_assoc($query)){
$PK_codagend = $linhas['PK_codagend'];
$FK_codrotinha = $linhas['FK_codrotinha'];
}

//Insere os pedidos e o codigo de agendamento
  $inserir = "INSERT INTO ped(pedidos, valor, FK_codagend) VALUES ('$pedidos[$i]','$valor[$i]','$PK_codagend')";
  $qqnome = mysqli_query($conexao, $inserir);
}else{
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro durante o agendamento, tente novamente..">
      </div>';
}
}//fim do for
}


// Contador de quantidade de agend:
$sql = "SELECT * from agend where FK_codrotinha = '$FK_codrotinha'";
  $result = mysqli_query($conexao, $sql); // Realiza Query
  $rowcount=mysqli_num_rows($result);
 //echo 'sel agend rotinha'.$rowcount;
  $sql = "UPDATE rotinha SET qtd_rotinha='{$rowcount}' WHERE PK_codrotinha='{$FK_codrotinha}' ";
  $result = mysqli_query($conexao, $sql); 

  $upd_rt = "UPDATE rotavend set quantidadeagend='$rowcount' where PK_codrotav='$FK_codrotav'";
  $query_rt = mysqli_query($conexao, $upd_rt);





  // Realiza Query

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