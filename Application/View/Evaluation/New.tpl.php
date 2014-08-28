<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('stylesheet');
?>
<link href="/css/app.css" rel="stylesheet">
<?php
$this->endBlock();
$this->block('container');
?>
<form class="form-horizontal" role="form" style="margin-top: 10px" method="post" action="/professor/<?php echo $pr; ?>/evaluation/">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Titre</label>
    <div class="col-sm-5">
      <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="Titre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-5">
      <textarea name="description" class="form-control"></textarea>
    </div>
  </div>

  <h3 id="quest" data-max="1">Questions</h3>
    <?php for ($i = 1; $i <= 30; ++$i) { ?>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">#<?php echo $i; ?></label>
      <div class="col-sm-5 borde">
      	<div class="row">
      		<div class="col-sm-8">
      			<input type="text" name="q<?php echo $i; ?>_title" class="form-control" id="inputEmail3" placeholder="Titre">
      		</div>
      		<div class="col-sm-2">
            <input type="text" name="q<?php echo $i; ?>_note" class="form-control" id="inputEmail3" placeholder="Note">
          </div>
          <div class="col-sm-2">
      			<input type="text" name="q<?php echo $i; ?>_taxo" class="form-control" id="inputEmail3" placeholder="Taxo">
      		</div>
      	</div>

      	<div class="row" style="margin-top: 5px">
      		<div class="col-sm-6">
            <input type="text" name="q<?php echo $i; ?>_item1" class="typeahead form-control" placeholder="Item 1" />
      		</div>
      		<div class="col-sm-6">
      			<input type="text" name="q<?php echo $i; ?>_item2" class="typeahead form-control" placeholder="Item 2" />
      		</div>
      	</div>
      </div>
    </div>
    <?php } ?>

    <div class="btn-on-bottom">
      <button type="submit" class="btn btn-success">Create</button>
    </div>

</form>
<?php
$this->endBlock();
$this->block('script');
?>
	<script src="https://raw.githubusercontent.com/twitter/typeahead.js/master/dist/bloodhound.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
	<script src="/js/handlebars.js"></script>
	<script src="/js/app.form.js"></script>
<?php
$this->endBlock();
?>
