<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('stylesheet');
?>
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<?php
$this->endBlock();
$this->block('container');
?>
<div class="container">
	<table class="table">
		<tr>
			<th>Theme</th>
			<th>Domain</th>
			<th>Type</th>
			<th>Level</th>
			<th class="col-lg-5">Item</th>
		</tr>
		<?php if(isset($know)){
			foreach ($know as $key => $value) {
				echo 	'<tr>'.
						'<td><span class="label label-info">'.$t[$value['refTheme']].'</span></td>'.
						'<td><span class="label label-success">'.$d[$value['refDomain']].'</span></td>'.
						'<td>'.(($value['type'] === '0') ? 'Connaissance' :'Compétence').'</td>'.
						'<td>'.$value['lvl'].'</td>'.
						'<td>'.$value['item'].'</td>'.
						'</tr>';
			}
		}?>
	</table>
</div>
<div class="container">
	<p>
		<a href="#" id="new" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a>
	</p>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  	<form class="form-horizontal" role="form" method="post" action="/know/">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">New Connaissance</h4>
      </div>
      <div class="modal-body">
        
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Theme</label>
		    <div class="col-sm-10">
		      <select id="theme">
		      <?php foreach ($theme as $t) { ?>
		      	<option value="<?php echo $t['idTheme']; ?>"><?php echo $t['themeValue']; ?></option>
		      <?php } ?>
		      </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Domaine</label>
		    <div class="col-sm-10">
		      <select id="domain">
		      <?php foreach ($domain as $t) { ?>
		      	<option value="<?php echo $t['idDomain']; ?>"><?php echo $t['domainValue']; ?></option>
		      <?php } ?>
		      </select>
		    </div>
		  </div>	 
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Type</label>
		    <div class="col-sm-10">
		      <select id="type">
		      	<option value="0">Connaissance</option>
		      	<option value="1">Compétence</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Level</label>
		    <div class="col-sm-10">
		 		<select id="level">
		      	<option>1</option>
		      	<option>2</option>
		      	<option>3</option>
		      	<option>4</option>
		      	<option>5</option>
		      	<option>6</option>
		      	<option>7</option>
		      	<option>8</option>
		      	<option>9</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Item</label>
		    <div class="col-sm-10">
		      <textarea id="item" class="form-control"></textarea>
		    </div>
		  </div>
		
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" id="save" data-dismiss="modal" />
      </div>
      </form>
    </div>
  </div>
</div>
<?php
$this->endBlock();
$this->block('script');
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/js/know.js"></script>
<?php
$this->endBlock();