<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');
$this->block('stylesheet');
?>
<link href="/css/app.css" rel="stylesheet">
<link href="/css/app.evaluate.css" rel="stylesheet">
<?php
$this->endBlock();
?>
<div class="container">
	<div class="well">
		<h3><?php echo $titre; ?></h3>
		<p><?php echo $description; ?></p>
	</div>	
	
	<form class="form-horizontal" role="form" id="f" data-value="<?php echo $id; ?>">
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
	
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Classe</label>
		<div class="input-group">
	        <span class="input-group-addon" id="prevUser" style="cursor: pointer">
	        	<span class="glyphicon glyphicon-arrow-left"></span>
	        </span>
	        <input type="text" class="form-control col-sm-2" id="user" readonly="readonly">
	        <span class="input-group-addon" id="nextUser" style="cursor: pointer">
	        	<span class="glyphicon glyphicon-arrow-right"></span>
	        </span>
	    </div>
    </div>
    </form>

</div>
<form method="post" action="/evaluate/">
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<div class="container" id="output">

	</div>
  	<div class="btn-on-bottom">
      <button type="submit" class="btn btn-success" id="fSend">Send</button>
    </div>

</form>
<?php
$this->endBlock();
$this->block('script');
?>
<script src="/js/app.evaluate.js"></script>
<?php
$this->endBlock();