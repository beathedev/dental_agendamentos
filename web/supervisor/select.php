<?php  
ob_start();
session_start();
    include_once("../conexao.php");
// $PK_codagendaa = $_POST['PK_codagenda2'];
// $turnoagend = $_POST['turnoagend'];
// $FK_nomerota2 = $_POST['FK_nomerota2'];
// $FK_datarg = $_POST['FK_datarg'];
// $turno_escolhido = $_GET['var'];




// <input type="hidden" id="PK_codrotavtp"  value="'.$PK_codrotav.'" name="PK_codrotavtp">';







//  if(isset($_POST["PK_codagenda2"]))
//  {  

// // $PK_codagend = $_POST["PK_codagenda2"];
// // $turno = $_POST['turnoagend'];
// // $FK_nomerota = $_POST['FK_nomerota2'];
// // $FK_datarg = $_POST['FK_datarg'];
// }





 if(isset($_POST["PK_codrotav"]))
 {  


$PK_codrotav = $_POST['PK_codrotav'];
$explode = explode(',', $PK_codrotav);




// ECHO $explode;

$PK_codrotav_ =  $explode[0];
echo'<br>';
$turno = $explode[1];
echo'<br>';
$PK_codagend =  $explode[2];
echo'<br>';
$FK_nomerota =  $explode[3];
echo'<br>';
$FK_datarg = $explode[4];

}





      $query = "SELECT * FROM rotavend WHERE PK_codrotav = '".$_POST["PK_codrotav"]."'";  
      $result = mysqli_query($conexao, $query);  

      while($row = mysqli_fetch_array($result))  
      {  
  $turno = $row["turno"];
  echo '  
  <form method="POST" id="form_enviar">
    Turno Atual: '.$turno.'<br><br>
';




echo'
<input type="hidden" id="PK_codagenda2" name="PK_codagenda2" value="'.$PK_codagend.'"/>
<input type="hidden" id="turnoagend"  value="'.$turno.'" name="turnoagend">
<input type="hidden" id="FK_datarg"  value="'.$FK_datarg.'" name="FK_datarg">
<input type="hidden" id="FK_nomerota2"  value="'.$FK_nomerota.'" name="FK_nomerota2">

';


if ($turno == "Manhã"){

echo'
<input type="radio" name="turno_escolhido" value="Horário Comercial">Horário Comercial 
<br>
<input type="radio" name="turno_escolhido" value="Tarde">Tarde';


}elseif($turno == "Tarde"){
  echo'
<input type="radio" name="turno_escolhido" value="Horário Comercial">Horário Comercial
<br>
<input type="radio" name="turno_escolhido" value="Manhã">Manhã';


}elseif($turno == "Horário Comercial"){
  echo'
<input type="radio" name="turno_escolhido" value="Tarde" >Tarde
<br>


<input type="radio" name="turno_escolhido" value="Manhã">Manhã
';
}else{
  echo "Turno Não Definido Ainda";
  echo'
<style>
#some{display:none;}
</style>
  ';
}

echo'
<br>
<br>
<center>
 <button type="submit" onclick="enviar();
" name="mudaturno" class="btn btn-default" id="some">Enviar</button>  
</center>
</form>';

} 




 ?>
<script type="text/javascript">
function enviar(){
    form=document.getElementById('form_enviar');
    form.submit();
    form.action='gerar_rotag.php';
}

</script> 