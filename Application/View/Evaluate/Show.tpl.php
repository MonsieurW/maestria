<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('stylesheet');
?>
<link href="/css/app.css" rel="stylesheet">
<link href="/css/app.evaluate.css" rel="stylesheet">
<?php
$this->endBlock();
$this->block('container');
?>
<div class="container">
	<div class="well">
		<h3><?php echo $titre; ?></h3>
		<p><?php echo $description; ?></p>
	</div>

	<form class="form-horizontal" role="form" id="f" data-id="<?php echo $id; ?>">
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Classe</label>
	    <div class="col-sm-10">
	      <select id="sClass">
				<?php foreach ($class as $value) { ?>
					<option value="<?php echo $value['idClass']; ?>"><?php echo $value['value']; ?></option>
				<?php } ?>
			</select>
	    </div>
	  </div>
    </form>

</div>
<form method="post" action="/evaluate/">
	<input type="hidden" name="evaluation" value="<?php echo $id; ?>" />
	<input type="hidden" id="profil" name="user" value="" />
	<div class="container" id="output"></div>
  	<div class="btn-on-bottom">
  		<div class="btn-group">
			<a class="btn btn-mini btn-default" href="/professor/<?php echo $pr; ?>/evaluation/<?php echo $id; ?>" role="button"><i class="glyphicon glyphicon-eye-open"></i></a>
			<a class="btn btn-mini btn-primary" href="/evaluate/<?php echo $id; ?>" role="button"><i class="fa fa-file"></i></a>
			<a class="btn btn-mini btn-success" href="/evaluate/<?php echo $id; ?>/resume/" role="button"><i class="fa fa-pie-chart"></i></a>
		</div>
      	<button type="submit" class="btn btn-success" id="fSend" data-id="">Send</button>
    </div>

</form>
<?php
$this->endBlock();
$this->block('script');
?>
<script src="/js/app.evaluate.js"></script>
<?php
$this->endBlock();
