<?php
require_once("../conexao.php");
$coddatabloq = $_POST['coddatabloq'];
$explode = explode(',', $coddatabloq);
$cod =  $explode[0];
$periodo =  $explode[1];
$datadestino =  $explode[2];

  echo '  
  <form method="POST" action="datas.php">
<input type="hidden" id="cod" name="cod" value="'.$cod.'"/>
<input type="hidden" id="periodo"  value="'.$periodo.'" name="periodo">
<input type="hidden" id="datadestino"  value="'.$datadestino.'" name="datadestino">
<input type="submit" value="Apagar"  name="apaga" class="btn btn-default">';


?>