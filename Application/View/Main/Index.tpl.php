<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');
?>
<div class="container">
	<div class="row">
			<?php foreach ($evaluation as $value) { ?>
		<div class="rowing well">
			<h4>
				<?php echo $value['label']; ?><br />
				<span class="label label-warning"><?php echo $value['login']; ?></span>
			</h4>
			<div style="text-align: center">
				<p><?php echo substr($value['description'],0, 100); if(strlen($value['description'])) { echo '…'; }?></p>
				<div class="btn-group">
					<a class="btn btn-mini btn-default" href="/professor/<?php echo $value['refUser']; ?>/evaluation/<?php echo $value['idEvaluation']; ?>" role="button"><i class="glyphicon glyphicon-eye-open"></i></a>
		        	<a class="btn btn-mini btn-primary" href="/evaluate/<?php echo $value['idEvaluation']; ?>" role="button"><i class="fa fa-file"></i></a>
		        	<a class="btn btn-mini btn-success" href="/evaluate/<?php echo $value['idEvaluation']; ?>/resume/" role="button"><i class="fa fa-pie-chart"></i></a>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<?php 
$this->endBlock();
$this->block('stylesheet');
?>
<link href="/css/app.css" rel="stylesheet">
<?php
$this->endBlock();
 ?>