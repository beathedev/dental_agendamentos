<?php
$array = $_POST['PK_codarea_bloq'];
$explode = explode(',', $array);
echo $PK_codarea_bloq = $explode[0];
echo $FK_nomerota = $explode[1];
echo $inidate = $explode[2];
echo $fimdate_ = $explode[3];
echo $periodo = $explode[4];

?>


<center>
<form method="POST" action="bloqueio_lista.php">
<input type="hidden" value="<?=$PK_codarea_bloq?>" name="PK_codarea_bloq">
<input type="hidden" value="<?=$FK_nomerota?>" name="FK_nomerota">
<input type="date" value="<?=$inidate?>" name="inidate" style="visibility: hidden;">
<input type="date" value="<?=$fimdate_?>" name="fimdate" style="visibility: hidden;">
<input type="hidden" value="<?=$periodo?>" name="periodo">
<input type="submit" name="apagar"  class="btn btn-default" value="Apagar"/>
</form>
</center>



