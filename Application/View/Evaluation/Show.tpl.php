<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');
?>
<div class="container">
	<h1>Evaluation #<?php echo $id; ?> <a href="/professor/<?php echo $pr; ?>/evaluation/<?php echo $id; ?>/edit"><i class="glyphicon glyphicon-edit"></i></a></h1>
	<form class="form-horizontal" role="form">
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Titre</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo $label; ?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo $description; ?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPassword3" class="col-sm-2 control-label">Questions</label>
	    <div class="col-sm-10">
	      <?php foreach ($questions as $q) {
	      ?>
		<div class="row">
	    	<h4><?php echo $q['title']; ?> <span class="label label-success"><?php echo $q['taxoPrincipal']; ?></span> <i class="glyphicon glyphicon-arrow-right"></i> <span class="label label-info"><?php echo $q['note']; ?></span></h4> 
	    	<div class="row">
	    		<div class="col-sm-5">
	    			<p>
	    				<span class="label label-success"><?php echo $q['item1']['domainValue']; ?></span>
	    				<span class="label label-info"><?php echo $q['item1']['themeValue']; ?></span>
	    			</p>
	    			<p class="well"><?php echo $q['item1']['item']; ?></p>
	    		</div>
	    		<div class="col-sm-5">
	    			<p>
	    				<span class="label label-success"><?php echo $q['item2']['domainValue']; ?></span>
	    				<span class="label label-info"><?php echo $q['item2']['themeValue']; ?></span>
	    			</p>
	    			<p class="well"><?php echo $q['item2']['item']; ?></p>
	    		</div>

	    	</div>
	    </div>	
	      <?php
	      }
	      ?>
	    </div>
	  </div>
	</form>
	<a href="/evaluate/<?php echo $id; ?>" class=" btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i> Evaluate classroom</a>
</div>
<?php
$this->endBlock();