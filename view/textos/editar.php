<?php if(isset($_GET['id'])){
    $id = base64_decode($_GET['id']);
}else{
    $redirect = "gerenciar.php";
    header("location:$redirect");
}
include_once '../cabecalho.php';
include_once '../../model/Texto.php';
include_once '../../control/conexao.php';
include_once '../../control/TextoDao.php';
//includes the start of the div and the message from the DAO file
include_once 'mensagem.php';
$textoDao = new TextoDao($conexao);
$textos = $textoDao->imprimirTexto($id);
/*echo "<pre>";
print_r($textos);
echo "</pre>";*/
foreach($textos as $texto) :

?>
<style>
img{
 max-width:100%;
 height:auto;
}
</style>

<link
	type="text/css" rel="stylesheet" href="../css/jquery-te-1.4.0.css">
<script
	type="text/javascript" src="../js/jquery-te-1.4.0.min.js"
	charset="utf-8"></script>



<div class="row row-bottom-padded-md">
	<div class="col-md-8 col-md-offset-2 text-center ts-intro">
		<form action="salvar_editar.php" name="mensagemEnvio" method="POST"
			enctype="multipart/form-data">
			<div class="form-group">
				<table>
					<tr>
						<td><label for="titulo">Título:</label>
						</td>
						<td><input type="text" maxlength="150" size="2"
							class="form-control" id="name" name="titulo"
							placeholder="Informe o título." value="<?php  echo $texto->getTitulo() ;?>"
							data-error="Por favor, informe seu nome." required>
							<input type="hidden" name="id" value="<?php  echo $texto->getId() ;?>">
							<input type="hidden"  value="0" id="principal" class="form-control" >
						</td>
						<td width="15%"></td>
					</tr>
					<tr>
						<td><label for="titulo">Subtítulo:</label>
						</td>
						<td><input type="text" maxlength="150" class="form-control"
							id="subtitulo" name="subtitulo" value="<?php  echo $texto->getSubtitulo() ;?>"
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
					<?php if(!empty($texto->getImagem()->getId() )){?>
					<tr><td></td>
						<td><a href="excluirImagem.php?id=<?php echo $texto->getImagem()->getId().'|'.$texto->getImagem()->getNome()
						.'|'.$id; ?>">
						<?php echo $texto->getImagem()->getNome_antigo() ;?><img src="../images/remove.png" title="Remover">
						</a></td>
					</tr>
					<?php }?>
					<tr>	
						<td><label for="imagem">Imagem(max 2mb):</label></td>
						<td><input type="file" name="imagem" id="fileToUpload" class="form-control"></td>
						<td width="10%"></td>
					</tr>
					
						<tr>
					<td><label for="principal">Publicado:</label></td>

					
					
					<td>
					<select name="publicado" id="principal" class="form-control" >
						<option value="0" <?php if($texto->getPublicado() == 0) echo "selected";?>>Sim</option>
						<option value="1" <?php if($texto->getPublicado() == 1) echo "selected";?>>Não</option>
						
						</select>
						</td>
						</tr>
					<tr>
						<td>Notícia:</td>
						<td><textarea name="mensagem" class="jqte-test" required><?php  echo $texto->getMensagem() ;?>
								</textarea></td>					
					</tr>					
					<tr>
					<?php endforeach;?>
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

