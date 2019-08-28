<?php
ob_start();
session_start();
if(!isset($_SESSION['username']) && (!isset($_SESSION['senha']))){
    header('location: ../index.php');
}
    include_once("../conexao.php");
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
  border: none;
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
$data_rota = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_rota = filter_input(INPUT_POST, 'data_rota');

}

if(date('N') > 4 ){
  $data = date ("Y-m-d");
// $data = new DateTime(date("Y-m-d"));
// $data->modify('+3 day');
$inicio= $data;
$dia_seguinte=1;
$data_termino = new DateTime($inicio);
$data_termino->add(new DateInterval('P'.$dia_seguinte.'D'));
$data_rota=$data_termino->format("Y-m-d");
$data_rota_layout=$data_termino->format('d-m-Y');
// $data_rota=$data->format('Y-m-d');
// $data_rota_layout=$data->format('d-m-Y');
}elseif(date('N') <= 4 ){
$data = date ("Y-m-d");
$inicio= $data;
$dia_seguinte=1;
$data_termino = new DateTime($inicio);
$data_termino->add(new DateInterval('P'.$dia_seguinte.'D'));
$data_rota=$data_termino->format("Y-m-d");
$data_rota_layout=$data_termino->format('d-m-Y');
// echo $data_rota;
// echo $data_rota;
}else{}
$data_rota  = $_POST['data_rota'];
$sql_data = mysqli_query($conexao, "SELECT * from datas_bloq WHERE PK_databloq = '$data_rota'");
if(mysqli_num_rows($sql_data) > 0){
while($result_data = mysqli_fetch_assoc($sql_data)){
  $PK_databloq = $result_data['PK_databloq'];
  $datadestino = $result_data['datadestino'];
 $data_rota = $datadestino;
}
}


?>


<div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
     <center> 

    <br><br>
    <table class="greyGridTable" >   
 <?php
echo $data_rota;
echo $data;
if($data_rota >= $data){
   echo'<form action="gerar_rotag2.php" name="myForm" method="GET">
<input type="hidden" name="data_rota" value="'.$data_rota.'">
</form>

<script type="text/javascript">
          document.forms["myForm"].submit();
</script>
';



}else{
 $data_rota  = $_POST['data_rota'];

$sql1 = "SELECT * from rotageral WHERE PK_datarg = '$data_rota'";  //puxando rota geral pela data 
$query1 = mysqli_query($conexao, $sql1);
$conres1 = mysqli_num_rows($query1);
if($conres1 < 1){ 
echo '<div class="form-group has-error">
        <input type="text"  style="width:500px; text-align:center;" class="form-control1" id="inputError1" value="Não foram encontrados registros da data informada"></div>';
    }else{
while($linhas1 = mysqli_fetch_array($query1)){
$PK_datarg = $linhas1['PK_datarg'];

$codrotageral = $linhas1['codrotageral'];
$qtdrotav = $linhas1['qtdrotav']; //desce camada 1
    $sql2 = "SELECT * from rotavend WHERE FK_datarg = '$PK_datarg' ORDER BY FK_nomerota ASC";  //puxando rotas de vendedor da RG
    $query2 = mysqli_query($conexao, $sql2);
    $contador2 = mysqli_num_rows($query2);
    while($linhas2 = mysqli_fetch_array($query2)){
    $PK_codrotav = $linhas2['PK_codrotav'];
    $FK_nomerota = $linhas2['FK_nomerota'];
    $quantidadeagend = $linhas2['quantidadeagend'];
    $bloqueado = $linhas2['bloqueado'];
    $entregador = $linhas2['entregador'];
    $transporte = $linhas2['transporte'];
    $turno = $linhas2['turno'];
    if($quantidadeagend < 1){   }
    elseif($quantidadeagend >= 1){ //desce camada 2
        echo '<form method="POST" action="">

        <input type="hidden" name="PK_codrotava" value="'.$PK_codrotav.'"/>
    <thead>
    
           

            <tr  class="nomerota">
            <th colspan="3"><h3>'.$FK_nomerota.'</h3></th>
            <th colspan="3"><h5>Entregador: <input type="text" name="entregadorA" value="'.$entregador.'" readonly="readonly"/></th></h5> 
            
                                                         
            <th colspan="2"><h5>Transporte: </h5><h6>';
if($transporte == 1){
 echo'
 <input type="text" name="transporteA" value="Carro" readonly="readonly">
 </h6></th>';
}elseif($transporte == 0){
 echo'
 <input type="text" name="transporteA" value="Moto" readonly="readonly">
 </h6></th>';
}
echo'

            <th colspan="2"><h5>Turno: </h5>                                          
                    <h6>
                    <input type="text" name="turnoA" value="'.$turno.'" readonly="readonly">
                    </h6></th>
            <th colspan="2"> </th>
            </tr>
            <tr>
            <th>VL</th>
            <th>Cliente</th>
            <th>OBS/PGT</th>
            <th>Endereço</th>
            <th>Bairro</th>
            <th>Pedidos</th>
            <th>Valor</th>
            <th>Vendedor</th>
            <th>PED</th>
            <th>CF</th>
            <th>QTD</th>
            </tr>
            </thead>
';
        $sql3 = "SELECT * from agend WHERE FK_codrotav = '$PK_codrotav' ORDER BY cliente DESC";  //puxando agendamentos dessas rotas de vendedores
        $query3 = mysqli_query($conexao, $sql3);
        $cont3 = mysqli_num_rows($query3);


        while($linhas3 = mysqli_fetch_array($query3)){
            $PK_codagend = $linhas3['PK_codagend'];
            echo'<input type="hidden" name="PK_codagenda[]" value="'.$PK_codagend.'"/>';
            $FK_coduser = $linhas3['FK_coduser'];
            $obs = $linhas3['obs'];
            $status = $linhas3['status'];
            $dataabertura = $linhas3['dataabertura'];
            $dataentrega = $linhas3['dataentrega'];
            $volume = $linhas3['volume'];
            $cliente = $linhas3['cliente'];
            $endereco = $linhas3['endereco'];
            $bairro = $linhas3['bairro'];
            $quantidade = $linhas3['quantidade'];
            $cf = $linhas3['cf'];
            $sqlp1 = "SELECT pedidos from ped WHERE FK_codagend = '$PK_codagend'";
            $queryp1 = mysqli_query($conexao, $sqlp1);

            
            //desce camada 3
            
            echo' 
        <tbody>
            <tr class="mudae">';
                        if($volume == 0){ echo '<td>N/</td>'; }
                        else{ echo '<td style="background-color:black;width:1px;"></td>'; }
             echo'
            <td>'.$cliente.'</td>
            <td>'.$obs.'</td>
            <td>'.$endereco.'</td>
            <td>'.$bairro.'</td>
      
            <td>';
                //if(mysqli_num_rows($queryp1) > 0){
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
            echo'</td> ';


$sql_nome = "SELECT * from usuario where PK_coduser='$FK_coduser'";
$select_nome = mysqli_query($conexao, $sql_nome);
while ($vendedor = mysqli_fetch_assoc($select_nome)){
    $nomevendedor =$vendedor['username'];
}

echo'<td>'.$nomevendedor.'</td>';
echo'<td>'; $contae = mysqli_num_rows($queryp1);
                            if ($contae<1){
                                echo "Caixao";
                            }else{
                                echo $contae;
                            }echo'</td>';

echo'<td><input type = "text" class="cf" name="cfd[]" value="'.$cf.'" style="background-color: #EBEBEB;" readonly="readonly""/></td>
<td><input type = "text" class="cf" name="qtdagend[]" value="'.$quantidade.'" style="background-color: #EBEBEB;" readonly="readonly"/></td>';

                $sql4 = "SELECT * from ped WHERE FK_codagend = '$PK_codagend' ORDER BY pedidos DESC";  //puxando pedidos desses agends
                $query4 = mysqli_query($conexao, $sql4);
                while($linhas4 = mysqli_fetch_array($query4)){
                    $PK_codped = $linhas4['PK_codped'];
                    $pedidos = $linhas4['pedidos'];
                    $valor = $linhas4['valor'];
                    } //while peds
 }//while agends
            }//fim else
echo'</tr></form></tbody>';}//while Rota de Vendedores
    }//while Rota Geral
}
if(isset($_POST['edit'])){
        $cfd = $_POST['cfd'];
        $qtdagend = $_POST['qtdagend'];
        $PK_codagenda = $_POST['PK_codagenda'];
        $PK_codrotava = $_POST['PK_codrotava'];
        $entregadorA = $_POST['entregadorA'];
        $transporteA = $_POST['transporteA'];
        $turnoA = $_POST['turnoA'];

            $ins1 = mysqli_query($conexao, "UPDATE rotavend SET entregador = '$entregadorA', transporte = '$transporteA', turno ='$turnoA' WHERE PK_codrotav = '$PK_codrotava'");
                
        $sql2 = mysqli_query($conexao, "SELECT * from agend WHERE FK_codrotav = '$PK_codrotava'");
        $contsl=mysqli_num_rows($sql2);
            for($aumenta = 0; $aumenta < $contsl; $aumenta ++){
            //$cfd[$aumenta]=$_POST['cfd'];
            //$quantidade=$_POST['qtdagend'];
            $a = $aumenta + 1;
            $ins2 = mysqli_query($conexao, "UPDATE agend SET quantidade = '$qtdagend[$aumenta]', cf ='$cfd[$aumenta]' WHERE PK_codagend = '$PK_codagenda[$aumenta]'");
            }
            header("Location:gerar_rotag.php");
        } }
            














?>
</div></div>
</table>
</center>

        <!--banner-->   
        <!--//banner-->
        <!--content-->
        <div class="content-top">



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