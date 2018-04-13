<?php
include_once '../cabecalho.php';
include_once '../../model/Usuario.php';
include_once '../../model/Texto.php';
include_once '../../control/conexao.php';
include_once '../../control/UsuarioDao.php';
include_once '../../control/textoDao.php';

?>
<style>
img {
	max-width: 100%;
	height: auto;
}
</style>
<div class="container">
	<div id="container">
		<div id="demo">
<?php

// verify and get id to do search via get
if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $textoDao = new TextoDao($conexao);
    $textos = $textoDao->imprimirTexto($id);
    // increase column (principal), view count feature
    $textoDao->AumentarPrincipal($id);
    
    foreach ($textos as $texto) :
        ?>

					
					<div class="col-md-12 col-md-offset-0 text-center ts-intro">
				<h1><?php echo $texto->getTitulo();?></h1>
				<p class="fh5co-lead"><?php echo $texto->getSubtitulo();?></p>
			</div>
			<div class="col-md-12 col-md-offset-4 text-center ts-intro">
				<div class="row row-bottom-padded-sm">
					<div class="col-md-4">
						<div class="fh5co-service text-center">
						<?php if(!empty($texto->getImagem()->getCaminho())){?>	<img
								class="img-responsive img-bordered"
								src="<?php echo $texto->getImagem()->getCaminho().'.';echo $texto->getImagem()->getNome();?>"><?php }?>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
						
						<?php echo $texto->getMensagem();?>
						
						
					
					</div>


	<div class="col-md-10 col-md-offset-4 text-center ts-intro">


		<br />
<?php
        
echo "Postado por: " . utf8_encode($texto->getUsuario()->getLogin());
        echo " em " . $textoDao->ajustarData($texto->getCriacao());
        ?>
<br /> <br />
	</div>
<?php
    endforeach
    ;
}
?>
    
    
</div>
</div>
</div>
</div>
<?php 
include_once '../rodape.php';
?>