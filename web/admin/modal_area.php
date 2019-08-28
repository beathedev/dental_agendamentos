<?php

$array = $_POST['codarea'];
$explode = explode(',', $array);
$codarea = $explode[0];
$FK_nomerota = $explode[1];

?>


<center>
<form method="POST" action="lista_area.php">
<h5> Informe a data a ser bloqueada a área pelo sistema:</h5>
<br>
<label> Data Inicial</label>
<input type="hidden" value="<?=$FK_nomerota?>" name="FK_nomerota">

<input type="hidden" value="<?=$codarea?>" name="codarea">
<input type="date" class="form-control" id="exampleInputEmail1" name="inidate" style="width:132px;font-size:15px;">
<br/>
<br/>
<label> Data Final </label>
<input type="date" class="form-control" id="exampleInputEmail1" name="fimdate" style="width:132px;font-size:15px;">
<br/>
<input type="submit" name="block"  class="btn btn-default" value="Bloquear"/>
</form></center>



