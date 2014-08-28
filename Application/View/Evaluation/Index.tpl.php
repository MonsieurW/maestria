<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');
?>
<div class="container">
	<div class="col-md-4">
		<a href="/professor/<?php echo $pr; ?>/evaluation/new" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i></a>
	</div>
</div>
<div class="container">
	<?php
    if (isset($eval)) {
        foreach ($eval as $e) {?>
			<div class="col-md-4">
		        <h2>Evaluation #<?php echo $e['idEvaluation']; ?> <span class="badge"><?php echo $e['nb']; ?></span></h2>
		        <p style="word-wrap: auto"><?php echo $e['label']; ?></p>
		        <p style="word-wrap: auto"><?php echo $e['description']; ?></p>
		        <p>
		        	<a class="btn btn-default" href="/professor/1/evaluation/<?php echo $e['idEvaluation']; ?>" role="button"><i class="glyphicon glyphicon-eye-open"></i></a>
		        	<a class="btn btn-primary" href="/evaluate/<?php echo $e['idEvaluation']; ?>" role="button"><i class="fa fa-file"></i></a>
		        	<a class="btn btn-danger" href="/professor/1/evaluation/<?php echo $e['idEvaluation']; ?>/destroy" role="button"><i class="glyphicon glyphicon-trash"></i></a>
		        </p>
		    </div>
	<?php }
    } ?>
</div>
<?php
$this->endBlock();
