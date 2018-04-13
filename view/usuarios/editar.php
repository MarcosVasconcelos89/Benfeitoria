<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $redirect = "gerenciar.php";
    header("location:$redirect");
}
include_once '../cabecalho.php';
include_once '../../model/Usuario.php';
include_once '../../control/conexao.php';
include_once '../../control/UsuarioDao.php';
//includes the start of the div and the message from the DAO file
include_once 'mensagem.php';
$usuarioDao = new UsuarioDao($conexao);
$usuarios = $usuarioDao->exibeUsuario($id); 
foreach($usuarios as $usuario) :
?>
   
<div class="row row-bottom-padded-md">
	<div class="col-md-8 col-md-offset-2 text-center ts-intro">
		<form action="modificar.php" name="mensagemEnvio" method="POST"
			enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $usuario->getId()?>">
			
			
			<div class="form-group">
				<table>
					<tr>
						<td><label for="email">Nome:</label></td>
						<td><input type="text" maxlength="50" class="form-control" readonly
							id="name" name="nome" placeholder="Informe o nome." value="<?php echo $usuario->getNome()?>"
							data-error="Por favor, informe seu nome."  required>
							<div class="help-block with-errors"></div></td>
					</tr>
					<tr>
						<td><label for="email">Login:</label></td>
						<td><input type="text" maxlength="20" class="form-control" readonly
							id="name" name="login" placeholder="Informe um login." value="<?php echo $usuario->getLogin()?>"
							data-error="Por favor, informe seu login." required>
							<div class="help-block with-errors"></div></td>
					</tr>
					
					<tr>
						<td><label for="email">Ativo:</label></td>
						<td><select name="ativo" id="ativo" class="form-control">
						<option value="0" <?php if($usuario->getAtivo() == 0) echo "selected";?>>Sim</option>
						<option value="1" <?php if($usuario->getAtivo() == 1) echo "selected";?>>Não</option>
						
						</select>
						
						</td>
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

<?php 
endforeach;
include_once '../rodape.php';?>

