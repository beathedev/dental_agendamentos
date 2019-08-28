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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
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

<!--pie-chart--->
<script src="js/pie-chart.js" type="text/javascript"></script>

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
include_once('../graficos.php');


$aumenta = 0;
$i= 0;
$temErro = false;
$data = '';
$data = $_POST['data'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data');

}
    // ... validações, inserts, updates, etc...
?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
<form  action="result2.php" method="POST">


         <div class="content-main">
<?php
$data_rota = $_POST['data'];


date_default_timezone_set('America/Sao_Paulo');


$sql_data = mysqli_query($conexao, "SELECT * from datas_bloq WHERE PK_databloq = '$data_rota'");
if(mysqli_num_rows($sql_data) > 0){
while($result_data = mysqli_fetch_assoc($sql_data)){
  $PK_databloq = $result_data['PK_databloq'];
  $datadestino = $result_data['datadestino'];
 $data_rota = $datadestino;
}
}

?>

<center><input type="date" name="data"  value="<?=$data_rota?>" readonly><br><br>

<?php
if(isset($_POST['enviar'])){



// seleciona a rotav pela data
$sql_consulta = "SELECT * from rotavend where  FK_datarg = '$data'";
$result = mysqli_query($conexao, $sql_consulta); 
$contador_rotas=mysqli_num_rows($result);
while($linhas2 = mysqli_fetch_array($result)){
$bloqueado = $linhas2['bloqueado'];
}//while bloqueado


if($contador_rotas > 0){
//contador de rotinhas
$sql_rotinha = "SELECT * from rotinha where FK_datarg = '$data'";
$sql_rotinha_query = mysqli_query($conexao, $sql_rotinha);
$conta_rotinha = mysqli_num_rows($sql_rotinha_query);




//se exister vai aparecer a opçao de bloquear e o status das rotas:

if($bloqueado == 0){
echo '<br>';
echo '<style type="text/css">#some{ display:none;}</style>
';


}else{
echo '<input type="submit" name="enviar" class="btn btn-default" value="Criar Rotinha"> '; 
echo '<input type="submit" name="desbloquear" class="btn btn-default" value="Desbloquear Rota">';


if($conta_rotinha > 0){
echo '<br><br><P>'.$conta_rotinha.' rotinha(s) foram criadas <br><a href="rotinhas.php"  class="btn btn-default" value=""> Ver Rotinhas </a>';
}//rotinha



}// bloqueado


echo '</center>';



$sql_consulta = "SELECT * from rotavend where  FK_datarg = '$data'";
$result = mysqli_query($conexao, $sql_consulta);
echo'<br>';
while($linhas = mysqli_fetch_array($result)){


$nomerota = $linhas['FK_nomerota'];
$quantidadeagend = $linhas['quantidadeagend'];
$limiteagend = $linhas['limiteagend'];
$rotinha = $linhas['FK_codrotinha'];
$codigo_rotav = $linhas['PK_codrotav'];
//$i = 1; 

$contap = (100 / $limiteagend);
$conta = $contap * $quantidadeagend;
$aumenta = $aumenta + 1;
    echo '<form  action="result2.php" method="POST">';

echo'

<div class="col-md-6 ">
<div class="content-top-1"> 
<div class="col-md-6 top-content">
<input type="hidden" name="dataentrega" value="'.$data.'">
<input type="hidden" name="codigo_rotav" value="'.$codigo_rotav.'">
<h5 name='.$nomerota.'>'.$nomerota.'<input type="checkbox" id="some" name="area[]" value="'.$nomerota.'"/></h5>
<p>'.$quantidadeagend.' / '.$limiteagend.' vagas';

echo'<input type="submit" class="btn-xs btn-default" name="ver" value="Ver Agendamentos">';
echo'
</div>
<div class="col-md-6 top-content1">    
<div id="demo-pie-'.$aumenta.'" class="pie-title-center" data-percent="'.$conta.'">
<span class="pie-value"></span></div>
</div>
<div class="clearfix"> </div>
</div></div></form>';
    if( $i%2 == 0 ) {


    $i++;

    }

    }// fim do while
    echo'<br> <br><br> <br><br> <br><br> <br>
<br> <br><br> <br><br> <br><br> <br>
<br> <br><br> <br><br> <br><br> <br>
<br> <br><br> <br><br> <br><br> <br>';
}
?></center> 

<?php

//se nao exister vai aparecer a opçao de criar:
}else{


// cria rg

 $sql_vrg = "SELECT * from rotageral where PK_datarg =  '$data'";
    $qvrg = mysqli_query($conexao, $sql_vrg); 
    $queryvrg = mysqli_num_rows($qvrg);
    if ($queryvrg == 0) {
    Echo '<h3>A rota selecionada nao é existente, aguarde enquanto ela é criada:</h3>';
      $sql_crg = "INSERT INTO rotageral(PK_datarg, qtdrotav) VALUES ('$data', 0)";
      $inserir_rg = mysqli_query($conexao, $sql_crg);
$select = "SELECT * from area";
$queryselect = mysqli_query($conexao, $select);
while($recebe = mysqli_fetch_assoc($queryselect)){
    $area = $recebe['PK_nomerota'];


      $sql_crv = "INSERT INTO rotavend(FK_datarg, FK_nomerota, quantidadeagend, bloqueado, limiteagend, rotinha) VALUES ('$data','$area', 0, 0, 7, 0)";
      $inserir_rg = mysqli_query($conexao, $sql_crv);
     } 

     if($inserir_rg == true){
         header("Refresh: 4; url=visualizar_rotas.php");
  
     }
 
    }elseif ($queryvrg > 1){
   echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro ao inserir esta rota">
      </div>';
    }elseif($queryvrg == 1){
     echo ' <div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="A rota está sendo criada..." readonly> 
      </div>';
   header("Refresh: 4; url=visualizar_rotas.php");
    }else{ 
        echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro ao inserir esta rota">
      </div>';
    }

    echo'<br> <br><br> <br><br> <br><br> <br>
<br> <br><br> <br><br> <br><br> <br>
<br> <br><br> <br><br> <br><br> <br>
<br> <br><br> <br><br> <br><br> <br>
<br> <br><br> <br><br> <br><br> <br>';

}

?>
</form>

<br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br>
<!-- banner-->   
        <!--//banner-->
        <!--content-->
        <div class="content-top">

</center>
</div>

    <div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de Ti</p>
        </div>
        </div>
        <div class="clearfix"> </div>
       </div>
     </div> </div>
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

