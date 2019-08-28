function enviardados(){
 
if(document.dados.tx_nome.value=="" || document.dados.tx_nome.value.length < 8)
{
alert( "É necessario preencher o nome completo para a confecção do certificado!" );
document.dados.tx_nome.focus();
return false;
}
 
 
if( document.dados.tx_email.value=="" || document.dados.tx_email.value.indexOf('@')==-1 || document.dados.tx_email.value.indexOf('.')==-1 )
{
alert( "Preencha campo E-MAIL corretamente!" );
document.dados.tx_email.focus();
return false;
}
 
if (document.dados.tx_pass.value=="")
{
alert( "Preencha o campo Senha!" );
document.dados.tx_pass.focus();
return false;
}

if (document.dados.tx_login.value=="")
{
alert( "Preencha o campo Login!" );
document.dados.tx_login.focus();
return false;
}

if (document.dados.tx_cpf.value.length<11)
{
alert( "Preencha o campo CPF corretamente!" );
document.dados.tx_cpf.focus();
return false;
}
 
if (document.dados.tx_mensagem.value.length < 50 )
{
alert( "É necessario preencher o campo MENSAGEM com mais de 50 caracteres!" );
document.dados.tx_mensagem.focus();
return false;
}
 
return true;
}
function validaSenha (input){ 
    if (input.value != document.getElementById('tx_pass').value) {
    input.setCustomValidity('Repita a senha corretamente');
  } else {
    input.setCustomValidity('');
  }
} 

		function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}