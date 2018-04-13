<?php 
include_once '../../control/manterLogin.php';
verificaUsuario();
include_once '../cabecalho.php';
include_once 'mensagem.php';

?>


<link
	type="text/css" rel="stylesheet" href="../css/jquery-te-1.4.0.css">
<script
	type="text/javascript" src="../js/jquery-te-1.4.0.min.js"
	charset="utf-8"></script>



<div class="row row-bottom-padded-md">
	<div class="col-md-8 col-md-offset-2 text-center ts-intro">
		<form action="adicionar.php" name="mensagemEnvio" method="POST"
			enctype="multipart/form-data">
			
			<div class="form-group">
				<table>
					<tr>
						<td><label for="titulo">Título:</label>
						</td>
						<td><input type="text" maxlength="150" size="2"
							class="form-control" id="name" name="titulo"
							placeholder="Informe o título."
							data-error="Por favor, informe seu nome." required>
							<input type="hidden" maxlength="50" size="2"
							class="form-control" id="usuario" name="usuario"
							value="<?php echo $_SESSION['id']; ?>"
							data-error="Por favor, informe seu nome." required>
						<input type="hidden"  value="0" id="principal" class="form-control" >
						</td>
						<td width="15%"></td>
					</tr>
					<tr>
						<td><label for="titulo">Subtítulo:</label>
						</td>
						<td><input type="text" maxlength="150" class="form-control"
							id="subtitulo" name="subtitulo"
							placeholder="Informe o subtitulo."
							data-error="Por favor, informe subtitulo." required>
						
						</td>
						<td width="15%"></td>
					</tr>
					<tr>
					<td></td>
					<td></td>
					<td width="15%"></td>
					</tr>
					<tr>	
						<td><label for="imagem">Imagem(max 2mb):</label></td>
						<td><input type="file" name="imagem" id="fileToUpload" class="form-control"></td>
						<td width="10%"></td>
					</tr>
					
					<tr>
						<td>Notícia:</td>
						<td><textarea name="mensagem" class="jqte-test" maxlength="20000" required>
								</textarea></td>					
					</tr>					
					<tr>
						<td><button type="submit" class="btn btn-danger">Cadastrar</button></td>
					</tr>
					<td width="15%"></td>				
				</table>
			</div>
		</form>

	</div>
</div>
</div>

</div>

<script>
	$('.jqte-test').jqte();
	
	// settings of status
	var jqteStatus = true;
	$(".status").click(function()
	{
		jqteStatus = jqteStatus ? false : true;
		$('.jqte-test').jqte({"status" : jqteStatus})
	});
</script>

<?php include_once '../rodape.php';?>

