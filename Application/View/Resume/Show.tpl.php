<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');

$annotation = function ($co, $cp, $ap, $an) {
	$commentaire = '';

	if($co < 0.6) {
		$commentaire='Tu dois commencer par apprendre les définitions car elles te serviront souvent, ';
        $bon=0;
	} else {
		$commentaire='Tes définitions sont sues, c\'est bien, ';
		$bon=1;
	}

	if($cp < 0.6) {
        if($bon==1) {
        	$commentaire.='par contre ';
        }
        
        $commentaire.='il faut reformuler les explications pour bien les comprendre et ';
        $bon=0;
    } else {
    	if($bon==0) {
    		$commentaire.='par contre ';
    	}
		
		$commentaire.='les explications ont été comprises et ';
		$bon=1;
	}
	
	if($ap < 0.6) {
		if($bon==1) {
			$commentaire.='néanmoins, ';
		}
        
        $commentaire.='tu peux progresser encore en travaillant davantage les exercices ';
        $bon=0;
    } else {
		$commentaire.='le travail sur les exercices a porté ses fruits ';
	}

	// TODO : Utiliser la Taxo analyse

	return $commentaire;
};

?>
<div class="container">
<?php foreach ($answer as $key => $value) { ?>
		<div class="col-lg-2 questions answer">
			<h5><?php echo $value['user']; ?>
			<?php if($real[$value['refUser']] > 15) { ?>
				<span class="hidden label label-success pull-right" data-toggle><?php echo $real[$value['refUser']]; ?>/<?php echo $note_max; ?></span>
			<?php } else if($real[$value['refUser']] > 10) {?>
				<span class="hidden label label-primary pull-right"><?php echo $real[$value['refUser']]; ?>/<?php echo $note_max; ?></span>
			<?php } else if($real[$value['refUser']] > 5) {?>
				<span class="hidden label label-warning pull-right"><?php echo $real[$value['refUser']]; ?>/<?php echo $note_max; ?></span>
			<?php } else { ?>
				<span class="hidden label label-danger pull-right"><?php echo $real[$value['refUser']]; ?>/<?php echo $note_max; ?></span>
			<?php }?>
			</h5>
			<ul>
				<?php 
					$result = $value['result'];
					ksort($result);

					foreach ($result as $key => $value) {
						switch($key) {
							case 1:
								echo '<li data-toggle="tooltip" title="Connaissance">Cn <i class="fa fa-sort-desc"></i><br />'.round(($value*100)).'%</li>';
								break;
							case 2:
								echo '<li data-toggle="tooltip" title="Compétence">Cp <i class="fa fa-sort-desc"></i><br />'.round(($value*100)).'%</li>';
								break;
							case 3:
								echo '<li data-toggle="tooltip" title="Aptitude">Ap <i class="fa fa-sort-desc"></i><br />'.round(($value*100)).'%</li>';
								break;
							case 4:
								echo '<li data-toggle="tooltip" title="Analyse">An <i class="fa fa-sort-desc"></i><br />'.round(($value*100)).'%</li>';
								break;
						}
					}
				 ?>
			</ul>

			<p><?php echo $annotation($result[1], $result[2], $result[3], $result[4]); ?></p>

		</div>
<?php } ?>
</div>
<div class="container">
	<div class="pull-right btn-group">
  		<button type="button" class="btn btn-success" id="print"><i class="fa fa-print"></i></button>
  		<button type="button" class="btn btn-info" id="control"><i class="fa fa-eye"></i></button>
	</div>
</div>
<?php 
$this->endBlock();
$this->block('stylesheet');
?>
<link href="/css/app.css" rel="stylesheet">
<?php
$this->endBlock();
$this->block('script');
?>
<script src="/js/app.resume.js"></script>
<?php
$this->endBlock();
 ?>