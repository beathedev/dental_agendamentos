<?php
$status = $_POST['status'];
$area = $_POST['area'];
$codarea = $_POST['codarea'];
echo $codarea;
echo $area;
echo $status;
    include_once("../conexao.php");

$update = "UPDATE area set status='$status' where codarea ='$codarea'";
$query = mysqli_query($conexao, $update);

//query
if($query > 0 ){
echo '<div class="form-group has-success">
        <input type="text" style="width:500px; text-align:center;" class="form-control1" id="inputSuccess1" value="Alteração Concluída" readonly> 
      </div></center>';
           header("Location: lista_area.php");

}else{
echo '    <div class="form-group has-error">
        <input type="text" class="form-control1"  style="width:500px; text-align:center;" id="inputError1" value="Alteração Não Concluida, Tente Novamente." readonly>
      </div>';
           header("Location: lista_area.php");

     
}// fim query
?>