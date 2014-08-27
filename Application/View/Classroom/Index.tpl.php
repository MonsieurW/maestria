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
			<th>Classse</th>
		</tr>
		<?php if(isset($classe)){
			foreach ($classe as $key => $value) {
				echo '<tr><td>
				<a class="editable editable-click" data-type="text" data-pk="'.$value['idClass'].'">'.$value['value'].'</a>
				<span class="pull-right">
					<a href="/classroom/'.$value['idClass'].'/edit" class="btn btn-mini btn-info" >
						<i class="fa fa-edit"></i>
					</a>
					<a href="#" class="trash btn btn-mini btn-danger" data-id="'.$value['idClass'].'">
						<i class="glyphicon glyphicon-trash"></i>
					</a>
				</span>
				</td></tr>';
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
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">New Classroom</h4>
      </div>
      <div class="modal-body">
        <input type="text" id="classroom" class="form-control" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php
$this->endBlock();
$this->block('script');
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/js/classroom.js"></script>
<?php
$this->endBlock();