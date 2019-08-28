<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
    header('location: ../index.php');
}
include_once("../conexao.php");
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
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

<!---->

<!--pie-chart-->
<script src="js/pie-chart.js" type="text/javascript"></script>
<style type="text/css">
input[type=number]::-webkit-inner-spin-button { 
    -webkit-appearance: none;
    cursor:pointer;
    display:block;
    width:8px;
    color: #333;
    text-align:center;
    position:relative;
}
   input[type=number] { 
   -moz-appearance: textfield;
   appearance: textfield;
   margin: 0; 
}
    


    
</style>
<script src="js/skycons.js"></script></head>
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
$data1= $_POST['data'];
$i= 0;
$area1 = $_POST['area']; //array
$area_t = implode(',', $_POST['area']); //string
?>
        <div id="page-wrapper" class="gray-bg dashbard-1">

         <div class="content-main">
<form action="" id="myForm" method="POST">
<center><input type="date" name="data"  value="<?=$data1?>" readonly></center><br>
<div id ="rotinhazinha">
<?php

echo '<center>
<h4>Área(s): '.$area_t.'</h4>';
for ($i=0; $i < count($area1) ; $i++) { //conta array
echo '
    <input type="hidden" value="'.$area1[$i].'" name="area[]">'; //areas em array
$select = "SELECT * from rotavend where FK_nomerota ='$area1[$i]' and FK_datarg='$data1'"; 
$query_select = mysqli_query($conexao, $select);
$contador = mysqli_num_rows($query_select);
while($linha_codrotav = mysqli_fetch_assoc($query_select)){
$PK_codrotav = $linha_codrotav['PK_codrotav'];

echo '<input type="hidden" name="PK_codrotav[]" value="'.$PK_codrotav.'">
';
}
}
echo'
    <br>
 <label>Vagas:</label>
<input type="number" name="vagas" style="width:40px; ">
<input type="hidden" name="area_t" value="'.$area_t.'">
<input type="submit" name="criar" id="some" value="Criar" onClick="doPreview()" class="btn btn-default">

</center>';

if(isset($_POST['criar'])){
$area_t = $_POST['area_t'];
$vagas = $_POST['vagas'];
$data1 = $_POST['data'];
$cod_separado = $_POST['PK_codrotav']; //array
$tdscods = implode(' - ', $_POST['PK_codrotav']); //string

echo'<style>
#some{
    display:none;
}
</style>';



$new_rotinha = mysqli_query($conexao, "INSERT INTO rotinha(rotas, limite_rotinha, FK_datarg) 
                                        VALUES('$area_t','$vagas', '$data1')");

if($new_rotinha == true){
    echo '<center><div class="form-group has-success">
 <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Rotinha Criada com Sucesso!" readonly> 
 </div></center>

<input type="hidden" name="data2" value="'.$data1.'">
<input type="hidden" name="vagas2" value="'.$vagas.'">

<input type="hidden" name="area_t" value="'.$area_t.'">
<center>
<input type="submit" name="criar" value="Enviar Mensagem" onClick="doPreview()" class="btn btn-default">
</center>';
$update__ = "UPDATE usuario set rotinha_ok = 0 ";
$update_query = mysqli_query($conexao, $update__);

include_once('popup.php');

$sel = "SELECT * from rotinha where  FK_datarg='$data1' order by PK_codrotinha desc LIMIT 1";
$query_sel = mysqli_query($conexao, $sel);
while ($rotinha = mysqli_fetch_assoc($query_sel)) {
    $PK_codrotinha = $rotinha['PK_codrotinha'];
    $qtd_rotinha = $rotinha['qtd_rotinha'];
    $rotas = $rotinha['rotas'];
    $limite_agend = $rotinha['limite_rotinha'];
    $rotinha_ok = $rotinha['rotinha_ok'];
for ($i=0; $i <count($cod_separado) ; $i++) { 

$update_1 = "UPDATE rotavend set FK_codrotinha = '$PK_codrotinha' where PK_codrotav = '$cod_separado[$i]'";
$query_update_1 = mysqli_query($conexao, $update_1);
// echo $PK_codrotinha;
// echo'<BR>';
// echo $cod_separado[$i];

}//for
}//while

 #header('Refresh: 2; url=visualizar_rotas.php');
}else{
    echo '<center><div class="form-group has-error">
<input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro, tente novamente!"></div></center>';
# header('Refresh: 2; url=visualizar_rotas.php');

}

}





?>
</div>


<?php


if(isset($_POST['bloquear'])){
echo
'<style type="text/css">
#rotinhazinha{
display:none;
}</style>';

$data = $_POST['data'];
$bloqueado = 1;

// bloquear rotav
$sql_consulta = "UPDATE rotavend SET bloqueado = '$bloqueado' where  FK_datarg = '$data'";
$result = mysqli_query($conexao, $sql_consulta); 
if($result == 1){
echo '
<br>
<center>
<div class="form-group has-success">
<input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Rota Bloqueada com Sucesso!" readonly> 
</div></center>';
 header('Refresh: 2; url=index.php');

}else{
echo '
<br>
<center>
<div class="form-group has-error">
<input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro, tente novamente!"></div></center>';
 header('Refresh: 2; url=index.php');

}// fim do bloqueio



}// fim do isset

if(isset($_POST['desbloquear'])){
       echo '<style type="text/css">
   #rotinhazinha{
display:none;
}</style>';


$data = $_POST['data'];
$bloqueado = 0;

// bloquear rotav
$sql_consulta = "UPDATE rotavend SET bloqueado = '$bloqueado'  where  FK_datarg = '$data'";
$result = mysqli_query($conexao, $sql_consulta); 
if($result == 1){
    session_unset(['rotinha']);
echo '
<br>
<center>
<div class="form-group has-success">
<input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Rota Desloqueada com Sucesso!" readonly> 
</div></center>';
 header('Refresh: 2; url=index.php');
}else{
echo '
<br>
<center>
<div class="form-group has-error">
<input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Ocorreu um erro, tente novamente!"></div></center>';
  // header('Refresh: 2; url=index.php');

}// fim do bloqueio



}// fim do isset

?>
 <script type="text/javascript">
 function doPreview(){
        form=document.getElementById('myForm');
        form.target='_blank';
        form.action='popup.php';
        form.submit();
        form.action='result_index.php';
        form.target='';
    }
 </script>

 </form>

 <br> <br> <br>
 <br> <br> <br> 
 <br> <br>
 </div>
<div class="copy">
            <p> &copy; 2018 | Dental MV | Desenvolvido por Equipe de TI</p>
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
    <!--//scrolling js-->
    <script src="js/bootstrap.min.js"> </script>
</body>
</html>