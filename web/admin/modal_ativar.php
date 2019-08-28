                     <h4 class="modal-title">Ativar área por período</h4>  


                     <?php
if(isset($_POST['codarea'])){
$string = $_POST['codarea'];
$explode = explode(',',$string);
$codarea = $explode[0];
$FK_nomerota = $explode[1];


echo'

<form method="POST" action="lista_area.php" id="formConfirm">
<input type="text" name="codarea" value="'.$codarea.'" readonly="readonly">
<input type="text" name="FK_nomerota" value="'.$FK_nomerota.'" readonly="readonly">
<center>
<input type="date" class="form-control" id="exampleInputEmail1" name="inidate" style="width:132px;font-size:15px;">
<br/>
<br/>
<label> Data Final </label>
<input type="date" class="form-control" id="exampleInputEmail1" name="fimdate" style="width:132px;font-size:15px;">
</center>
<input type="submit" name="ativar_periodo" value="Ativar" class="btn btn-primary some">

</form>';
}
?>