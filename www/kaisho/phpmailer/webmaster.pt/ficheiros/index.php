<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="text/css" rel="stylesheet" media="screen" href="estilo.css">
<script src="scripts/ajax.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function enviar_formulario()
{

	String.prototype.trim = function()   {  return this.replace(/^\s+|\s+$/g,""); }
	String.prototype.ltrim = function()  {  return this.replace(/^\s+/,""); }
	String.prototype.rtrim = function()  {  return this.replace(/\s+$/,""); }

	if( document.getElementById("empresa").value.trim() == '' ){
		document.getElementById("empresa").focus();
		alert( "Preencher campo Empresa !" );		
		return false
	}
	else if( document.getElementById("pessoa_contato").value.trim() == '' ){
		document.getElementById("pessoa_contato").focus();
		alert( "Preencher o campo Pessoa de Contato !" );
		return false
	}
	else if( document.getElementById("telefone").value.trim() == '' ){
		document.getElementById("telefone").focus();
		alert( "Preencher o campo DDD+Telefone !" );
		return false
	}
	else if( document.getElementById("email").value.trim() == '' ){
		document.getElementById("email").focus();
		alert( "Preencher o campo E-mail !" );
		return false
	}	
	else if( document.getElementById("email").value.trim() != '' ){
		
		var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
		var mail = document.getElementById("email").value;
		var valida_mail = 0;
		
		if(typeof(mail) == "string"){
			
			if(er.test(mail)){ 
				valida_mail = 1; 
			}        
		
		} else if(typeof(mail) == "object"){
			if(er.test(mail.value)){
   				valida_mail = 1;
			}
		}else{ 
				valida_mail = 0;
		}
		
		if( valida_mail == 0 ){
			document.getElementById("email").focus();
			alert( "Preencher o campo E-mail corretamente !" );
			return false
		}	
		else{

			if( document.getElementById("assunto").value == 0 ){
				document.getElementById("assunto").focus();
				alert( "Preencha o campo Assunto !" );
				return false
			}
		}
	}
}

</script>
<title>Contatos</title>
</head>
<body>
<div>
  <form action="formulario_envia.php" method="post"  name="contato" onsubmit="return enviar_formulario()">
    
    <!-- Inicio da Tabela -->
    <table width="700" border="0" align="center" background="imagens/background_formulario.png">
      <tr>
        <td colspan="4"><br>
          <div id="titulo">Preencha o Formulário de Contato</div>
          <br>
        </td>
      </tr>
      <tr>
        <td><label id="lb_empresa">Empresa:</label></td>
        <td><input name="empresa" type="text" id="empresa" maxlength="50"></td>
        <td><label>Pessoa de Contato:</label></td>
        <td><input name="pessoa_contato" type="text" id="pessoa_contato" maxlength="30">
        </td>
      </tr>
      <tr>
        <td><label>DDD+Telefone:</label></td>
        <td><input name="telefone" type="text" id="telefone" maxlength="15"></td>
        <td><label>Telefone Alternativo:</label></td>
        <td><input name="telefone_alternativo" type="text" id="telefone_alternativo" maxlength="15"></td>
      </tr>
      <tr>
        <td><label>Email:</label></td>
        <td><input id="email" name="email" type="text">
        </td>
        <td><label>Assunto:</label></td>
        <td><input name="assunto" type="text" id="assunto" maxlength="50">
        </td>
      </tr>
      <tr>
        <td><label>OBSERVAÇÕES:</label></td>
        <td colspan="3"><textarea name="observacao" rows="5"></textarea></td>
      </tr>
      <tr>
        <td colspan="4"><div align="right"><input type="image" src="imagens/bt_solicitacao.png" name="solicitacao" alt="Enviar" id="botao" />
          </div></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>
