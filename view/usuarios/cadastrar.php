<?php 
include_once '../../control/manterLogin.php';
verificaUsuario();
include_once '../cabecalho.php';
//includes the start of the div and the message from the DAO file
include_once 'mensagem.php';
?>   
   
<div class="row row-bottom-padded-md">
	<div class="col-md-8 col-md-offset-2 text-center ts-intro">
		<form action="adiciona.php" name="mensagemEnvio" method="POST"
			enctype="multipart/form-data">
			<div class="form-group">
				<table>
					<tr>
						<td><label for="email">Nome:</label></td>
						<td><input type="text" maxlength="50" class="form-control"
							id="name" name="nome" placeholder="Informe o nome."
							data-error="Por favor, informe seu nome." required>
							<div class="help-block with-errors"></div></td>
					</tr>
					<tr>
						<td><label for="email">Login:</label></td>
						<td><input type="text" maxlength="20" class="form-control"
							id="name" name="login" placeholder="Informe um login."
							data-error="Por favor, informe seu login." required>
							<div class="help-block with-errors"></div></td>
					</tr>
					<tr>
						<td><label for="email">Senha:</label></td>
						<td><input type="password" maxlength="12" class="form-control"
							id="name" name="senha" placeholder="Informe uma senha."
							data-error="Por favor, informe sua senha." required>
							<div class="help-block with-errors"></div></td>
					</tr>
					<tr>
						<td></td>
						<td><br />
							<button type="submit" class="btn btn-danger">Cadastrar</button></td>
					</tr>
				</table>
			</div>
		</form>
		
		</div>
		</div>		</div>

</div>

<?php include_once '../rodape.php';?>

