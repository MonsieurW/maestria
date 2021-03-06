<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');
?>
<div class="container">
<h1><?php echo $evaluate['label']; ?></h1>
<h2><?php echo $evaluate['description']; ?></h2>
<?php 
	foreach ($class as $value) 
	{ 
		$id = $value['idClass'];
		if(isset($tri[$id])) {
			echo '<h4>Classroom : '.$value['value'].' <a href="/evaluate/'.$evaluate_id.'/resume/'.$value['idClass'].'"><i class="fa fa-institution"></i></a></h4>';
			echo '<div class="row_line row">';
			foreach ($all[$id] as $key => $user) {
				if(in_array($user['refUser'], $a[$id]))
					echo '<p class="bg-success">'.$user['user'].'</p>';
				else
					echo '<p class="bg-danger">'.$user['user'].'</p>';
			}
			echo '</div>';


		}
	}
?>
</div>
<div class="btn-on-bottom">
	<div class="btn-group">
		<a class="btn btn-mini btn-default" href="/professor/<?php echo  $evaluate['refUser']; ?>/evaluation/<?php echo $evaluate_id; ?>" role="button"><i class="glyphicon glyphicon-eye-open"></i></a>
		<a class="btn btn-mini btn-primary" href="/evaluate/<?php echo $evaluate_id; ?>" role="button"><i class="fa fa-file"></i></a>
		<a class="btn btn-mini btn-success" href="/evaluate/<?php echo $evaluate_id; ?>/resume/" role="button"><i class="fa fa-pie-chart"></i></a>
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