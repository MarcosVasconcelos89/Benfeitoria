<?php
include_once '../cabecalho.php';
include_once '../../control/conexao.php';
include_once '../../control/TextoDao.php';
include_once '../../model/Texto.php';
?>
<style type="text/css">
.bs-example {
	margin: 20px;
}
</style>
<div class="container">

	<div class="fh5co-slider">
<?php

if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = 0;
}
$page_name = "index.php";

if (strlen($start) > 0 and ! is_numeric($start)) {
    echo "Data Error";
    exit();
}

$eu = ($start - 0);
$limit = 7; // No of records to be shown per page.
$this1 = $eu + $limit;
$back = $eu - $limit;
$next = $eu + $limit;

$textoDao = new TextoDao($conexao);
// Total number of records in our table to break the pages
$numero = $textoDao->NumeroDeLinhasTexto();

$textos = $textoDao->listaTextosHome($eu, $limit);
$i = 0;
/*
 * echo "<pre>";
 * print_r($textos);
 * echo "</pre>";
 */
foreach ($textos as $texto) :
    // I use the rest of the division to assemble the page layout
    
    $resto = '';
    if ($i >= 1) {
        
        $resto = $i % 3;
    }
    if ($i == 0) {
        ?>
<div class="fh5co-slider">
			<p><table>
		<?php
        if (! empty($texto->getImagem()->getNome())) {
            ?>
		    <img src="<?php  echo $texto->getImagem()->getCaminho().'.'.$texto->getImagem()->getNome(); ?>"
					class="img-responsive img-bordered">
		    <?php
        } else {
            ?>
			<img src="../images/slider_1.jpg" class="img-responsive img-bordered">
				<?php }?>
		</table></p>
		</div>

		<div class="row row-bottom-padded-md">
			<div class="col-md-8 col-md-offset-2 text-center ts-intro">
				<h1><?php echo $texto->getTitulo(); ?></h1>
				<a href="ler.php?id=<?php echo base64_encode($texto->getId());?>"><p class="fh5co-lead"><?php echo $texto->getSubtitulo(); ?></a></p>
			</div>
		</div>
<?php
    } else {
        if ($i == 1) {
            ?>
        <div class="row row-bottom-padded-sm">
        <?php
        }
        ?>
    
		<div class="col-md-4">
				<div class="fh5co-service text-center">
				<?php
        if (! empty($texto->getImagem()->getNome())) {
            ?>
		    <img src="<?php echo $texto->getImagem()->getCaminho().'.'.$texto->getImagem()->getNome(); ?>"
					class="img-responsive img-bordered">
		    <?php
        } else {
            ?>
			<img src="../images/slider_1.jpg" class="img-responsive img-bordered">
				<?php }?>
				
				
					
					<h3><?php echo $texto->getTitulo(); ?></h3>
					<p><a href="ler.php?id=<?php echo base64_encode($texto->getId());?>"><?php echo $texto->getSubtitulo(); ?></a></p>
				</div>
			</div>
    <?php
        if (($resto == 0) && ($i != 1)) {
            ?>
        </div>
		<div class="row row-bottom-padded-sm">
        <?php
        }
    }
    
    $i = $i + 1;
endforeach
;

?>


	</div>

	<div class="bs-example">
		<ul class="pagination pagination-lg">
<?php

if ($numero > $limit) { // Let us display bottom links if sufficient records are there for paging
                       
    // ///////////// Start the bottom links with Prev and next link with page numbers /////////////////
                       
    // // if our variable $back is equal to 0 or more then only we will display the link to move back ////////
    if ($back >= 0) {
        // print "<a href='$page_name?start=$back'><font face='Verdana' size='2'>PREV</font></a>";
        print "<li class='previous'><a href='$page_name?start=$back'><font class='text-danger' size='2'>PREV</font></a></li>";
    }
    
    // /////////// If we are not in the last page then Next link will be displayed. Here we check that /////
    if ($this1 < $numero) {
        
        print "<li class='next'><a href='$page_name?start=$next'><font class='text-danger' size='2'>NEXT</font></a></li>";
    }
}

?>
	
    </ul>



	</div>
</div>
</div>
</div>




</div>


<?php
include_once '../rodape.php';
?>